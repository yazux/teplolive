<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (intval($_REQUEST['r']) == 1){
    $an = true;
    $rel =false;
    $APPLICATION->SetPageProperty("title", "Аналогичные товары");
}
elseif (intval($_REQUEST['r']) == 2) {
    $an = false;
    $rel = true;
    $APPLICATION->SetPageProperty("title", "Сопутствующие товары");
}
else {
    echo "<p>Возможно вы попали на эту страницу по ошибке</p>";
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
    die();
}
$ownerId = intval($_REQUEST['id']);
if ($ownerId == false) {
    echo "<p>Возможно вы попали на эту страницу по ошибке</p>";
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
    die();
}
?>
<?

?>
<?
CModule::IncludeModule("iblock");
$unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$ownerId), false, Array("UF_ANALOG"));
if($Twilight=$unicorn->GetNext()){}
//echo "<pre>"; print_r($Twilight); echo "</pre>";
//$pathString = '/'.$Twilight['CODE'];
//$APPLICATION->AddChainItem($Twilight['NAME'], $pathString);
if ($an == true){
    //$APPLICATION->AddChainItem("Аналогичные товары", "");
    $pathString = "Аналогичные товары для ".$Twilight['NAME'];
}
else {
    //$APPLICATION->AddChainItem("Сопутствующие товары", "");
    $pathString = "Сопутствующие товары для ".$Twilight['NAME'];
}
$APPLICATION->AddChainItem($pathString, "");
foreach ($Twilight["UF_ANALOG"] as $Spike => $Rarity) {
    if ($Rarity > 0) {
        $arAnalogId[] = $Rarity;
    }
    else {
        //    echo "нет элементов";
    }
}
?>
<?if(!empty($arAnalogId) && $an == true):?>
    <div class="related-title">Аналогичные товары для <?=$Twilight['NAME']?></div>
<div class='analog'>
    <?$APPLICATION->IncludeComponent(
    "arcline:catalog.section.list",
    "related-catalog",
    Array(
        "IBLOCK_TYPE" => 'Catalog',
        "IBLOCK_ID" => 8,
        //"ALICORN" => $arParams['ALICORN'],
        "ANALOG_ID" => $arAnalogId,
        "SECTION_ID" => $arAnalogId,
        "SECTION_CODE" => ''/*$arResult["VARIABLES"]["SECTION_CODE"]*/,
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "ADD_SECTIONS_CHAIN" => "N",
        "SECTION_URL" => "/catalog/#CODE#/",
    ),
    $component
);?>
</div>
<?endif;?>
<?
$unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$ownerId),false, Array("UF_RELATED"));
if($Lyra=$unicorn->GetNext()){}
foreach ($Lyra["UF_RELATED"] as $Fluttershy => $Angel) {
    if ($Angel > 0) {
        $arRelatedId[] = $Angel;
    }
    else {
        //        echo "нет элементов";
    }
}
?>
<?if(!empty($arAnalogId) && $rel == true):?>
<div class="related-title">Сопутствующие товары для <?=$Twilight['NAME']?></div>
<div class='analog'>
    <?$APPLICATION->IncludeComponent(
    "arcline:catalog.section.list",
    "related-catalog",
    Array(
        "IBLOCK_TYPE" => "Catalog",
        "IBLOCK_ID" => 8,
        //"ALICORN" => $arParams['ALICORN'],
        "RELATED" => 'Y',
        "ANALOG_ID" => $arRelatedId,
        "SECTION_ID" => $arRelatedId,
        "SECTION_CODE" => ''/*$arResult["VARIABLES"]["SECTION_CODE"]*/,
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "ADD_SECTIONS_CHAIN" => "N",
        "SECTION_URL" => "/catalog/#CODE#/",
    ),
    $component
);?>
</div>
<?endif;?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>