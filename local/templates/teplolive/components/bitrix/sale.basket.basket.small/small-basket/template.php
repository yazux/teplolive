<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST['basketClear']=='1') LocalRedirect($APPLICATION->GetCurDir());?>
<div class='small-basket'>
<?
function fn_ReplaceForm($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
$n1 = $n % 10;
if ($n > 10 && $n < 20) return $form5;
if ($n1 > 1 && $n1 < 5) return $form2;
if ($n1 == 1) return $form1;
return $form5;
}
?>
		<?if (strlen($arParams["PATH_TO_BASKET"])>0):?>
            <form method="get" action="<?=$arParams["PATH_TO_BASKET"]?>">
			     <input class='basket-button' type="submit" value="Корзина">
			</form>
		<?endif;?>
  		<?foreach ($arResult["ITEMS"] as $arItems) {
            $itog[] = $arItems['PRICE'] * $arItems['QUANTITY'];
            $col++;
        }
        if (($itog > 0) && ($col > 0)) 
            echo "<span>".$col.fn_ReplaceForm($col, ' товар', ' товара', ' товаров')." на сумму ".number_format(array_sum($itog), 0, ',', ' ')." руб";
        else
            echo "<span>у вас нет товаров</span>";    
		?>
		<?if (strlen($arParams["PATH_TO_ORDER"])>0):?>
			<form method="get" action="<?= $arParams["PATH_TO_ORDER"] ?>">
			     <input type="submit" class='order-button' value="оформить заказ<?//= GetMessage("TSBS_2ORDER") ?>">
			</form>
		<?endif;?>
        <form>               
            <a class='clear-button' href='<?=$APPLICATION->GetCurPageParam("basketClear=1", array("basketClear"))?>'>очистить</a>
	    </form>
	<?//endif;?>
 <?//endif;?>
 <div class='clear'></div>
</div>