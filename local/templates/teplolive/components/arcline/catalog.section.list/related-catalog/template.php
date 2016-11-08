<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>"; print_r($arResult); echo "</pre>";
?>
<?
  $arResult['Navi']->NavPrint("", false, "", "/bitrix/templates/teplolive/components/bitrix/system.pagenavigation/navigation/template.php");
?>
<?
$arFilter = array (
  "IBLOCK_ID" => 8                                                                  // изменения тут!
);
?>

<div class="analog-catalog">
<?/*?>   <div class="an-title"><p class="title-line"><?if($arParams['RELATED'] == "Y"):?>Сопутствующие товары<?else:?>Аналогичные товары<?endif;?></p>
        <a href="/catalog/related.php?id=<?=$arParams['ALICORN']?>&r=<?if($arParams['RELATED'] == "Y"):?>2<?else:?>1<?endif;?>" class="show-all-analog">показать все</a>
        <div class="clear"></div>
   </div>
<?*/
$itemCount = 0;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?if ($CURRENT_DEPTH >= 1):                    //изменения тут?>
                                                                  
  <?$itemCount++;?>
 <div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class='<?if ($itemCount <> 4):?>catalog-item<?else:?>catalog-item2<?endif;?>'>
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
  <div class='rating'>
      <?$APPLICATION->IncludeComponent("arcline:iblock.vote","ajax",Array(
          "IBLOCK_TYPE" => "Catalog",
          "IBLOCK_ID" => "8",
          "ELEMENT_ID" => $arSection['ID'],
          "MAX_VOTE" => "5",
          "VOTE_NAMES" => array("1","2","3","4","5"),
          "SET_STATUS_404" => "N",
          "CACHE_TYPE" => "A",
          "CACHE_TIME" => "3600"
      )
  );?>
  </div>
  <a class='catalog-item-name' href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
  <?//$zds=$arSection["MIN_PRICE"]*40.1769;?>
     <?//echo $arSection["MIN_PRICE"];               // настоящая цена!!!!!!!!!!         ?>
  <?
    if ($arSection["VALUTA"] <> "RUB"){
        $zbs = CCurrencyRates::ConvertCurrency($arSection["MIN_PRICE"], $arSection["VALUTA"], "RUB");
    }
    else {
        $zbs = $arSection["MIN_PRICE"];
    }
  ?>
  <div><span class='otrub'>от </span><span class='catalog-price'><?=number_format(/*$arSection["MIN_PRICE"]*/$zbs, 0, ',', ' ');?></span><span  class='otrub'><?//if($arSection["VALUTA"] == "RUB"):?> руб <!--<?//elseif ($arSection["VALUTA"] == "EUR"):?> евро <?//else:?> у.е. <?//endif;?>--></span></div>
  </div>
     <div class='buy-wrap'>
         <a class='buyback' href="<?=$arSection["SECTION_PAGE_URL"]?>"></a>
         <a class='pressme' href="<?=$arSection["SECTION_PAGE_URL"]?>">подробнее</a>
     </div>
 </div>
 <?if ($itemCount == 4):?>
  <div class='clear'></div>
        <div class='line'></div>
  <?$itemCount=0;?>
 <?endif;?>
<?endif;?>
<?endforeach?>
<div class='clear'></div>
<?if (($itemCount <> 4) && ($itemCount <> 0)):?>
    <div class='line'></div>
<?endif;?> 
<?
  $arResult['Navi']->NavPrint("", false, "", "/bitrix/templates/teplolive/components/bitrix/system.pagenavigation/navigation/template.php");
?>
</div>

