<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?>


<div class="wrapper">

<section id="tests">




<? if (!empty($result_intersect_admin)) { ?>
	<a href="/tests/" class="logo"><h2>Тесты</h2></a>
<? }  elseif (empty($result_intersect_admin)) { ?>
	<h2>Тесты</h2>
<? } ?>




<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"tests",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_PICTURE",2=>"DETAIL_TEXT",3=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"TEST_ICON",2=>"",),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?> 



</section>
	
<?
$APPLICATION->IncludeFile(
    SITE_DIR . "/include/about.php",
    Array(),
    Array(
        "MODE" => "html")
);
?> 

<section id="courses">
	<h2>Курсы для обучения</h2>
	<div class="box">
		<div class="courses__item">
			<div class="item__icon">
			</div>
			<div class="item__title">
				 Охрана труда
			</div>
			<p>
				 проводится в&nbsp;соответствии с&nbsp;Порядком обучения по&nbsp;охране труда и&nbsp;проверки знаний требований охраны труда №&nbsp;1/29 от&nbsp;13.01.2003 г.
			</p>
			<div class="btn">
				 ПЕРЕЧЕНЬ ДОКУМЕНТОВ
			</div>
		</div>
		<div class="courses__item">
			<div class="item__icon">
			</div>
			<div class="item__title">
				 Пожарно-технический минимум
			</div>
			<p>
				 проводится в&nbsp;соответствии с&nbsp;Приказом от&nbsp;12 декабря 2007 года N&nbsp;645 «Об&nbsp;утверждении Норм пожарной безопасности «Обучение мерам пожарной безопасности работников организаций»
			</p>
			<div class="btn">
				 ПЕРЕЧЕНЬ ДОКУМЕНТОВ
			</div>
		</div>
		<div class="courses__item">
			<div class="item__icon">
			</div>
			<div class="item__title">
				 Экологическая безопасность
			</div>
			<p>
				 проводится в&nbsp;соответствии с&nbsp;Федеральным законом №&nbsp;89-ФЗ «Об&nbsp;отходах производства и&nbsp;потребления».
			</p>
			<div class="btn">
				 ПЕРЕЧЕНЬ ДОКУМЕНТОВ
			</div>
		</div>
	</div>
 </section>

</div>
 <!-- end of wrapper --> 


<?
$APPLICATION->IncludeFile(
    SITE_DIR . "/include/request_form.php",
    Array(),
    Array(
        "MODE" => "html")
);
?> 



<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>