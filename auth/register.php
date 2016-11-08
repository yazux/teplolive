<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Регистрация");
$APPLICATION->SetTitle("Регистрация");
?>
<?$APPLICATION->IncludeComponent("arcline:main.register", "registration-page", Array(
	"SHOW_FIELDS" => array(	// Поля, которые показывать в форме
		0 => "NAME",
		1 => "LAST_NAME",
	),
	"REQUIRED_FIELDS" => "",	// Поля, обязательные для заполнения
	"AUTH" => "Y",	// Автоматически авторизовать пользователей
	"USE_BACKURL" => "Y",	// Отправлять пользователя по обратной ссылке, если она есть
	"SUCCESS_PAGE" => "",	// Страница окончания регистрации
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"USER_PROPERTY" => "",	// Показывать доп. свойства
	"USER_PROPERTY_NAME" => "",	// Название блока пользовательских свойств
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>