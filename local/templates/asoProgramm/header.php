<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>

<head>
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle();?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 	
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:300,400,500,700|Roboto:300,400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="/local/templates/asoProgramm/css/app.css">
</head>

<body>

	<div id="panel">
		<?$APPLICATION->ShowPanel();?>
	</div>

<?
$arGroupAvalaibleStudents = array(5);
$arGroupAvalaibleAdmin = array(1);
$arGroups = CUser::GetUserGroup($USER->GetID());
$result_intersect_students = array_intersect($arGroupAvalaibleStudents, $arGroups);
$result_intersect_admin = array_intersect($arGroupAvalaibleAdmin, $arGroups);

global $USER;
if ($USER->IsAuthorized()) { 
	if(!empty($result_intersect_students)) {

		if ($APPLICATION->GetCurPage(false) == '/') {
			LocalRedirect("/tests/");
		}
?>

<? } 

	elseif (!empty($result_intersect_admin)) { ?>

		<?
			$APPLICATION->IncludeFile(
			    SITE_DIR . "/include/header_admin.php",
			    Array(),
			    Array(
			        "MODE" => "html")
			);
		?>
			
	<? }

} elseif (!$USER->IsAuthorized()) { 
	if ($APPLICATION->GetCurPage(false) !== '/') {
		LocalRedirect("/");
	} ?>


	<?
		$APPLICATION->IncludeFile(
		    SITE_DIR . "/include/header_not_authorized.php",
		    Array(),
		    Array(
		        "MODE" => "html")
		);
	?>

<? } ?>

	
