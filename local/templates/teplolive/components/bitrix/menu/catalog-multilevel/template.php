<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?   // echo "<pre>"; print_r($arResult); echo "</pre>";  ?>

    <h2 class='ct-title'>Каталог</h2>
<?if (!empty($arResult)):?>
<ul class="catalog-multilevel">

<?
$previousLevel = 0;
$aNumber = 0;
foreach($arResult as $arItem):?>
    <?$aNumber++;?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li <?if ($arItem["SELECTED"]):?>class='selected'<?endif?>><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" <?if ($arItem["SELECTED"]):?>id='a<?=$aNumber?>'<?endif?>><?=$arItem["TEXT"]?></a>
            <?if ($arItem["SELECTED"]):?>
                <script type='text/javascript'>
                    $(document).ready(function(){
                        rightArrow("a<?=$aNumber?>");
                    });
                </script>
                <?endif?>
				<ul class="root-item <?if (!($arItem["SELECTED"])):?>hidden<?endif;?>">
		<?else:?>
			<li <?if ($arItem["SELECTED"]):?>class='selected'<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected <?endif?>" <?if ($arItem["SELECTED"]):?>id='a<?=$aNumber?>'<?endif?>><?=$arItem["TEXT"]?></a>
           <?if ($arItem["SELECTED"]):?>
                <script type='text/javascript'>
                    $(document).ready(function(){
                        rightArrow("a<?=$aNumber?>");
                    });
                </script>
            <?endif?>
				<ul
                        <?if (($arItem["DEPTH_LEVEL"] >= 1) && $arItem["SELECTED"]):?>
                        <?else:?>class='hidden'<?endif;?>
                        >
		<?endif?>

	<?else:?>
<?/**************************************************************************************/?>
		<?/*if ($arItem["PERMISSION"] > "D"):?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected id='a<?=$aNumber?>'<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected" id='a<?=$aNumber?>'<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?else:?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?endif*/?>
<?/***************************************************************************************/?>
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>