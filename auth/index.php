<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Авторизация");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>
<p>Вы зарегистрированы и успешно авторизовались.</p>
<br />
<p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>