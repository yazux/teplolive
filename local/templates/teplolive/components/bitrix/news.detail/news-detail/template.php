<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $USER;?>
<div class="detail-page">
<?//echo"<pre>";print_r($arResult);echo"</pre>";?>
    <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
    <?
    $datearr = explode('.', $arResult["DISPLAY_ACTIVE_FROM"]);
    switch ($datearr[1]) {
        case 1: $month='янв'; break;
        case 2: $month='фев'; break;
        case 3: $month='март'; break;
        case 4: $month='апр'; break;
        case 5: $month='мая'; break;
        case 6: $month='июня'; break;
        case 7: $month='июля'; break;
        case 8: $month='авг'; break;
        case 9: $month='сент'; break;
        case 10: $month='окт'; break;
        case 11: $month='нояб'; break;
        case 12: $month='дек'; break;
        default: return false;
    }
    ?>
    <div class='news-date'>
        <span class="day"><?=$datearr[0];?></span>
        <span class='month'><?=$month;?></span>
    </div>
    <?endif;?>
    <div class="news-float">
    <?if (strlen($arResult['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC']) > 0):?>
        <div class='download'><a <?if ($USER->IsAuthorized()):?>href='<?=$arResult['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC'];?>'<?else:?>rel="#overlay" href="/auth/login.php"<?endif;?>>скачать</a></div>
    <?endif;?>
    <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
        <p class="news-title"><?=$arResult["NAME"]?></p>
    <?endif;?>

    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<div class='detpicwrap'>
            <img class="detail-picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
        </div>
    <?endif?>

	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
    </div>
</div>
