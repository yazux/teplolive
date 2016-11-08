<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	
	<?$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>123123123, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
	
	<?$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"]=$file["src"];?>
	<?$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["WIDTH"]=$file["width"];?>
	<?$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["HEIGHT"]=$file["height"];?>
	
	
	<?endforeach;?>	