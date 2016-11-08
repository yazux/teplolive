<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $key=>$arItem ) {
    $arOffer= GetIblockElement($arItem["PRODUCT_ID"]);
    $arElement=GetIblockElement($arOffer["PROPERTIES"]["CML2_LINK"]["VALUE"]);
    $arResult["ITEMS"]["AnDelCanBuy"][$key]["PREVIEW_TEXT"]=$arElement["PREVIEW_TEXT"];
    $arResult["ITEMS"]["AnDelCanBuy"][$key]["ELEMENT_PROPERTIES"]=$arElement["PROPERTIES"];
    $arResult["ITEMS"]["AnDelCanBuy"][$key]["PICTURE"] = CFile::GetPath($arElement["PREVIEW_PICTURE"]);;
}  
?>
