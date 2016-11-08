<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/teplolive/include/func.php');
CModule::IncludeModule('iblock');
$iblock_id=8;
$arIBlock=GetIBlock($iblock_id);
//if (intval($_REQUEST['SECTION_ID'])>0){
//	$GLOBALS['arrFilter']['SECTION_ID']=intval($_REQUEST['SECTION_ID']);
//}
//if (intval($_REQUEST['BRAND_CODE'])>0){
//	$GLOBALS['arrFilter']['PROPERTY_302_VALUE_ID']=intval($_REQUEST['BRAND_CODE']);
//}
?>
<?$APPLICATION->IncludeComponent("arcline:cat.filter.new", ".default", Array(
	"SECTION_ID" => "296",
	"FILTER_NAME" => "arrFilter",
	//"AJX" => "Y"
	),
	false
);?>
<?$APPLICATION->RestartBuffer();?>
<?//$APPLICATION->IncludeComponent("arcline:catalog.sortblock", '', Array());?>
<?
//if ($_SESSION['CAT_Q_ORDER']=='Y'){
//	$GLOBALS['arrFilter']['!CATALOG_QUANTITY']=0;	

//?> 
<?GLOBAL $arrFilter;?>
<?echo "!!<pre>"; print_r($arrFilter); echo "</pre>";?>
<?
echo $_REQUEST['SECTION_ID']; echo "!@#";
if (!empty($arrFilter)){
    $arFilter = array(
            "IBLOCK_ID" => 8,
            "SECTION_ID" => $_REQUEST['SECTION_ID'],
            "INCLUDE_SUBSECTIONS" => "Y"                                                                                
            );
    $mergedFilter = array_merge($arFilter, $arrFilter);            
    //echo "&&<pre>"; print_r($mergedFilter); echo "</pre>";
        $res = CIBlockElement::GetList(Array(), $mergedFilter, false, false);
        while($ob = $res->GetNextElement())
        {
            $arSmall[] = $ob->GetFields();
        }    
    foreach ($arSmall as $arSectId) {
        $arSectionId[] = $arSectId['IBLOCK_SECTION_ID'];    
    }
    //echo "&&<pre>"; print_r($arSectionId); echo "</pre>";
}
?>
<?//print_r($_REQUEST);?>
  $arSectionId = <?echo "&&<pre>"; print_r($arSectionId); echo "</pre>";?><br>
  $_REQUEST["SECTION_ID"] = <?echo "&&<pre>"; print_r($_REQUEST["SECTION_ID"]); echo "</pre>";?><br>
<?$APPLICATION->IncludeComponent(
	"arcline:catalog.section.list",
	"main-catalog",
	Array(
		"IBLOCK_TYPE" => 'Catalog',
		"IBLOCK_ID" => 8,
		"CACHE_TYPE" => "A",
        "ANALOG_ID" => $arSectionId,
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "itemCount" => $_SESSION["SHOW_COUNT"],      
		"CACHE_TIME" => 36000000,
		"CACHE_GROUPS" => "Y",
        "PRICE_CODE" => array(
		                     0 => "OCP"
	                   ),
		"COUNT_ELEMENTS" => "N",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "ADD_SECTIONS_CHAIN" => "N",
        "ALICORN" => $_REQUEST['SECTION_ID']
	),
	$component
);
?>   $45##$%@
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>