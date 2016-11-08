<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach ($arResult["SECTIONS"] as $key=>$arItem) {
    $arResult["SECTIONS"][$key]['SECTION_PAGE_URL']=fn_get_chainpath($arItem["IBLOCK_ID"], $arItem["IBLOCK_SECTION_ID"]).$arItem["CODE"]."/";
}
?>