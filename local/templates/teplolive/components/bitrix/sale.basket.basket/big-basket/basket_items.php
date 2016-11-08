<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
echo ShowError($arResult["ERROR_MESSAGE"]);
echo GetMessage("STB_ORDER_PROMT"); ?>
<!--<br /><br />
<table width="100%">
	<tr>
		<td width="50%">
			<input type="submit" value="<?= GetMessage("SALE_REFRESH")?>" name="BasketRefresh">
		</td>
		<td align="right" width="50%">
			<input type="submit" value="<?= GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton1">
		</td>
	</tr>
</table>
<br />-->

<table class="sale_basket_basket data-table">
	<tr>
        <?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
            <th>x</th>
        <?endif;?>
    <th class='num'>№</th>
    <th class='basket-item-image'></th>
    <th class='articul'>Артикул</th>
    <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<th class='name'><?= GetMessage("SALE_NAME")?></th>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PROPS")?></th>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<th class='weight'><?= GetMessage("SALE_WEIGHT")?></th>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<th class=='basket-item-price'><?= GetMessage("SALE_PRICE")?></th>
		<?endif;?>
		<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PRICE_TYPE")?></th>
		<?endif;?>
		<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_DISCOUNT")?></th>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<th class='koli4estvo'><?= GetMessage("SALE_QUANTITY")?></th>
		<?endif;?>
	  <?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_OTLOG")?></th>
		<?endif;?>
    <th class='cost'>Стоимость</th>
	</tr>
	<?
	$i=0;
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><span class="chetkaCheck"><input class='chck' type="checkbox" name="DELETE_<?=$arBasketItems["ID"] ?>" id="DELETE_<?=$i?>" value="Y"></span></td>
			<?endif;?>
      <td><?=($i+1);?></td>
      <td style="vertical-align: middle"><?if (strlen($arBasketItems['PICTURE'])>0):?><img src='<?=$arBasketItems['PICTURE']?>'><?else:?><img src='/images/zaglushka-mini2.jpg'><?endif;?></td>
      <td><?=$arBasketItems['ELEMENT_PROPERTIES']['CML2_ARTICLE']['VALUE']?></td>
      <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td><?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?><a class='basket-item-name' href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>"><?
				endif;
				?><?=$arBasketItems["PREVIEW_TEXT"] ?><?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?></a><?
				endif;
				?></td>
			<?endif;?>
			<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
				<td>
				<?
				foreach($arBasketItems["PROPS"] as $val)
				{
					echo $val["NAME"].": ".$val["VALUE"]."<br />";
				}
				?>
				</td>
			<?endif;?>
      <?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td align="right"><?=$arBasketItems["WEIGHT_FORMATED"] ?> г</td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td align="right" class='nwprc'><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["NOTES"]?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td align="center">
          <div class='minus'></div>
          <input class='quan' maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3" >
          <div class='plus'></div>
        </td>
			<?endif;?>
		  <?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><input type="checkbox" name="DELAY_<?=$arBasketItems["ID"] ?>" value="Y"></td>
			<?endif;?>
       <td class="pirce"><?
           $cost = $arBasketItems["PRICE"] * $arBasketItems["QUANTITY"];
           echo number_format($cost, 0, ',', ' ')." руб";
       ?></td>
		</tr>
		<?
		$i++;
	}
	?>
  </table>
	<script>
	function sale_check_all(val)
	{
		for(i=0;i<=<?=count($arResult["ITEMS"]["AnDelCanBuy"])-1?>;i++)
		{
			if(val)
				document.getElementById('DELETE_'+i).checked = true;
			else
				document.getElementById('DELETE_'+i).checked = false;
		}
	}
	</script>
  <table class='basket-bottom'>
	<tr>
			<td class='bot-fr-td'>
			<input class='delete-basket-item' type="submit" value="<?echo GetMessage("SALE_REFRESH")?>" name="BasketRefresh">
      <div class='clear-check'>Снять выделение</div>
			<!--<small><?echo GetMessage("SALE_REFRESH_DESCR")?></small><br />-->
		</td>
    <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<td align="right" nowrap class='itog'>
				<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
					<b><?echo GetMessage('SALE_VAT_INCLUDED')?></b><br />
				<?endif;?>
				<?
				if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
				{
					?><b><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
					if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
						echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:</b><br /><?
				}
				?>
				Итог<?//= GetMessage("SALE_ITOGO")?>:
        			</td>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<td align="right" nowrap class='total-cost'> 
				<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
					<?=$arResult["allVATSum_FORMATED"]?><br />
				<?endif;?>
				<?
				if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
				{
					echo $arResult["DISCOUNT_PRICE_FORMATED"]."<br />";
				}
				?>
				<?=$arResult["allSum_FORMATED"]?><br />
			</td>
		<?endif;?>
	<!--
  	<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
			<td align="center"><input type="checkbox" name="DELETE" value="Y" onClick="sale_check_all(this.checked)"></td>
    <?endif;?>
		<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<td align="right"><?=$arResult["allWeight_FORMATED"] ?></td>
		<?endif;?>
	--></tr>
	<?if ($arParams["HIDE_COUPON"] != "Y"):?>
		<tr>
			<td colspan="3">
				
				<?= GetMessage("STB_COUPON_PROMT") ?>
				<input type="text" name="COUPON" value="<?=$arResult["COUPON"]?>" size="20">
				<br /><br />
			</td>
		</tr>
	<?endif;?>
  </table>
  <table class='basket-bottom'>
	<tr>
	  <td align="left" class='continue'><a href='/catalog/'>Продолжить выбор товара</a></td>
		<td align="right">
      <input type="submit" style="font-size: 0" class='refresh-basket' value="<?echo GetMessage("SALE_REFRESH")?>" name="BasketRefresh">
			<input type="submit" style="font-size: 0" class='basket-order' value="<?echo GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2"><br />
		</td>
	</tr>
</table>
<br />
<?