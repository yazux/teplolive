<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form class='sbscrfrm' action="<?=$arResult["FORM_ACTION"]?>">
<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
	<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
	<input class='sbrcb' type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
	</label>
<?endforeach;?>
	<input class='slaveemail' placeholder="Введите ваш Email" type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" />
	<input class='sbscrgo' type="submit" name="OK" value="<?//=GetMessage("subscr_form_button")?>" />
</form>
<div class='clear'></div>
