<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section-quick">
    <div class='bot-padding'>
	<?//pr($arResult);?>
	<table cellpadding="0" cellspacing="0" border="0">
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
			<?if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):?>
				<?foreach($arElement["OFFERS"] as $arOffer):?>
				<tr class="quick-order-item">
					<?$isExist = (intval($arOffer['CATALOG_QUANTITY'])>0)?"<span class=\"vnalichii\" style=\"padding-top: 4px;color: green\">В наличии (".$arOffer['CATALOG_QUANTITY'].")</span>":"<span class=\"podzakaz\" style=\"padding-top: 4px;color: red\">Под заказ</span>"?>
							<td class='kod'><?=$arElement['PROPERTIES']['CML2_ARTICLE']['VALUE'];?></td>
							<td class='title'>
								<a target="_blank" href="/catalog/<?=$arElement["SECTION_CODE"]?>/">
									<?=$arElement["PREVIEW_TEXT"]?>
								</a>
							</td>
							<td class='nalichie'>
								<?=$isExist?>
							</td>
							<td class="price">
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
							</td>
							<td class="kolvo" >
								<?if($arOffer["CAN_BUY"]):?>
									<?if($arParams["USE_PRODUCT_QUANTITY"]):?>
										<form class='quan-form' action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
											<div class='quant'>
												<div class='minus-quick-order'></div>
												<input class='quan product_<?=$arOffer["ID"]?>' type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="0" size="5" rel="<?=round($arPrice["VALUE"]);?>">
												<div class='plus-quick-order'></div>	
												<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
												<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arOffer["ID"]?>">
												<?if((strlen($_REQUEST["article"])>0)||((strlen($_REQUEST["naimenovanie"])>0))){?>
													<input type="hidden" name="filter-butt" value="asd">
													<?if(strlen($_REQUEST["article"])>0){?>
														<input type="hidden" name="article" value="<?=$_REQUEST["article"]?>">
													<?}?>
													<?if(strlen($_REQUEST["naimenovanie"])>0){?>
														<input type="hidden" name="naimenovanie" value="<?=$_REQUEST["naimenovanie"]?>">
													<?}?>
												<?}?>
												<div class="clear"></div>
											</div>
										</form>
									<?else:?>  
										<noindex>
											<!--<a href="<?echo $arOffer["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>-->
										   &nbsp;<a href="<?echo $arOffer["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>
										</noindex>
									<?endif;?>
								<?elseif(count($arResult["PRICES"]) > 0):?>
									<?=GetMessage("CATALOG_NOT_AVAILABLE");?>
								<?endif;?>
							</td>	
				</tr>		
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
		<?endforeach;?>
	</table>	
	</div>
 </div>
 