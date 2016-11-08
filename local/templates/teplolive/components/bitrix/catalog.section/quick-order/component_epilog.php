<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	CModule::IncludeModule('sale');
	$arBasket=array();
	$dbBasketItems = CSaleBasket::GetList(
	     array(
	                "NAME" => "ASC",
	                "ID" => "ASC"
	             ),
	     array(
	                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
	                "LID" => SITE_ID,
	                "ORDER_ID" => "NULL",
	             ),
	     false,
	     false,
	     array("ID", "PRODUCT_ID", "QUANTITY")
	             );
	             
	 if ($dbBasketItems->SelectedRowsCount()>0){
		 while($arItem=$dbBasketItems->GetNext()){
			 $arBasket[$arItem['PRODUCT_ID']]=$arItem['QUANTITY'];
		 }
	 }
	 if (count($arBasket)>0){
	 ?>
	 <script>
	 <?
		 foreach($arBasket as $product_id => $quantity){
			 ?>
			 fn_setQuantity(<?=$product_id?>,<?=$quantity?>);
			 <?
		 }
		 ?>
	</script>
		 <?
	 }
?>