<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
function PrintPropsForm($arSource=Array())
{

	if (!empty($arSource))
	{
?><? $i=0;
		foreach($arSource as $arProperties)
		{
            if ($arProperties['ID'] == 35){
                echo '<form id="file-form" action="/ajax/uploadRec.php" method="POST">
        <input type="file" id="file-select" name="clientDetails[]"/>
        <button type="submit" id="upload-button">Загрузить</button>
    </form>';
                echo '<input name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'" type="hidden" value=""/>';
                continue;
            }


      //echo '<pre>'; print_r($arProperties); echo '</pre>';
      if($arProperties["SHOW_GROUP_NAME"] == "Y" && $arProperties['ID'] <> 32 && $arProperties['ID'] <> 33 && $arProperties['ID'] <> 34)
			{
				?>
				<tr>
					<td class='<?if($i>0){echo "order-line ";}?>group-name' colspan="2">
						<?= $arProperties["GROUP_NAME"] ?>
            		</td>
				</tr>                                           
				<?
			}
			?>
            <?if($i>=4 && $i<=10):?>
			     <? if ($i==4):?>
                    <tr>
				        <td class='order-left-column' align="right" valign="top">Юридический адрес: </td>
				        <td>
                 <?endif;?>
            <?elseif ($i>=11 && $i<=17):?>
                <? if ($i==11):?>
                    <tr>
				        <td class='order-left-column' align="right" valign="top">Фактический адрес: </td>
				        <td>
                            <input id = 'thesame' type='checkbox' name='dfdf' class='order-checkbox' <?if ($_REQUEST['dfdf'] == 'on'):?>checked<?endif;?>>
                            <div class='dfdf'>тот же </div>
                            <div class='clear'></div>

                <?endif;?>
         <?else:?>
            <?if ($i<>25 && $arProperties["ID"] <> 33 && $arProperties["ID"] <> 34 && $arProperties["ID"] <> 32):?>
                <tr>
				    <td class='order-left-column' align="right" valign="top">
					    <?= $arProperties["NAME"] ?>:<? 
					     if($arProperties["REQUIED_FORMATED"]=="Y")
					     {
						      ?><span class="sof-req">*</span><?
					     }
					     ?>
				    </td>
				    <td>
            <?endif;?>
         <?endif;?>
         <?     	if($arProperties["TYPE"] == "CHECKBOX")
					{
						?>

					<?
					}
					elseif($arProperties["TYPE"] == "TEXT")
					{
					//echo $i;	?>
					
            <?switch ($i) {
                        case 0: if ($arProperties['ID'] == 32){
                            //echo '<input type="hidden" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                            break;
                        }
                case 26:
                    if ($arProperties['ID'] == 34){
                        echo '<input type="hidden" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                       break;
                    }
                    else {
                        echo '<input type="text" maxlength="10" class="any numeric" placeholder="" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                        break;                        
                    }
				 case 1:
                    echo '<input type="text" maxlength="12" class="any numeric" placeholder="" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                    break;
                case 2:
                    echo '<input type="text" maxlength="9" class="any numeric" placeholder="" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                    break;
                case 3:
					
                    echo '<input type="text" maxlength="15" class="any numeric" placeholder="" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                    break;
                case 18:
                    echo '<input type="text" maxlength="20" class="any numeric" placeholder="" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                    break;
                case 20:
                    echo '<input type="text" maxlength="9" class="any numeric" placeholder="" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                    break;
                case 21:
                    echo '<input type="text" maxlength="20" class="any numeric" placeholder="" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                    break;
                case 4: 
                  echo '<input type="text" class="any index" placeholder="индекс" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 5:
                  echo '<input type="text" class="any region"  placeholder="регион" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 7:
                  echo '<input type="text" class="bakugan any district"  placeholder="район" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'"><br />';
                  break;
                case 8:
                  echo '<input type="text" class="any street"  placeholder="улица" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 9:
                  echo '<input type="text" class="any build"  placeholder="дом" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 10:
                  echo '<input type="text" class="any office"  placeholder="офис" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 11: 
                  echo '<input type="text" class="any index" placeholder="индекс" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 12:
                  echo '<input type="text" class="any region"  placeholder="регион" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 14:
                  echo '<input type="text" class="any district"  placeholder="район" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'"><br />';
                  break;
                case 15:
                  echo '<input type="text" class="any street"  placeholder="улица" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 16:
                  echo '<input type="text" class="any build"  placeholder="дом" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 17:
                  echo '<input type="text" class="any office"  placeholder="офис" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
                  break;
                case 25:
                  break;
                default:
                  echo '<input type="text" class="any" maxlength="250" size="'.$arProperties["SIZE1"].'" value="'.$arProperties["VALUE"].'" name="'.$arProperties["FIELD_NAME"].'" id="'.$arProperties["FIELD_NAME"].'">';
} 
//if ($arProperties['ID'] == 34){

//}
?>
						<?
					}
					elseif($arProperties["TYPE"] == "SELECT")
					{
						?>
						<select class='order-select' name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
					}
					elseif ($arProperties["TYPE"] == "MULTISELECT")
					{
						?>
						<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
					}
					elseif ($arProperties["TYPE"] == "TEXTAREA")
					{
						?>
						<textarea rows="<?=$arProperties["SIZE2"]?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>
						<?
					}
					elseif ($arProperties["TYPE"] == "LOCATION")
					{
						$value = 0;
						foreach ($arProperties["VARIANTS"] as $arVariant) 
						{
							if ($arVariant["SELECTED"] == "Y") 
							{
								$value = $arVariant["ID"]; 
								break;
							}
						}

						$GLOBALS["APPLICATION"]->IncludeComponent(
							'bitrix:sale.ajax.locations', 
							'', 
							array(
								"AJAX_CALL" => "N", 
								"COUNTRY_INPUT_NAME" => "COUNTRY_".$arProperties["FIELD_NAME"],
								"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
								"CITY_OUT_LOCATION" => "Y",
								"LOCATION_VALUE" => $value,
								"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
							),
							null,
							array('HIDE_ICONS' => 'Y')
						);
					}
					elseif ($arProperties["TYPE"] == "RADIO")
					{
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>" value="<?=$arVariants["VALUE"]?>"<?if($arVariants["CHECKED"] == "Y") echo " checked";?>>
                            <label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label><br />
							<?
						}
					}

					if (strlen($arProperties["DESCRIPTION"]) > 0)
					{
						?><br /><small><?echo $arProperties["DESCRIPTION"] ?></small><?
					}
					?>
				<?if(($i>=4 && $i<10) || ($i == 25)):?>
			     <?// if ($i==10):?>	
				    <?elseif($i>=11 && $i<17):?>
                    <?else:?></td></tr>
            <?endif;?>
            <?
		$i++;
    }
		?><?
		return true;
	}
	return false;
}
?><p class=getmessage><b><?=GetMessage("SOA_TEMPL_PROP_INFO")?></b></p>
<table class="sale_order_full_table">
<?
if(!empty($arResult["ORDER_PROP"]["USER_PROFILES"]))
{
	?>
	<p class=getmessage><?=GetMessage("SOA_TEMPL_PROP_CHOOSE")?></p>
	<select class='select-change' name="PROFILE_ID" id="ID_PROFILE_ID" onChange="SetContact(this.value)">
		<option value="0"><?=GetMessage("SOA_TEMPL_PROP_NEW_PROFILE")?></option>
		<?
		foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles)
		{
			?>
			<option value="<?= $arUserProfiles["ID"] ?>"<?if ($arUserProfiles["CHECKED"]=="Y") echo " selected";?>><?=$arUserProfiles["NAME"]?></option>
			<?
		}
		?>
	</select>
	<br />
	<br />
	<?
}
?>
<div style="display:none;">
<?
	$APPLICATION->IncludeComponent(
		'bitrix:sale.ajax.locations', 
		'', 
		array(
			"AJAX_CALL" => "N", 
			"COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
			"CITY_INPUT_NAME" => "tmp",
			"CITY_OUT_LOCATION" => "Y",
			"LOCATION_VALUE" => "",
			"ONCITYCHANGE" => "",
		),
		null,
		array('HIDE_ICONS' => 'Y')
	);
?>
</div>
<table class="sale_order_full_table_no_border">
<?
PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"]);
PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"]);
?>
</table>
</td></tr></table>
