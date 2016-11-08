<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("arcline:menu.sections", "", array(
	"IS_SEF" => "N",
	"ID" => $_REQUEST["ELEMENT_ID"],
	"IBLOCK_TYPE" => "News",
	"IBLOCK_ID" => "2",
	"SECTION_URL" => "/news/?SECTION_ID=#ID#",
	"DEPTH_LEVEL" => "1",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => ""
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>