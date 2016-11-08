<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="big-catalog">
<?
$itemCount = 0;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?if ($CURRENT_DEPTH == 2):?>
  <?$itemCount++;?>
 <div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class='<?if ($itemCount <> 3):?>catalog-item<?else:?>catalog-item2<?endif;?>'>
  <img src='<?=$arSection["PICTURE"]['SRC']?>'>
  <div class='rating'>рейтинг</div>
  <a class='catalog-item-name' href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
  <div><span class='otrub'>от </span><span class='catalog-price'><?=number_format($arSection["MIN_PRICE"], 0, ',', ' ');?></span><span  class='otrub'> руб </span></div>
  <div class='price-push'></div>
  <a href="<?=$arSection["SECTION_PAGE_URL"]?>">подробнее</a>
 </div>
 <?if ($itemCount == 3):?>
  <div class='clear'></div>
  <hr class='line' noshade />
  <?$itemCount=0;?>
 <?endif;?>
<?endif;?>
<?endforeach?>
<div class='clear'></div>
<?if (($itemCount <> 3) && ($itemCount <> 0)):?>
 <hr class='line' noshade />
<?endif;?> 
</div>
<?//$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
  //$db_list->NavStart(20);
  //echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
?>