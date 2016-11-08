<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
if (CModule::IncludeModule("catalog"))
{
    if(strlen($_REQUEST['product'])>0){
		CModule::IncludeModule("catalog");
		CModule::IncludeModule("sale");
		$id = intval($_REQUEST['product']);
		$quantity = intval($_REQUEST['quantity']);
		$quick_order = htmlspecialchars($_REQUEST['quick_order']);
		
		if (($quantity<1) && ($quick_order!='Y')) {$quantity=1;}
		
		$arProduct = CCatalogProduct::GetByIDEx($id);
		$arPrice = CCatalogProduct::GetOptimalPrice($id,1,$USER->GetUserGroupArray());		
		
		if ($arProduct['ID']<1) {return;}
		
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

		if ($quick_order=='Y'){
			$dbBasketItems = CSaleBasket::GetList(
			     array(
			                "NAME" => "ASC",
			                "ID" => "ASC"
			             ),
			     array(
			                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
			                "LID" => SITE_ID,
			                "ORDER_ID" => "NULL",
			                "PRODUCT_ID" => $id
			             ),
			     false,
			     false,
			     array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS")
			             );
			             
			 if ($dbBasketItems->SelectedRowsCount()>0){
			 	 $arBasketItem = $dbBasketItems->GetNext();
				 $add = CSaleBasket::Update($arBasketItem['ID'],$arFields);
				 echo "update";
			 } else {
				 $add = CSaleBasket::Add($arFields);	
				 echo "add";
				 pr($arFields);			 
			 }           
		} else {
			$add = CSaleBasket::Add($arFields);
		}
	}
	?>
	<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","basket_small",Array(
			"PATH_TO_BASKET" => "/basket.php",
			"PATH_TO_ORDER" => "/personal/order/make/"
		)
	);?>
<?}?>