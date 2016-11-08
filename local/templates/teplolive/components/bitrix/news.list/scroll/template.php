<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="slider-x">
<div class="Vwidget">
<div class="VjCarouselLite">
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<li class="scroll-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
			<?else:?>
				<img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" />
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<p class='scroll-name'><?echo $arItem["NAME"]?></p>
			<?else:?>
				<p class='scroll-name'><?echo $arItem["NAME"]?></p>
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<p class='scroll-text'><?echo $arItem["PREVIEW_TEXT"];?></p>
		<?endif;?>
    <?if (!empty($arItem["PROPERTIES"]['SCDISCOUNT']['VALUE'])):?>
      <? if(!empty($arItem["PROPERTIES"]['SCPRICE']['VALUE'])):?>
        <span class='scroll-cross-price'><?=$arItem["PROPERTIES"]['SCPRICE']['VALUE'];?></span><span class='rur'>руб.- </span>
      <?endif;?>
      <span class='scroll-price sc-discount'> <?=$arItem["PROPERTIES"]['SCDISCOUNT']['VALUE']?></span><span class='rur'>руб.-</span>
      <div class='push'></div>
    <?else:?>
      <? if(!empty($arItem["PROPERTIES"]['SCPRICE']['VALUE'])):?>
        <span class='scroll-price'><?=$arItem["PROPERTIES"]['SCPRICE']['VALUE'];?></span><span class='rur'>руб.-</span>
        <div class='push'></div>
      <?endif;?>
    <?endif;?>
    <?if (!empty($arItem["PROPERTIES"]['LINK']['VALUE'])):?>
      <a class='scroll-button' href='<?=$arItem["PROPERTIES"]['LINK']['VALUE'];?>'>
        подробнее &rarr;
      </a>
    <?endif;?>
	</li>
<?endforeach;?>
</ul>
</div>
</div>
</div>
