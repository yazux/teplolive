<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Нужна помощь?");
$APPLICATION->SetTitle("Нужна помощь?");
?><div> 
  <?if (htmlspecialchars($_REQUEST['ResultAdd']) !== 'success'):?>
        <p class='help-string'>
            Задайте нам интересующий вас вопрос.
        </p>
  <?endif;?>
    <?CModule::IncludeModule("iblock");?>
    <? require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/teplolive/include/CArclineWorkFormHelp.php');
    $object = new CArclineWorkForm_main_form(300);
    $object->fn_ShowForm();?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>