<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Новости");
$APPLICATION->SetTitle("Новости");
?>
<?
    CModule::IncludeModule("iblock");
    $iblock_id=2;
    $arIBlock=GetIBlock($iblock_id);
    if (strlen($_REQUEST["SECTION_CODE"])>0)
    {
        $section_code=fn_getSectionCode($_REQUEST["SECTION_CODE"]);
        $arFilter = Array('IBLOCK_ID'=>$arIBlock["ID"],  'CODE'=>$section_code);
        $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
        $arSection = $db_list->GetNext();
        $APPLICATION->SetTitle($arSection["NAME"]);

        $nav = CIBlockSection::GetNavChain($arSection['IBLOCK_ID'], $arSection['ID']);

        $i=0;
        if (strlen($_REQUEST["ELEMENT_CODE"])>0) $i=-1;
        while($arChain=$nav->GetNext()){
            $i++;
            $APPLICATION->AddChainItem($arChain["NAME"], (($i!=$nav->SelectedRowsCount())? fn_get_chainpath($arChain['IBLOCK_ID'], $arChain['ID']):''));
        }


    }
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID"=>$arIBlock["ID"], "ACTIVE"=>"Y");

    if (strlen($_REQUEST["ELEMENT_CODE"])>0)
    {
        $arFilter["CODE"]= htmlspecialchars($_REQUEST["ELEMENT_CODE"]);
    }

    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    if ($res->SelectedRowsCount()==1)
    {
        $arItem=$res->GetNext();
        //echo "<pre>"; print_r($arItem); echo "</pre>";
        $APPLICATION->AddChainItem($arItem["NAME"]);
    }
    ?>
<?if (strlen($section_code) > 0):?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "news-years", array(
	"IBLOCK_TYPE" => "News",
	"IBLOCK_ID" => "2",
	"SECTION_ID" => "",
	"SECTION_CODE" => $section_code,
	"COUNT_ELEMENTS" => "Y",
	"TOP_DEPTH" => "2",
	"SECTION_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"ADD_SECTIONS_CHAIN" => "N"
	),
	false
);?>
<?endif;?>
<?if ($arItem['ID']>0):?>
<?$APPLICATION->IncludeComponent("bitrix:news.detail", "news-detail", array(
	"IBLOCK_TYPE" => "News",
	"IBLOCK_ID" => "2",
	"ELEMENT_ID" => $arItem["ID"],
	"ELEMENT_CODE" => "",
	"CHECK_DATES" => "Y",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "FILE",
		2 => "",
	),
	"IBLOCK_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"USE_PERMISSIONS" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Страница",
	"PAGER_TEMPLATE" => "",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"USE_SHARE" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?else:?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "news", array(
	"IBLOCK_TYPE" => "News",
	"IBLOCK_ID" => "2",
	"NEWS_COUNT" => "8",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
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
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => $section_code,
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
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>