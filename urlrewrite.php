<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#/info/(\\S+)/(\\S+).html(\\?*)(\\S*)#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/info/index.php",
	),
	array(
		"CONDITION" => "#/news/(\\S+)/(\\S+).html(\\?*)(\\S*)#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/news/index.php",
	),
	array(
		"CONDITION" => "#/news/(\\S+).html(\\?*)(\\S*)#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/news/index.php",
	),
	array(
		"CONDITION" => "#/info/(\\S+).html(\\?*)(\\S*)#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/info/index.php",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#/catalog/(\\S+)/*#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#/news/(\\S+)/*#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/news/index.php",
	),
	array(
		"CONDITION" => "#/info/(\\S+)/*#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/info/index.php",
	),
);

?>