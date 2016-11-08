<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?// echo "<pre>"; print_r($arResult["arTaxList"]); echo "</pre>";?>
<table class="data-table sum-table">
    <tr>
        <td class='order-line group-name orders' style='' colspan="2">
            Заказы
        </td>
    </tr>
    <tr>
		<th class='num2'>№</th>
		<th class='articul2'>Артикул</th>
		<th>Название</th>
<?/*?> 		
		<th class='weight2'><?=GetMessage("SOA_TEMPL_SUM_WEIGHT")?></th>
<?*/?> 		
		<th><?=GetMessage("SOA_TEMPL_SUM_QUANTITY")?></th>
		<th>Стоимость</th>
	</tr>
	<?
    $orderItemCount = 1;
	foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
	{
		?>
		<tr>
            <td><?echo $orderItemCount; $orderItemCount++;?></td>
            <td><?=$arBasketItems["ARTICLE"]?></td>
            <td><?=$arBasketItems["NAME"]?></td>
<?/*?>          
			<td><?=$arBasketItems["WEIGHT_FORMATED"]?> г</td>
<?*/?>			
			<td><?=$arBasketItems["QUANTITY"]?></td>
			<td class="right"><span class='order-price-blue'><?=$arBasketItems['MERGED_PRICE']?></span></td>
		</tr>
		<?
	}
	?>
	<?
	if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
	{
		?>
		<tr>
			<td align="right">!!<b><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?>:</b></td>
			<td align="right" colspan="6"><?echo $arResult["DISCOUNT_PRICE_FORMATED"]?>
			</td>
		</tr>
		<?
	}
	/*
	if (doubleval($arResult["VAT_SUM_FORMATED"]) > 0)
	{
		?>
		<tr>
			<td align="right">
				<b><?=GetMessage("SOA_TEMPL_SUM_VAT")?></b>
			</td>
			<td align="right" colspan="6"><?=$arResult["VAT_SUM_FORMATED"]?></td>
		</tr>
		<?
	}
	*/
	if (doubleval($arResult["DELIVERY_PRICE"]) > 0)
	{
		?>
		<tr>
			<td align="right" class='order-sum-bottom'>
				<?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?>
			</td>
			<td align="right" colspan="6" class='order-total-cost order-sum-bottom'><?=$arResult["DELIVERY_PRICE_FORMATED"]?></td>
		</tr>
		<?
	}
	?>
	<tr>
		<td align="right"   class='order-sum-bottom'></td>
		<td align="right" colspan="6" class='order-sum-bottom order-total-cost'><?=GetMessage("SOA_TEMPL_SUM_IT")?> <span class='total-cost-formated'><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></span>
		</td>
	</tr>
	<?
	if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
	{
		?>
		<tr>
			<td align="right" class='order-sum-bottom'><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></td>
			<td align="right" colspan="6" class='order-sum-bottom'><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></td>
		</tr>
		<?
	}
	?>
</table>
