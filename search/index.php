<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Поиск");
$APPLICATION->SetTitle("Поиск");?>

<?CModule::IncludeModule("iblock");?>
<div class="search-page" style="margin-bottom:20px;">	
	<form action="" method="get">
		<input name="q" value="<?if(strlen($_REQUEST["q"])>0){?><?=$_REQUEST["q"];?><?}?>" type="text">
		&nbsp;<input class="search-go" value="" type="submit">
	</form>
</div>
<?if(strlen($_REQUEST["q"])>0){?>
	<?
		$arSectionsReally=array();
		$arSectionsFromElements=array();
		$arInfosklad=array();
	?>
	<?/*ищем разделы инфоблока каталога товаров, в названии которых есть поисковые символы*/?>
	<?	
		$arSelect=array("IBLOCK_ID","ID","IBLOCK_TYPE","NAME");
		$arFilter = Array('IBLOCK_ID'=>8, "NAME"=>"%".$_REQUEST["q"]."%", "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y");
		$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true,$arSelect);
		if(intval($db_list->SelectedRowsCount())>0){
			while($ar_result = $db_list->GetNext()){
				$arSectionsReally[]=$ar_result["ID"];
			}
		}
	?>
	<?/*ищем разделы инфоблока каталога товаров, в которых есть элементы, подходящие по поисковому запросу*/?>
	<?
		$arSelectTwo = Array("ID", "IBLOCK_ID", "NAME", "SECTION_ID");
		$arFilterTwo = Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y");
		$arFilterTwo[] = array(
		    "LOGIC" => "OR",
				array("NAME"=>"%".$_REQUEST["q"]."%"),
				array("PROPERTY_CML2_ARTICLE"=>"%".$_REQUEST["q"]."%")
		); 
		$resTwo = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilterTwo, array("IBLOCK_SECTION_ID"), false, $arSelectTwo);
		if(intval($resTwo->SelectedRowsCount())>0){
			while($obTwo = $resTwo->GetNextElement()){
				$arFieldsTwo = $obTwo->GetFields();  
				if(intval($arFieldsTwo["IBLOCK_SECTION_ID"])>0){
					$arSectionsFromElements[]=$arFieldsTwo["IBLOCK_SECTION_ID"];
				}
			}
		}
	?>
	<?$arSections=array_merge($arSectionsReally,$arSectionsFromElements);?>
	<?$arSections=array_unique($arSections);?>
	
	<?/*находим элементы инфосклада*/?>
	<?
		$arSelectInfo = Array("ID", "IBLOCK_ID", "NAME", "SECTION_ID");
		$arFilterInfo = Array("IBLOCK_ID"=>3, "ACTIVE"=>"Y", "NAME"=>"%".$_REQUEST["q"]."%");
		$resInfo = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilterInfo, false, false, $arSelectInfo);
		if(intval($resInfo->SelectedRowsCount())>0){
			while($obInfo = $resInfo->GetNextElement()){
				$arFieldsInfo = $obInfo->GetFields();
				$arInfosklad[]=$arFieldsInfo["ID"];
			}
		}
	?>
	<?if (!empty($arSections)):?>
		<a href='<?echo $APPLICATION->GetCurPageParam("filter=2", array("filter"))?>' class='poisk-1 <?
        if (intval($_REQUEST['filter']) == 2 || (empty($_REQUEST['filter']))){ echo "current-page";}
        ?>'>Каталог (<?=count($arSections);?>)</a>
	<?endif;?>
	
	<?if(!empty($arInfosklad)):?>
		<a href='<?echo $APPLICATION->GetCurPageParam("filter=4", array("filter"))?>' class='poisk-1 <?
			if (intval($_REQUEST['filter']) == 4 || (empty($_REQUEST['filter']) && (empty($arSections)))){echo "current-page";}?>'>Инфосклад (<?=count($arInfosklad);?>)</a>
	<?endif;?>
	<?
	if (intval($_REQUEST['filter']) == 2){
		$cat = true;
		$news = false;
		$info = false;
	}
	elseif (intval($_REQUEST['filter']) == 3){
		$cat = false;
		$news = true;
		$info = false;
	}
	elseif (intval($_REQUEST['filter']) == 4){
		$cat = false;
		$news = false;
		$info = true;
	}
	else {
		if (!empty($arSections)){
			$cat = true;
			$news = false;
			$info = false;
		}
		elseif(count($newsId["ID"]) > 0) {
			$cat = false;
			$news = true;
			$info = false;
		}
		elseif(!empty($arInfosklad)) {
			$cat = false;
			$news = false;
			$info = true;
		}
	}
	?>

	<?if ($cat == true && !empty($arSections)){?>
	<?$APPLICATION->IncludeComponent("arcline:catalog.section.list", "related-catalog", array(
		"IBLOCK_TYPE" => "Catalog",
		"IBLOCK_ID" => "8",
		"SECTION_ID" => $GLOBALS["catItem"],
		"ANALOG_ID" => $arSections,
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_URL" => "/catalog/#CODE#/",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "N" 
		),
		$component
	);?>
	<?}?>

	<?if(!empty($arInfosklad) && $info == true){?>
	<?$infoId=array("ID"=>$arInfosklad);?>
	<br>
	<br>
	<br>
	<?$APPLICATION->IncludeComponent("bitrix:news.list", "info", array(
			"IBLOCK_TYPE" => "infowarehouse",
			"IBLOCK_ID" => "3",
			"NEWS_COUNT" => "8",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "infoId",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array("FILE"),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "/content/news/index.php?news=#ELEMENT_ID#",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"PREVIEW_TRUNCATE_LEN" => "0",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "Y",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "arrow",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_OPTION_ADDITIONAL" => ""
		),
		false
	);?>
	<?}?>
	<?if((empty($arSections))&&(empty($arInfosklad))){?>
		<span class="blue">По Вашему поисковому запросу не найдено ни одного результата. </span>
	<?}?>

