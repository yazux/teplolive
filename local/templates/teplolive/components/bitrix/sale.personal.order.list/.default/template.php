<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form method="GET" class='order-filter-form' action="<?= $arResult["CURRENT_PAGE"] ?>" name="bfilter">
<h2>Найти заказ</h2>
<?CModule::IncludeModule("iblock"); ?>
<p class='filter-p'><?=GetMessage("SPOL_T_F_ID");?>:</p> <input class='filter-input' type="text" name="filter_id" value="<?=htmlspecialchars($_REQUEST["filter_id"])?>" size="10">
	<p class='filter-p'><?=GetMessage("SPOL_T_F_DATE");?>:</p>
    <div class='filter-calendar'>
    <?$APPLICATION->IncludeComponent("bitrix:main.calendar", "order-calendar", array(
	"SHOW_INPUT" => "Y",
	"FORM_NAME" => "bfilter",
	"INPUT_NAME" => "filter_date_from",
	"INPUT_NAME_FINISH" => "filter_date_to",
	"INPUT_VALUE" => $_REQUEST["filter_date_from"],
	"INPUT_VALUE_FINISH" => $_REQUEST["filter_date_to"],
	"SHOW_TIME" => "N",
	"HIDE_TIMEBAR" => "N"
	),
	false
);?>
    </div>
    <div class='clear'></div>
		<p class='filter-p2'><?=GetMessage("SPOL_T_F_STATUS")?>:</p>
		<select name="filter_status" class='filter-input'>
				<option value=""><?=GetMessage("SPOL_T_F_ALL")?></option>
				<?
				foreach($arResult["INFO"]["STATUS"] as $val)
				{
					if ($val["ID"]!="F")
					{
						?><option value="<?echo $val["ID"]?>"<?if($_REQUEST["filter_status"]==$val["ID"]) echo " selected"?>>[<?=$val["ID"]?>] <?=$val["NAME"]?></option><?
					}
				}
				?>
		</select>
	<p class='filter-p2'><?=GetMessage("SPOL_T_F_PAYED")?>:</p>
		<select name="filter_payed" class='filter-input'>
				<option value=""><?echo GetMessage("SPOL_T_F_ALL")?></option>
				<option value="Y"<?if ($_REQUEST["filter_payed"]=="Y") echo " selected"?>><?=GetMessage("SPOL_T_YES")?></option>
				<option value="N"<?if ($_REQUEST["filter_payed"]=="N") echo " selected"?>><?=GetMessage("SPOL_T_NO")?></option>
		</select>
	<p class='filter-p2'><?=GetMessage("SPOL_T_F_CANCELED")?>:</p>
		<select name="filter_canceled" class='filter-input'>
				<option value=""><?=GetMessage("SPOL_T_F_ALL")?></option>
				<option value="Y"<?if ($_REQUEST["filter_canceled"]=="Y") echo " selected"?>><?=GetMessage("SPOL_T_YES")?></option>
				<option value="N"<?if ($_REQUEST["filter_canceled"]=="N") echo " selected"?>><?=GetMessage("SPOL_T_NO")?></option>
			</select>
		<p class='filter-p2'><?=GetMessage("SPOL_T_F_HISTORY")?>:</p>
        <div class='filter-p2'>
            <input type='radio' id='SPOL_T_NO' name="filter_history" value="N" <?if($_REQUEST["filter_history"]=="N") echo " selected"?> />
            <label for="SPOL_T_NO" class='deliver'></label> <p class='radio-descript'><?=GetMessage("SPOL_T_NO")?></p>
        </div>    
        <div class='filter-p2'>
            <input type='radio' id='SPOL_T_YES' name="filter_history" value="Y" <?if($_REQUEST["filter_history"]=="N") echo " selected"?> />
            <label for="SPOL_T_YES" class='deliver'></label> <p class='radio-descript'><?=GetMessage("SPOL_T_YES")?></p>
        </div>
                <div class='clear'></div>
		  <div class='submitFilter'>
			<input type="submit" id='clear-button' name="del_filter" value="Очистить">
            <input type="submit" id='search-but' name="filter" value="&nbsp;">
		  </div>
</form>

