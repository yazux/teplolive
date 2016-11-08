<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    $title = $APPLICATION->GetProperty("title");
    $title = $arResult['NAME']." / ".$title;
    $APPLICATION->SetPageProperty("title", $title);
?>