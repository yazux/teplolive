<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class='catalog-left-column'>
<?  $APPLICATION->IncludeComponent("bitrix:menu", "catalog-multilevel", array(
	"ROOT_MENU_TYPE" => "left",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "4",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
?>

</div>
</div>
<?/*$APPLICATION->IncludeComponent(
						"arcline:cat.sort",
						"",
						array (
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NAME" => $arParams["COMPARE_NAME"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],)
);  */
?> 
<!--</div>-->
<?//echo "<pre>"; print_r($_REQUEST); echo "</pre>";?>
<?if ($_REQUEST['catajaxrequest'] == 'Y')
  {
    $APPLICATION->RestartBuffer();  
  }
?>
<div class='catalog'>
<?
    $arSelect78 = array("UF_*");
    $arFilter78 = array(
    "IBLOCK_ID"        => 8,
    "IBLOCK_ACTIVE"    =>"Y",
    "DEPTH_LEVEL"      => 1
    );
    $lich = CIBlockSection::GetList(Array(), $arFilter78, false, $arSelect78);
    while($leoric = $lich->GetNextElement())
    {
        $ursa[] = $leoric->GetFields();
    }
    foreach ($ursa as $roshan) {
        $ursaId[] = $roshan['ID'];
    }
?>
<?GLOBAL $arrFilter;?>
<?
if (!empty($arrFilter)){
    $arFilter = array(
            "IBLOCK_ID" => 8                                                                                 
            );
    $mergedFilter = array_merge($arFilter, $arrFilter);            
        $res = CIBlockElement::GetList(Array(), $mergedFilter, false, false);
        while($ob = $res->GetNextElement())
        {
            $arSmall[] = $ob->GetFields();
        }    
    foreach ($arSmall as $arSectId) {
        $arSectionId[] = $arSectId['IBLOCK_SECTION_ID'];    
    }
}
?>
<div>
    <?$APPLICATION->IncludeComponent(
        "arcline:catalog.section.list.root",
        "main-catalog-modified",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "ANALOG_ID" => $ursaId,
            "SECTION_ID" =>  $arParams["SECTION_ID_VARIABLE"],
            "itemCount" => $_SESSION["SHOW_COUNT"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            "ADD_SECTIONS_CHAIN" => "N",
            "ALICORN" => $arParams['ALICORN']
        ),
        $component
        );
    ?>
<?/*$APPLICATION->IncludeComponent(
	"arcline:catalog.section.list",
	"main-catalog",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "ANALOG_ID" => $arSectionId,
        "SECTION_ID" =>  $arParams["SECTION_ID_VARIABLE"],
        "itemCount" => $_SESSION["SHOW_COUNT"],      
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "ADD_SECTIONS_CHAIN" => "N",
        "ALICORN" => $arParams['ALICORN']
	),
	$component
);*/
?>
</div>
<?if ($_REQUEST['catajaxrequest'] == 'Y')
  {
    die();  
  }
?>