<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section">

<?//echo "<pre>"; print_r($arResult); echo "</pre>";?>
<?$_SESSION['LAST_CAT_ID'][] = $arResult['ID'];?>
<?//die();?>
<?//echo $arParams[PRICE_CODE][0];?>
<div class='section-head'>
<div class="sect-left-part">
 <div class='section-picture'>
     <table>
         <tr>
             <td class="eeerrr">
    <img class='catalog-head-picture' src='<?if (!empty($arResult['DETAIL_PICTURE']['SRC'])):?><?=$arResult['DETAIL_PICTURE']['SRC'];?>'<?else:?>/images/zaglushka-big.jpg'<?endif;?> alt='<?=$arResult["DETAIL_PICTURE"]['DESCRIPTION'];?>'>
             </td>
         </tr>
    </table>
 </div>
	 <?global $infosklad;?>
 <?echo $infosklad;?>
</div>

 <div class='section-head-main'>
  <p class='section-name'><?=$arResult['NAME']?></p>
  <div class="rating">
      <?$APPLICATION->IncludeComponent("arcline:iblock.vote","ajax",Array(
          "IBLOCK_TYPE" => "Catalog",
          "IBLOCK_ID" => "8",
          "ELEMENT_ID" => $arResult['ID'],
          "MAX_VOTE" => "5",
          "VOTE_NAMES" => array("1","2","3","4","5"),
          "SET_STATUS_404" => "N",
          "CACHE_TYPE" => "A",
          "CACHE_TIME" => "3600"
      )
  );?>
  </div>
   <div class='section-price'>
    <?//foreach($arResult["ITEMS"] as $arElement):?>
      <?//foreach($arElement["OFFERS"] as $arOffer):?>
        <?//foreach($arOffer["PRICES"] as $code=>$arPrice):?>
						<?//if($arPrice["CAN_ACCESS"]):?>
              <?//$arPriceWithoutDiscount[]=$arPrice["VALUE"];?>
              <?//$arPriceWithDiscount[]=$arPrice["DISCOUNT_VALUE"];?>
						<?//endif;?>
				<?//endforeach;?>
      <?//endforeach;?>    
    <?//endforeach;?>
    <?//if (!empty($arPriceWithDiscount)):?>
      <span>от <?=CurrencyFormat(/*min($arPriceWithDiscount)*/$arResult["MIN_PRICE"], RUB);?></span>
    <?//elseif (!empty($arPriceWithoutDiscount)):?>
    
      <!--<span>от <?//=CurrencyFormat(min($arPriceWithoutDiscount), RUB);?></span>-->
    <?//endif;?>
    </div> 
   <div class='section-links'>
   <?foreach ($arResult["SECTION_FILE"] as $file):?>
       <div class='sect-file'>
            <a href='<?=$file['SRC']?>'><?=$file['DESCRIPTION']?></a>
       </div>
   <?endforeach;?>
   </div>
   <p class='section-description'><?=$arResult['DESCRIPTION']?></p>
   <p class='section-properties'><?=htmlspecialcharsBack($arResult['SECTION_OPTIONS'])?></p>  
 </div>
 <div class='clear'></div>
 </div>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
        <div class='bot-padding'>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
    <?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		
		<div id="<?=$this->GetEditAreaId($arElement['ID']);?>">
       <?//=$arElement['PROPERTIES']['KOD']['VALUE'];?>
       <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
			 	<!--		<a href="<?=$arElement["DETAIL_PICTURE"]['SRC']?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
			--><?endif?>

			<?if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):?>
				<?foreach($arElement["OFFERS"] as $arOffer):?>
<?$isExist = (intval($arOffer['CATALOG_QUANTITY'])>0)?"<span class=\"vnalichii\" style=\"padding-top: 4px;float: right;color: green\">В наличии</span>":"<span class=\"podzakaz\" style=\"padding-top: 4px;float: right;color: red\">Под заказ</span>"?>
					<?//foreach($arParams["OFFERS_FIELD_CODE"] as $field_code):?>
						<?//echo GetMessage("IBLOCK_FIELD_".$field_code)?><!--:&nbsp;--><?
								//echo $arOffer[$field_code];?>
					<?//endforeach;?>
<div class='section-element'>
<div class='section-element-main'>

	  <p class='kod'>Код: <?=$arElement['PROPERTIES']['CML2_ARTICLE']['VALUE'];?></p>
 <div  class='offers-title'><p><span><?=$arElement["PREVIEW_TEXT"]?></span><?//=$arOffer['NAME']?></p><?=$isExist?></div>
					<?foreach($arOffer["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<p class='trade-offers'><?//=$arResult["PRICES"][$code]["TITLE"];?>
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price-discount"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
							<?else:?>
								<span class="catalog-price"><?=$arPrice["PRINT_VALUE"];?></span>
							<?endif?>
							</p>
						<?endif;?>
					<?endforeach;?>
					<?if($arOffer["CAN_BUY"]):?>
					   <?if($arParams["USE_PRODUCT_QUANTITY"]):?>
					     <form class='quan-form' action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
<div class='quant'>
<div class='minus'></div>
   <input class='quan' type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
<div class='plus'></div>	
					       <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
					       <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arOffer["ID"]?>">
</div>	
				       <!--<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">-->
					       <input class='buy_button' type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?//echo GetMessage("CATALOG_ADD")?>">
					     </form>
					   <?else:?>  
					     <noindex>
					       <!--<a href="<?echo $arOffer["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>-->
					       &nbsp;<a href="<?echo $arOffer["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>
					     </noindex>
					   <?endif;?>
					<?elseif(count($arResult["PRICES"]) > 0):?>
					   <?=GetMessage("CATALOG_NOT_AVAILABLE")?>
					<?endif?>
					
<div class='clear'></div>
 </div>
<div class='section-element-bottom'>

           <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
			 			<a  class='section-element-picture' href="<?=$arElement["DETAIL_PICTURE"]['SRC']?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
			<?else:?>
                <div class="section-element-picture" style='height:75px;'><img src='/images/zaglushka-mini2.jpg'></div>
            <?endif?>
<div class='section-element-properties'>
						<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<?if($arProperty['SORT']>450) continue;?>
							<p class='element-properties'><?if (empty($arProperty["DESCRIPTION"])):?><?=$arProperty["NAME"]?>:&nbsp;<?endif;?><?
								if(is_array($arProperty["DISPLAY_VALUE"]) && !empty($arProperty["DESCRIPTION"])) {
                                        foreach ($arProperty["DISPLAY_VALUE"] as $key=>$value){
                                          echo "<p class='element-properties'>".$arProperty["DESCRIPTION"][$key]."&nbsp;: <span class='prop-val'>".$value."</span></p>";
                                        }
                                }
                                    elseif (is_array($arProperty["DISPLAY_VALUE"])){
									echo "<span class='prop-val'>".(implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]))."</span>";
                                }
                                 else {
									echo "<span class='prop-val'>".$arProperty["DISPLAY_VALUE"]."</span>";
                                }?>
              </p>
						<?endforeach;?>
</div>
<div class='clear'></div>
</div>
</div> 
 <?endforeach;?>
  <?else:?>
 <?foreach($arElement["PRICES"] as $code=>$arPrice):?>
					<?if($arPrice["CAN_ACCESS"]):?>
					<p><?=$arResult["PRICES"][$code]["TITLE"];?>:&nbsp;&nbsp;
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?><span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
					</p>
					<?endif;?>
				  <?endforeach;?>
 		<?endif?>
	 	</div>
  <?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
  </div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

 </div>
 