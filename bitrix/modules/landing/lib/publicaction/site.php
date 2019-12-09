<?php
namespace Bitrix\Landing\PublicAction;

use \Bitrix\Landing\Manager;
use \Bitrix\Landing\File;
use \Bitrix\Landing\Rights;
use \Bitrix\Landing\Landing;
use \Bitrix\Landing\Site as SiteCore;
use \Bitrix\Landing\PublicActionResult;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class Site
{
	/**
	 * Clear disallow keys from add/update fields.
	 * @param array $fields Array fields.
	 * @return array
	 */
	protected static function clearDisallowFields(array $fields)
	{
		$disallow = array('ACTIVE');

		if (is_array($fields))
		{
			foreach ($fields as $k => $v)
			{
				if (in_array($k, $disallow))
				{
					unset($fields[$k]);
				}
			}
		}

		return $fields;
	}

	/**
	 * Get additional fields of site.
	 * @param int $id Id of site.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function getAdditionalFields($id)
	{
		$result = new PublicActionResult();
		$id = (int)$id;

		if (($fields = SiteCore::getAdditionalFields($id)))
		{
			foreach ($fields as $key => $field)
			{
				$fields[$key] = $field->getValue();
				if (!$fields[$key])
				{
					unset($fields[$key]);
				}
			}
			$result->setResult(
				$fields
			);
		}

		return $result;
	}

	/**
	 * Gets public url of site (or sites).
	 * @param int[] $id Site id or array of ids.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function getPublicUrl($id)
	{
		static $mixedParams = ['id'];

		$result = new PublicActionResult();
		$result->setResult(SiteCore::getPublicUrl($id));
		return $result;
	}


	/**
	 * Get available sites.
	 * @param array $params Params ORM array.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function getList(array $params = array())
	{
		$result = new PublicActionResult();

		if (!is_array($params))
		{
			$params = array();
		}

		// more usable for domain mame
		if (
			isset($params['select']) &&
			is_array($params['select']) &&
			in_array('DOMAIN_NAME', $params['select'])
		)
		{
			foreach ($params['select'] as $k => $code)
			{
				if ($code == 'DOMAIN_NAME')
				{
					unset($params['select'][$k]);
					break;
				}
			}
			$params['select']['DOMAIN_NAME'] = 'DOMAIN.DOMAIN';
		}

		$data = array();
		$res = SiteCore::getList($params);
		while ($row = $res->fetch())
		{
			if (isset($row['DATE_CREATE']))
			{
				$row['DATE_CREATE'] = (string) $row['DATE_CREATE'];
			}
			if (isset($row['DATE_MODIFY']))
			{
				$row['DATE_MODIFY'] = (string) $row['DATE_MODIFY'];
			}
			$data[] = $row;
		}
		$result->setResult($data);

		return $result;
	}

	/**
	 * Create new site.
	 * @param array $fields Site data.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function add(array $fields)
	{
		$result = new PublicActionResult();
		$error = new \Bitrix\Landing\Error;

		$fields = self::clearDisallowFields($fields);
		$fields['ACTIVE'] = 'N';

		$res = SiteCore::add($fields);

		if ($res->isSuccess())
		{
			$result->setResult($res->getId());
		}
		else
		{
			$error->addFromResult($res);
			$result->setError($error);
		}

		return $result;
	}

	/**
	 * Update site.
	 * @param int $id Site id.
	 * @param array $fields Site new data.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function update($id, array $fields)
	{
		$result = new PublicActionResult();
		$error = new \Bitrix\Landing\Error;

		$fields = self::clearDisallowFields($fields);

		$res = SiteCore::update($id, $fields);

		if ($res->isSuccess())
		{
			$result->setResult(true);
		}
		else
		{
			$error->addFromResult($res);
			$result->setError($error);
		}

		return $result;
	}

	/**
	 * Delete site.
	 * @param int $id Site id.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function delete($id)
	{
		$result = new PublicActionResult();
		$error = new \Bitrix\Landing\Error;

		$res = SiteCore::delete($id);

		if ($res->isSuccess())
		{
			$result->setResult(true);
		}
		else
		{
			$error->addFromResult($res);
			$result->setError($error);
		}

		return $result;
	}

	/**
	 * Mark entity as deleted.
	 * @param int $id Entity id.
	 * @param boolean $mark Mark.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function markDelete($id, $mark = true)
	{
		$result = new PublicActionResult();
		$error = new \Bitrix\Landing\Error;
		$id = (int)$id;

		if ($mark)
		{
			$res = SiteCore::markDelete($id);
		}
		else
		{
			$res = SiteCore::markUnDelete($id);
		}
		if ($res->isSuccess())
		{
			$result->setResult($res->getId());
		}
		else
		{
			$error->addFromResult($res);
			$result->setError($error);
		}

		return $result;
	}

	/**
	 * Mark entity as undeleted.
	 * @param int $id Entity id.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function markUnDelete($id)
	{
		return self::markDelete($id, false);
	}

	/**
	 * Make site public.
	 * @param int $id Entity id.
	 * @param boolean $mark Mark.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function publication($id, $mark = true)
	{
		$result = new PublicActionResult();
		$error = new \Bitrix\Landing\Error;
		$wasError = false;
		$id = (int)$id;

		// work with pages
		$res = Landing::getList(array(
			'select' => array(
				'ID'
			),
			'filter' => array(
				'SITE_ID' => $id
			)
		));
		while ($row = $res->fetch())
		{
			$landing = Landing::createInstance($row['ID']);
			if ($mark)
			{
				$landing->publication();
			}
			else
			{
				$landing->unpublic();
			}
			if (!$landing->getError()->isEmpty())
			{
				$result->setError($landing->getError());
				$wasError = true;
				break;
			}
		}

		if (!$wasError)
		{
			$res = SiteCore::update($id, array(
				'ACTIVE' => $mark ? 'Y' : 'N'
			));
			if (!$res->isSuccess())
			{
				$error->addFromResult($res);
				$result->setError($error);
			}
			else
			{
				$result->setResult($res->getId());
			}
		}

		return $result;
	}

	/**
	 * Mark site unpublic.
	 * @param int $id Entity id.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function unpublic($id)
	{
		return self::publication($id, false);
	}

	/**
	 * Full export of the site.
	 * @param int $id Site id.
	 * @param array $params Params array.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function fullExport($id, array $params = array())
	{
		$result = new PublicActionResult();

		$result->setResult(
			SiteCore::fullExport($id, $params)
		);

		return $result;
	}

	/**
	 * Set rights for site.
	 * @param int $id Site id.
	 * @param array $rights Array of rights for site.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function setRights($id, $rights = [])
	{
		static $mixedParams = ['rights'];

		$result = new PublicActionResult();
		$error = new \Bitrix\Landing\Error;
		$result->setResult(false);
		$id = (int)$id;

		if (!is_array($rights))
		{
			$rights = [];
		}

		// check access for set rights
		if (!Rights::isAdmin())
		{
			$error->addError(
				'IS_NOT_ADMIN',
				Loc::getMessage('LANDING_IS_NOT_ADMIN_ERROR')
			);
			$result->setError($error);
		}
		else if (!Manager::checkFeature(Manager::FEATURE_PERMISSIONS_AVAILABLE))
		{
			$error->addError(
				'FEATURE_NOT_AVAIL',
				Loc::getMessage('LANDING_FEATURE_NOT_AVAIL_ERROR')
			);
			$result->setError($error);
		}
		// set rights
		else
		{
			$result->setResult(
				Rights::setOperationsForSite(
					$id,
					$rights
				)
			);
		}

		return $result;
	}

	/**
	 * Get rights about site.
	 * @param int $id Site id.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function getRights($id)
	{
		$result = new PublicActionResult();
		$error = new \Bitrix\Landing\Error;
		$result->setResult([]);
		$id = (int)$id;

		// check access for get rights
		if (!Manager::checkFeature(Manager::FEATURE_PERMISSIONS_AVAILABLE))
		{
			$error->addError(
				'FEATURE_NOT_AVAIL',
				Loc::getMessage('LANDING_FEATURE_NOT_AVAIL_ERROR')
			);
			$result->setError($error);
		}
		// get rights
		else
		{
			$result->setResult(
				Rights::getOperationsForSite(
					$id
				)
			);
		}

		return $result;
	}

	/**
	 * Upload file by url or from FILE.
	 * @param int $id Site id.
	 * @param string $picture File url / file array.
	 * @param string $ext File extension.
	 * @param array $params Some file params.
	 * @return \Bitrix\Landing\PublicActionResult
	 */
	public static function uploadFile($id, $picture, $ext = false, array $params = array())
	{
		static $internal = true;
		static $mixedParams = ['picture'];

		$result = new PublicActionResult();
		$result->setResult(false);
		$error = new \Bitrix\Landing\Error;
		$id = (int)$id;

		$res = SiteCore::getList(array(
			'filter' => array(
				'ID' => $id
			)
		));

		if ($res->fetch())
		{
			$file = Manager::savePicture($picture, $ext, $params);
			if ($file)
			{
				File::addToSite($id, $file['ID']);
				$result->setResult(array(
					'id' => $file['ID'],
					'src' => $file['SRC']
				));
			}
			else
			{
				$error->addError(
					'FILE_ERROR',
					Loc::getMessage('LANDING_FILE_ERROR')
				);
				$result->setError($error);
			}
		}


		return $result;
	}
}