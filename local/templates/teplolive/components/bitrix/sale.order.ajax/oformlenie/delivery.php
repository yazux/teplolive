<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table  class="sale_order_full_table">
    <tr>
        <td></td>
        <td>
            <?$unicorn = $arResult['ORDER_PROP']['USER_PROPS_Y'][33];?>
            <input type="hidden" name="<?=$unicorn["FIELD_NAME"]?>" value="">
            <span class="fullCheck"><input type="checkbox" name="<?=$unicorn["FIELD_NAME"]?>" id="<?=$unicorn["FIELD_NAME"]?>" value="Y"<?if ($unicorn["CHECKED"]=="Y") echo " checked";?>></span>
        </td>
        <td><b>Только полная отгрузка</b></td>
    </tr>
</table>
<? 
if(!empty($arResult["DELIVERY"]))
{
	?>
    <?//echo "<pre>";print_r($arResult);echo "</pre>";?>
	<table class="sale_order_full_table">
        <tr><td class='order-line group-name'>Способ доставки</td></tr>
    </table>
	<table class="sale_order_full_table">
      	<?
		foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
		{
			if ($delivery_id !== 0 && intval($delivery_id) <= 0)
			{
				?>
                <tr>
					<td colspan="2">
						<b><?=$arDelivery["TITLE"]?></b><?if (strlen($arDelivery["DESCRIPTION"]) > 0):?><br />
						<?=nl2br($arDelivery["DESCRIPTION"])?><br /><?endif;?>
						<table border="0" cellspacing="0" cellpadding="3">
						<?
						foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
						{
							?>
							<tr>
								<td width="20" nowrap="nowrap">&nbsp;</td>
								<td width="0%" valign="top"><input type="radio" id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>" name="<?=$arProfile["FIELD_NAME"]?>" value="<?=$delivery_id.":".$profile_id;?>" <?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?> onClick="submitForm();" /></td>
								<td width="50%" valign="top">
									<label for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">
										<small><b><?=$arProfile["TITLE"]?></b><?if (strlen($arProfile["DESCRIPTION"]) > 0):?><br />
										<?=nl2br($arProfile["DESCRIPTION"])?><?endif;?></small>
									</label>
								</td>
								<td width="50%" valign="top" align="right">
								<?
									$APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
										"NO_AJAX" => $arParams["DELIVERY_NO_AJAX"],
										"DELIVERY" => $delivery_id,
										"PROFILE" => $profile_id,
										"ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
										"ORDER_PRICE" => $arResult["ORDER_PRICE"],
										"LOCATION_TO" => $arResult["USER_VALS"]["DELIVERY_LOCATION"],
										"LOCATION_ZIP" => $arResult["USER_VALS"]["DELIVERY_LOCATION_ZIP"],
										"CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
									), null, array('HIDE_ICONS' => 'Y'));
								?>
								
								</td>
							</tr>
							<?
						} // endforeach
						?>
						</table>
					</td>
				</tr>
				<?
			}	
			else
			{
				?>
				<tr>
					<td valign="top" class="order-left-column">
                    </td>
                    <td class='deliver-check'>
                        <input type="radio" id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>" class='order-radio' name="<?=$arDelivery["FIELD_NAME"]?>" value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?> onclick="submitForm();">
                        <label for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>" class="deliver"></label>
                    </td>
                    <?if ($arDelivery["ID"]<>3):?>
					    <td valign="top">
						    <b><?= $arDelivery["NAME"] ?></b><br />
						    <?
						    if (strlen($arDelivery["PERIOD_TEXT"])>0)
						    {
							    echo $arDelivery["PERIOD_TEXT"];
							    ?><br /><?
						    }
						    ?>
						    <?=GetMessage("SALE_DELIV_PRICE");?> <?=$arDelivery["PRICE_FORMATED"]?><br />
						    <?
						    if (strlen($arDelivery["DESCRIPTION"])>0)
						    {
							    ?>
							    <?=$arDelivery["DESCRIPTION"]?><br />
							    <?
						    }
						    ?>
						    <!--</label>-->
					    </td>
                    <?else:?>
                        <td valign="top">
                            <b><?= $arDelivery["NAME"] ?></b><br />
                            <?
                            if (strlen($arDelivery["DESCRIPTION"])>0)
                            {
                                ?>
                                <?=$arDelivery["DESCRIPTION"]?><br />
                                <?
                            }
                            //echo "<pre>";print_r($arResult['ORDER_PROP']['USER_PROPS_N'][32]); echo "</pre>";
                            $pegasus = $arResult['ORDER_PROP']['USER_PROPS_N'][32];
                            echo '<br /><input type="text" class="any" maxlength="250" value="'.$pegasus["VALUE"].'" name="'.$pegasus["FIELD_NAME"].'" id="'.$pegasus["FIELD_NAME"].'">';
                            ?>
                            <!--</label>-->
                        </td>
                    <?endif;?>
				</tr>
				<?
			}
		}
		?>

	</table>
	<br />
	<?
}
?>