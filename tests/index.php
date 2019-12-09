<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тесты");
?>

<section id="tests">
<div class="wrapper">
	<h1>Тесты</h1>
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
</div>
 </section> <section id="results">
<div class="inner-wrap">
</div>
<div class="results__content">
	<h2>Результаты тестирования</h2>
	<a href="/tests/results/" class="btn">
		 СМОТРЕТЬ РЕЗУЛЬТАТЫ
	</a>
</div>
 </section>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . "/include/request_form.php",
    Array(),
    Array(
        "MODE" => "html")
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

<script>
	$(function(){
		$('a[href^="#"]').on('click', function(event) { 
		event.preventDefault();
		    var src = $(this).attr("href"),
		    sectionPosition = $(src).offset().top - 30;
		    $('html, body').animate({scrollTop: sectionPosition}, 1000);
		});
	});

	function smoothToBlock() {
		event.preventDefault();
	    var src = '#' + $(event.target).attr("href").split('#')[1];
	    console.log(src);
	    var sectionPosition = $(src).offset().top - 30;
	    $('html, body').animate({scrollTop: sectionPosition}, 1000);
	}

	jQuery(document).ready(function($) {
		var myHash = location.hash; //получаем значение хеша
		location.hash = ''; //очищаем хеш
		if(myHash[1] != undefined){ //проверяем, есть ли в хеше какое-то значение
		$('html, body').animate(
		{scrollTop: $(myHash).offset().top - 30}
		, 1000); //скроллим за полсекунды
		location.hash = myHash; //возвращаем хеш
		};
	});
</script>