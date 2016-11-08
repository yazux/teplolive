<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <div class='bot-scroll-wrapper'>
<div class="next1 browse"><img src='<?=SITE_TEMPLATE_PATH;?>/images/prev.png'></div>
<div class="bottom-scroll">
<?if(count($arResult["ITEMS"])<6){?>
	<style>
		.browse img{
			display:none;
		}
	</style>
<?}?>
 <ul class='scroller'>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<li class="bottom-scroll-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
      <div class='blabla'>
      <img class="bottom-scroll-pic" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<?else:?>
				<img class="bottom-scroll-pic" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			
      </div>
			<?endif;?> 
		<?endif?>
	</li>
<?endforeach;?>
</ul>
</div>
 <div class="prev1 browse"><img src='<?=SITE_TEMPLATE_PATH;?>/images/next.png'></div>
 <div class='clear'> </div>
</div>