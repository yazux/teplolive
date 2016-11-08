<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Каталог");
$APPLICATION->SetTitle("Каталог");
?>
<?
CModule::IncludeModule("iblock");
$iblock_id=8;
$arIBlock=GetIBlock($iblock_id);
    
if ((strlen($_REQUEST["SECTION_CODE"])>0) || intval($_REQUEST["SECTION_ID"]) > 0)
{
  $arFilter = Array('IBLOCK_ID'=>$arIBlock["ID"]);
  if (intval($_REQUEST["SECTION_ID"]) > 0) {
    $arFilter['ID']= intval($_REQUEST["SECTION_ID"]);
 }
 else {
  $section_code=fn_getSectionCode($_REQUEST["SECTION_CODE"]);
  $arFilter['CODE'] = $section_code;
  }
  $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
  $arSection = $db_list->GetNext();
  $APPLICATION->SetTitle($arSection["NAME"]);

    $nav = CIBlockSection::GetNavChain($arSection['IBLOCK_ID'], $arSection['ID']);       
    //$arSection['ID'];
    $i=0;
    if (strlen($_REQUEST["ELEMENT_CODE"])>0) $i=-1; 
    while($arChain=$nav->GetNext()){
    $i++; 
    $APPLICATION->AddChainItem($arChain["NAME"], (($i!=$nav->SelectedRowsCount())? fn_get_chainpath($arChain['IBLOCK_ID'], $arChain['ID']):''));
}
	  
 
}
  $arSelect = Array("ID", "NAME");
  $arFilter = Array("IBLOCK_ID"=>$arIBlock["ID"], "SECTION_ID"=>$arSection["ID"], "ACTIVE"=>"Y");

  if (strlen($_REQUEST["ELEMENT_CODE"])>0) 
  {
   $arFilter["CODE"]= htmlspecialchars($_REQUEST["ELEMENT_CODE"]);
  }  
 
  $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
  
  if ($res->SelectedRowsCount()==1)
  {
   $arItem=$res->GetNext();
   $APPLICATION->AddChainItem($arItem["NAME"]);
  }
  
  
  $APPLICATION->sDocPath2 = '/catalog/'.$arSection['CODE'].'/';	

		$APPLICATION->sDocPath2 .= 'index.php';
 
?>

<?/*$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main-catalog", array(
	"IBLOCK_TYPE" => "Catalog",
	"IBLOCK_ID" => "4",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"COUNT_ELEMENTS" => "N",
	"TOP_DEPTH" => "2",
	"SECTION_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "MIN_PRICE",
	),
	"SECTION_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y"
	),
	false
);*/?>

<?//echo $arSection['ID']?>
<?$APPLICATION->IncludeComponent("bitrix:catalog", "catalog-template", array(
	"ALICORN" => $arSection['ID'],
    "IBLOCK_TYPE" => "Catalog",
	"IBLOCK_ID" => "8",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => $arSection["ID"],
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/catalog/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"USE_FILTER" => "N",
	"USE_REVIEW" => "N",
	"USE_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "Основная цена продажи",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"USE_PRODUCT_QUANTITY" => "Y",
	"CONVERT_CURRENCY" => "Y",
	"CURRENCY_ID" => "RUB",
	"OFFERS_CART_PROPERTIES" => array(
		0 => "CML2_LINK",
	),
	"SHOW_TOP_ELEMENTS" => "N",
	"SECTION_COUNT_ELEMENTS" => "N",
	"PAGE_ELEMENT_COUNT" => "20",
	"LINE_ELEMENT_COUNT" => "20",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "CML2_BASE_UNIT",
		1 => "CML2_TRAITS",
		2 => "CML2_ATTRIBUTES",
		3 => "CML2_BAR_CODE",
		4 => "MAXTIME",
		5 => "PODA4A",
		6 => "PODEM",
		7 => "MOWNOSTb",
		8 => "REZBA",
		9 => "",
	),
	"INCLUDE_SUBSECTIONS" => "N",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"LIST_OFFERS_FIELD_CODE" => array(
		0 => "NAME",
		1 => "",
	),
	"LIST_OFFERS_PROPERTY_CODE" => array(
		0 => "CML2_LINK",
		1 => "",
	),
	"LIST_OFFERS_LIMIT" => "0",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "MOWNOSTb",
		2 => "REZBA",
		3 => "",
	),
	"DETAIL_META_KEYWORDS" => "-",
	"DETAIL_META_DESCRIPTION" => "-",
	"DETAIL_BROWSER_TITLE" => "-",
	"DETAIL_OFFERS_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"DETAIL_OFFERS_PROPERTY_CODE" => array(
		0 => "CML2_LINK",
		1 => "",
	),
	"LINK_IBLOCK_TYPE" => "Catalog",
	"LINK_IBLOCK_ID" => "6",
	"LINK_PROPERTY_SID" => "CML2_LINK",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
	"USE_ALSO_BUY" => "N",
	"OFFERS_SORT_FIELD" => "sort",
	"OFFERS_SORT_ORDER" => "asc",
	"DISPLAY_TOP_PAGER" => "Y",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_CODE#/",
		"element" => "#SECTION_CODE#/",
		"compare" => "compare.php?action=#ACTION_CODE#",
	),
	"VARIABLE_ALIASES" => array(
		"compare" => array(
			"ACTION_CODE" => "action",
		),
	)
	),
	false
);?>

<?fn_setCatalogApplicationPath($iblock_id, $APPLICATION->GetCurDir());?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>