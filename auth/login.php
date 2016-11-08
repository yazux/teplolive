<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Авторизация");
if (intval($_REQUEST['AJAX']) == 2):
        $GLOBALS['APPLICATION']->RestartBuffer();
    endif;
?>
<?if (intval($_REQUEST['AJAX']) == 2):?>

<?else:?>
<h2>Авторизация</h2>
<?endif;?>
<?if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0)
    echo $_REQUEST["backurl"];
    LocalRedirect($backurl);
?>
<p>Вы зарегистрированы и успешно авторизовались.</p>
<p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>
<?if (intval($_REQUEST['AJAX']) == 2):?>
    <?die(); ?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>