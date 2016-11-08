<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<div class='personal-menu'>
    <a href='/personal/' class='profile'>Мои заказы</a>
        <p class='my-order'>Ваш профиль</p>
		<a href='/personal/quick-order/' class='profile'>Быстрый заказ</a>
    <div class="clear"></div>
</div>
    <h2>Профиль пользователя</h2>
<?$APPLICATION->IncludeComponent("bitrix:main.profile", "teplolive-profile", Array(
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>