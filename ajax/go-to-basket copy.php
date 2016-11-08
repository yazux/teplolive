<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
if (CModule::IncludeModule("catalog"))
{
    if(strlen($_REQUEST['product'])>0){
		CModule::IncludeModule("catalog");
		CModule::IncludeModule("sale");
		$id = $_REQUEST['product'];
		$quantity = $_REQUEST['quantity'];
		
		if ($quantity<1) {$quantity=1;}
		
		$arProduct = CCatalogProduct::GetByIDEx($id);
		$arPrice = CCatalogProduct::GetOptimalPrice($id,1,$USER->GetUserGroupArray());		
		
		$arFields = array(
			"PRODUCT_ID" => $arProduct['ID'],
			"PRICE" => $arPrice['DISCOUNT_PRICE'],
			"PRODUCT_PRICE_ID" => $arPrice['ID'],
			"CURRENCY" => "RUB",
			"WEIGHT" => $arProduct['PRODUCT']['WEIGHT'],
			"QUANTITY" => $quantity,
			"LID" => $arProduct['LID'],
			"DELAY" => "N",
			"CAN_BUY" => "Y",
			"NAME" => $arProduct['NAME'],
			"MODULE" => "catalog",
			"PRODUCT_XML_ID"=> $arProduct["EXTERNAL_ID"],
			"CATALOG_XML_ID" =>$arProduct["IBLOCK_EXTERNAL_ID"],
			"NOTES" => "",
			"DETAIL_PAGE_URL" => $arProduct['DETAIL_PAGE_URL']
		);

		$add = CSaleBasket::Add($arFields);
		
	}
	?>
	<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","basket_small",Array(
			"PATH_TO_BASKET" => "/basket.php",
			"PATH_TO_ORDER" => "/personal/order/make/"
		)
	);?>
<?}?>