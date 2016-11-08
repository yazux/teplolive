<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="main-page-news">
  <p class='block-title'>Инфосклад</p>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="mainnews-items" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	  <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
<?
$datearr = explode('.', $arItem["DISPLAY_ACTIVE_FROM"]);
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
?>    <div class='news-date'>
			   <span class="day"><?=$datearr[0];?></span>
         <span class='month'><?=$month;?></span>
      </div>
		<?endif?>
     <div class='news-float'>
		<?if($arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a class='m-news-title' href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<?echo $arItem["NAME"]?><br />
			<?endif;?>
		<?endif;?>
    	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<img class="news-pic" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<?else:?>
				<img class="news-pic" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<p class='news-preview'><?echo $arItem["PREVIEW_TEXT"];?></p>
		<?endif;?>
		 </div>
    <div class='clear'></div>
	</div>
<?endforeach;?>
<a class='block-link' href='/info/'>Все</a>
</div>