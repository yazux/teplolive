<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
  $arResult['Navi']->NavPrint("", false, "", "/bitrix/templates/teplolive/components/bitrix/system.pagenavigation/navigation/template.php");
?>
<?$arFilter = array ("IBLOCK_ID" => 8);                                                             // изменения тут!
?>
<div class="big-catalog">
<?
$itemCount = 0;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?if ($CURRENT_DEPTH >= 1):                    //изменения тут?>
                                                                  
  <?$itemCount++;?>
 <div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class='<?if ($itemCount <> 3):?>catalog-item-root<?else:?>catalog-item-root2<?endif;?>'>
    <?if (strlen($arSection['label']['SRC'])>0):?>
        <div class='label'>
            <img src='<?=$arSection['label']['SRC'];?>'>
        </div>
    <?endif;?>
    <div class='price-push'>
     <div class='img-wrap'><?
        if (!empty($arSection["PICTURE"]['SRC'])):
            ?><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src='<?=$arSection["PICTURE"]['SRC'];?>'></a>
            <?else:?>
                <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src='<?=$arSection["PREVIEW_PICTURE"]?>'></a>
            <?endif;?></div>

  <p class='parent-name'><a href='/catalog/<?=$arSection['CODE'];?>/'><?=$arSection["NAME"]?></a></p>
 <div>
     <?$minorSectionCounter = 0;?>
     <ul class='section-points'>
     <?foreach ($arSection['MINOR_SECTIONS'] as $minorSection ):?>
        <li><a href='/catalog/<?=$minorSection['CODE'];?>/'><?=$minorSection['NAME'];?></a></li>
        <?$minorSectionCounter++;?>
     <?if ($minorSectionCounter >= 3){ $etc = true; break; };?>
     <?endforeach;?>
      </ul>
     <?if ($etc):?>
        <a href="<?=$arSection["SECTION_PAGE_URL"]?>">еще</a>
     <?endif;?>
 </div>
  </div>
 </div>
 <?if ($itemCount == 3):?>
  <div class='clear'></div>
  <div class='line'></div>
  <?$itemCount=0;?>
 <?endif;?>
<?endif;?>
<?endforeach?>
<div class='clear'></div>
<?if (($itemCount <> 3) && ($itemCount <> 0)):?>
    <div class='line'></div>
<?endif;?> 
<?
  $arResult['Navi']->NavPrint("", false, "", "/bitrix/templates/teplolive/components/bitrix/system.pagenavigation/navigation/template.php");
?>
</div>
<div id='id_catalog_mainsection'><?=$arParams['ALICORN'];?></div>

