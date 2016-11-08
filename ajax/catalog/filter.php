<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->RestartBuffer();?>
<?GLOBAL $arrFilter;?>
<?$APPLICATION->IncludeComponent("arcline:cat.filter.new", ".default", Array(
	"SECTION_ID" => "296",
	"FILTER_NAME" => "arrFilter",
	"AJX" => "Y"
	),
	false
);?>	
