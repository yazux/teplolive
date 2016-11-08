<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach ($arResult["BASKET_ITEMS"] as $key => $arBasketItems ) {
    $arOffer= GetIblockElement($arBasketItems["PRODUCT_ID"]);
    $Lyra = $arBasketItems['PRICE']*$arBasketItems["QUANTITY"];
    $lyra = number_format($Lyra, 0, "", " ");
    if ($arBasketItems['CURRENCY'] == "RUB") {
        $lyra = $lyra." руб ";
    }
    else {
        $lyra = $lyra." у.е. ";
    }
    $arResult["BASKET_ITEMS"][$key]["MERGED_PRICE"] = $lyra; echo " ";
    $arResult["BASKET_ITEMS"][$key]["ARTICLE"]=$arOffer["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];
}
?>