<?}else{?>
	<span class="blue">Введите, пожалуйста, поисковый запрос.</span>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
<?}?>


<?/*$APPLICATION->IncludeComponent("bitrix:search.page", "poisk1", array(
	"RESTART" => "N",
	"NO_WORD_LOGIC" => "Y",
	"CHECK_DATES" => "Y",
	"USE_TITLE_RANK" => "N",
	"DEFAULT_SORT" => "rank",
	"FILTER_NAME" => "",
	"arrFILTER" => array(
	),
	"SHOW_WHERE" => "N",
	"SHOW_WHEN" => "N",
	"PAGE_RESULT_COUNT" => "9999",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Результаты поиска",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"USE_LANGUAGE_GUESS" => "N",
	"TAGS_SORT" => "NAME",
	"TAGS_PAGE_ELEMENTS" => "20",
	"TAGS_PERIOD" => "",
	"TAGS_URL_SEARCH" => "",
	"TAGS_INHERIT" => "Y",
	"FONT_MAX" => "50",
	"FONT_MIN" => "10",
	"COLOR_NEW" => "000000",
	"COLOR_OLD" => "C8C8C8",
	"PERIOD_NEW_TAGS" => "",
	"SHOW_CHAIN" => "Y",
	"COLOR_TYPE" => "Y",
	"WIDTH" => "100%",
	"USE_SUGGEST" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?
$newsId = array("ID" => $GLOBALS['newsItem']);
$infoId = array("ID" => $GLOBALS['infoItem']);
?>
<?if (!empty($GLOBALS['catItem'])):?>
    <a href='<?echo $APPLICATION->GetCurPageParam("filter=2", array("filter"))?>' class='poisk-1 <?
        if (intval($_REQUEST['filter']) == 2 || (empty($_REQUEST['filter']))){ echo "current-page";}
        ?>'>Каталог</a>
<?endif;?>
<?if(count($newsId["ID"]) > 0):?>
<a href='<?echo $APPLICATION->GetCurPageParam("filter=3", array("filter"))?>' class='poisk-1 <?
if (intval($_REQUEST['filter']) == 3 || (empty($_REQUEST['filter']) && (empty($GLOBALS['catItem'])))){echo "current-page";}?>'>Новости</a>
<?endif;?>
<?if(count($infoId["ID"]) > 0):?>
    <a href='<?echo $APPLICATION->GetCurPageParam("filter=4", array("filter"))?>' class='poisk-1 <?
        if (intval($_REQUEST['filter']) == 4 || (empty($_REQUEST['filter']) && (empty($GLOBALS['catItem'])) && (count($newsId["ID"]) < 1))){echo "current-page";}?>'>Инфосклад</a>
<?endif;?>
<div class='search-cat-push'></div>
<?
if (intval($_REQUEST['filter']) == 2){
    $cat = true;
    $news = false;
    $info = false;
}
elseif (intval($_REQUEST['filter']) == 3){
    $cat = false;
    $news = true;
    $info = false;
}
elseif (intval($_REQUEST['filter']) == 4){
    $cat = false;
    $news = false;
    $info = true;
}
else {
    if (!empty($GLOBALS['catItem'])){
        $cat = true;
        $news = false;
        $info = false;
    }
    elseif(count($newsId["ID"]) > 0) {
        $cat = false;
        $news = true;
        $info = false;
    }
    elseif(count($infoId["ID"]) > 0) {
        $cat = false;
        $news = false;
        $info = true;
    }
}
?>



    	
    	



<?//pr($GLOBALS['catItem'])?>
<?if ($cat == true && !empty($GLOBALS['catItem'])):?>
<?//echo "123";?>

<div class='analog'>
    <?$APPLICATION->IncludeComponent("arcline:catalog.section.list", "related-catalog", array(
	"IBLOCK_TYPE" => "Catalog",
	"IBLOCK_ID" => "8",
	"SECTION_ID" => $GLOBALS["catItem"],
	"ANALOG_ID" => $GLOBALS["catItem"],
	"SECTION_CODE" => "",
	"COUNT_ELEMENTS" => "N",
	"TOP_DEPTH" => "2",
	"SECTION_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "/catalog/#CODE#/",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "",
	"CACHE_GROUPS" => "N",
	"ADD_SECTIONS_CHAIN" => "N" 
	),
	$component
);?>
</div>
<?endif;?>
<?if(count($newsId["ID"]) > 0 && $news == true):?>
<div>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "news", array(
        "IBLOCK_TYPE" => "News",
        "IBLOCK_ID" => "2",
        "NEWS_COUNT" => "8",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "newsId",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "/content/news/index.php?news=#ELEMENT_ID#",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "0",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "arrow",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);?>
</div>
    <?endif;?>
<?if(count($infoId["ID"]) > 0 && $info == true):?>
 <div>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "info", array(
        "IBLOCK_TYPE" => "infowarehouse",
        "IBLOCK_ID" => "3",
        "NEWS_COUNT" => "8",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "infoId",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "PROPERTY_CODE" => array("FILE"),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "/content/news/index.php?news=#ELEMENT_ID#",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "0",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "arrow",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);?>
</div>
<?endif;*/?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>