<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
<table class="sale-personal-order-list data-table">
	<tr>
		<th class='kodzakaza'><?=GetMessage("SPOL_T_ID")?> <?
        if (htmlspecialchars($_REQUEST['order']) == 'asc'){
            $page = $APPLICATION->GetCurPageParam("by=id&order=desc", array("by", "order")); 
            ?><a href="<?=$page;?>"><img src="/bitrix/images/icons/up.gif" width="15" height="15" border="0" alt="По возрастанию"></a><?  
        }
        else {
            $page = $APPLICATION->GetCurPageParam("by=id&order=asc", array("by", "order")); 
            ?><a href="<?=$page;?>"><img src="/bitrix/images/icons/down.gif" width="15" height="15" border="0" alt="По возрастанию"></a><?
        }  
        ?></th>
		<th class='order-price'><?=GetMessage("SPOL_T_PRICE")?></th>
		<th><?=GetMessage("SPOL_T_STATUS")?></th>
		<th class='basketbl'><?=GetMessage("SPOL_T_BASKET")?></th>
		<th><?=GetMessage("SPOL_T_PAYED")?></th>
		<th><?=GetMessage("SPOL_T_CANCELED")?></th>
		<th><?=GetMessage("SPOL_T_PAY_SYS")?></th>
		<th><?=GetMessage("SPOL_T_ACTION")?></th>
	</tr>
	<?foreach($arResult["ORDERS"] as $val):?>
		<tr>
			<td align='center'><b><?=$val["ORDER"]["ID"]?></b></td>
			<td><?=$val["ORDER"]["FORMATED_PRICE"]?></td>
			<td><?=$arResult["INFO"]["STATUS"][$val["ORDER"]["STATUS_ID"]]["NAME"]?><br /><?=$val["ORDER"]["DATE_STATUS"]?></td>
			<td><?
				$bNeedComa = False;
				foreach($val["BASKET_ITEMS"] as $vval)
				{
                    ?><p><?
					if (strlen($vval["DETAIL_PAGE_URL"])>0) {
						echo '<a href="'.$vval["DETAIL_PAGE_URL"].'">';
					    echo $vval["NAME"];
					    echo '</a>';
                    }
                    else {
                        $arFilter = array(
                        "IBLOCK_ID" => 9,                                                                 // изменения тут!
                        "ID" => $vval['PRODUCT_ID'],
                        );
                        $res2 = CIBlockElement::GetList(Array(), $arFilter, false, false, Array("ID", "PROPERTY_CML2_LINK"));
                        while($ob2 = $res2->GetNextElement())
                        {
                            $arOfferss = $ob2->GetFields();
                        }
                        $arFilter2 = array(
                        "IBLOCK_ID" => 8,                                                                 // изменения тут!
                        "ID" => $arOfferss['PROPERTY_CML2_LINK_VALUE']
                        );
                        $res24 = CIBlockElement::GetList(Array(), $arFilter2, false, false, Array("IBLOCK_SECTION_ID"));
                        while($ob24 = $res24->GetNextElement())
                        {
                            $arOfferz = $ob24->GetFields();
                        }        
                        $res78 = CIBlockSection::GetList(
                        array(), array('ID'=> $arOfferz['IBLOCK_SECTION_ID']), false, array("CODE"));
                    while($ob78 = $res78->GetNextElement())
                    {
                        $Rarity = $ob78->GetFields();
                    }
                        echo '<a href="/catalog/'.$Rarity["CODE"].'/">';
                        echo $vval["NAME"];
					    echo '</a>';
                    }    
						echo ' - '.$vval["QUANTITY"].' '.GetMessage("STPOL_SHT");
					?></p><?
				}
			?></td>
			<td align='center'><?=(($val["ORDER"]["PAYED"]=="Y") ? GetMessage("SPOL_T_YES") : GetMessage("SPOL_T_NO"))?></td>
			<td align='center'><?=(($val["ORDER"]["CANCELED"]=="Y") ? GetMessage("SPOL_T_YES") : GetMessage("SPOL_T_NO"))?></td>
			<td>
				<?=$arResult["INFO"]["PAY_SYSTEM"][$val["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?> / 
				<?if (strpos($val["ORDER"]["DELIVERY_ID"], ":") === false):?>
					<?=$arResult["INFO"]["DELIVERY"][$val["ORDER"]["DELIVERY_ID"]]["NAME"]?>
				<?else:
					$arId = explode(":", $val["ORDER"]["DELIVERY_ID"]);
				?>
					<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]?> (<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"]?>)
				<?endif?>
			</td>
			<td><a title="<?=GetMessage("SPOL_T_DETAIL_DESCR")?>" href="<?=$val["ORDER"]["URL_TO_DETAIL"]?>"><?=GetMessage("SPOL_T_DETAIL")?></a><br />
				<a title="<?=GetMessage("SPOL_T_COPY_ORDER_DESCR")?>" href="<?=$val["ORDER"]["URL_TO_COPY"]?>"><?=GetMessage("SPOL_T_COPY_ORDER")?></a><br />
				<?if($val["ORDER"]["CAN_CANCEL"] == "Y"):?>
					<a title="<?=GetMessage("SPOL_T_DELETE_DESCR")?>" href="<?=$val["ORDER"]["URL_TO_CANCEL"]?>"><?=GetMessage("SPOL_T_DELETE")?></a>
				<?endif;?>
			</td>
		</tr>
	<?endforeach;?>
</table>
<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>