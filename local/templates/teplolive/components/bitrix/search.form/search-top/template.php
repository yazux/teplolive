<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="search-form">
<form action="<?=$arResult["FORM_ACTION"]?>">
	<table border="0" cellspacing="0" cellpadding="2" align="center">
		<tr>
			<td align="center"><?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
			);?><?else:?><input type="text"  placeholder='Поиск по сайту' name="q" value="" size="15" maxlength="50" />
                <input class='search-submit' name="s" type="submit" value="<?//=GetMessage("BSF_T_SEARCH_BUTTON");?>" />
                <?endif;?></td>
		</tr>
	</table>
</form>
</div>