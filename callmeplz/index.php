<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказать звонок");
?>
<?/*if (intval($_REQUEST["AJAX"]) == 2) {*/$APPLICATION->RestartBuffer();/*}*/?>
<div class='callmeplz'>
    <h2>Заказать звонок</h2>
    <?if (htmlspecialchars($_REQUEST['ResultAdd']) !== 'success'):?>
        <p class='calldesc'>
            Оставьте интернет-заявку на звонок,
            и наши менеджеры свяжутся с Вами
            в ближайшее врмея.
        </p>
     <?endif;?>
    <?CModule::IncludeModule("iblock");?>
    <? require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/teplolive/include/CArclineWorkForm.php');
    $object = new CArclineWorkForm_main_form(293);
    $object->fn_ShowForm();?>
</div>
<?/*if (intval($_REQUEST["AJAX"]) == 2):*/?>
    <?die();?>
<?/*endif;*/?>
<?if (!empty($_SERVER['HTTP_REFERER'])):?>
    <a href="<?=$_SERVER['HTTP_REFERER'];?>">Вернуться назад</a>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>