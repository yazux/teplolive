<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<div class='personal-menu'>
    <p class='my-order'>Мои заказы</p>
    <a href='/personal/profile/' class='profile'>Ваш профиль</a>
	 <a href='/personal/quick-order/' class='profile'>Быстрый заказ</a>
    <div class="clear"></div>
</div>
   <?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "personal-order", Array(
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"ORDERS_PER_PAGE" => "20",	// Количество заказов на одной странице
	"PATH_TO_PAYMENT" => "payment.php",	// Страница подключения платежной системы
	"PATH_TO_BASKET" => "/cart/",	// Страница с корзиной
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
	"NAV_TEMPLATE" => "",	// Имя шаблона для постраничной навигации
	"PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
	"PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
	"SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
	"SEF_URL_TEMPLATES" => array(
		"list" => "index.php",
		"detail" => "personal/index.php?ID=#ID#",
		"cancel" => "order_cancel.php?ID=#ID#",
	),
	"VARIABLE_ALIASES" => array(
		"list" => "",
		"detail" => array(
			"ID" => "ID",
		),
		"cancel" => array(
			"ID" => "ID",
		),
	)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>