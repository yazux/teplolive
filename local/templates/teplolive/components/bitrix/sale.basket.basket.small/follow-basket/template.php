<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class='follow-basket'>
<?
function fn_ReplaceForm1($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
$n1 = $n % 10;
if ($n > 10 && $n < 20) return $form5;
if ($n1 > 1 && $n1 < 5) return $form2;
if ($n1 == 1) return $form1;
return $form5;
}
?>
  		<?foreach ($arResult["ITEMS"] as $arItems) {
            $itog[] = $arItems['PRICE'] * $arItems['QUANTITY'];
            $col++;
        }
        if (($itog > 0) && ($col > 0)) 
            echo "<span>У вас <b>".$col.fn_ReplaceForm1($col, ' товар', ' товара', ' товаров')."</b> на сумму ".number_format(array_sum($itog), 0, ',', ' ')." руб в </span>";
        else
            echo "<span>У вас нет товаров в </span>";
		?>
        <?if (strlen($arParams["PATH_TO_BASKET"])>0):?>
            <a class='follow-basket-button' href='<?=$arParams["PATH_TO_BASKET"];?>'>корзине</a>
        <?endif;?>
 <div class='clear'></div>
</div>