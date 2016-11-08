<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo $arParams[PRICE_CODE][0];

CModule::IncludeModule("catalog");    

$db_res = GetCatalogGroups(($b="SORT"), ($o="ASC"));

while ($zes = $db_res->Fetch())
{
  $priceType[] = $zes;
}

/*  echo "<pre>";
  print_r($priceType);
  echo "</pre>";  */

foreach ($priceType as $type) {
  if ($arParams[PRICE_CODE][0] == $type['NAME']) {
    $GROUP_ID = $type['ID'];
  }
}
//echo $GROUP_ID;
$string1 = "CATALOG_GROUP_".$GROUP_ID."_VALUE";
$string2 = "CATALOG_PRICE_".$GROUP_ID;

 
foreach($arResult["SECTIONS"] as $arSection):
$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
if ($CURRENT_DEPTH == 2):
  $arElements[]=$arSection['ID'];
endif;
endforeach;

$i=0;
//$SKU_IBLOCK_ID = 6;
//$sku_items = GetIBlockElementListEx("Catalog",
 //                $SKU_IBLOCK_ID,
 //                        array(),
 //                        array(/*'CATALOG_PRICE_3' => 'ASC', '>CATALOG_QUANTITY' => 0*/),
  //                       100,
  //                       array(/*"=PROPERTY_CML2_LINK_VALUE" => $arElements*/),
  //                       array("ID", "CATALOG_GROUP_3_VALUE", "PROPERTY_CML2_LINK")
// );


//while($arItem = $sku_items->GetNext())
//{
  //     $minPrice[] = $arItem['CATALOG_PRICE_3'] ;
//}
//  echo "<pre>";
//  print_r($sku_items);
//  echo "</pre>";  
/*$arFilter2 = array(
   "IBLOCK_ID" => 6,
   "PROPERTY_CML2_LINK_VALUE" => $arElements 
   ); 
$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, Array("ID","CATALOG_GROUP_3_VALUE", "PROPERTY_CML2_LINK"));
  while($ob2 = $res2->GetNextElement())
  {
    $arOfferss[] = $ob2->GetFields();
  }      
  echo "<pre>";
  print_r($arOfferss);
  echo "</pre>";*/
  
     
 /* $offers = CIBlockPriceTools::GetOffersArray(6, 25, Array(), Array(), Array(), "",
        Array
        (
        'BASE' => Array
            (
                'ID' => '',
                'TITLE' => 'Розничная цена',
                'SELECT' => 'CATALOG_GROUP_3',
                'CAN_VIEW' => 1,
                'CAN_BUY' => 1
            )
          
        )
    ); 
  echo "<pre>";
  print_r($offers);
  echo "</pre>";  */
foreach($arResult["SECTIONS"] as $arSection):
$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
if ($CURRENT_DEPTH == 2):

//  $sku_items = GetIBlockElementListEx("Catalog",
//                 $SKU_IBLOCK_ID,
//                         array(),
//                         array(/*'CATALOG_PRICE_3' => 'ASC', '>CATALOG_QUANTITY' => 0*/),
//                         100,
//                         array("PROPERTY_CML2_LINK" => $arSection['ID']),
//                         array("ID","CATALOG_GROUP_3_VALUE", "PROPERTY_CML2_LINK")
// );


//while($arItem = $sku_items->GetNext())
//{
//       echo $arSection['ID'].' ';
//       echo $minPrice[] = $arItem['CATALOG_PRICE_3']."<br />" ;
//}
  
  

  $arFilter = array(
    "IBLOCK_ID" => 4,
    "SECTION_CODE" => $arSection["CODE"]);
  $res = CIBlockElement::GetList(Array(), $arFilter, false, false);
  while($ob = $res->GetNextElement())
  {
    $arFields[] = $ob->GetFields();
  } 
  //echo "<pre>";
  //print_r($arFields);
 // echo "</pre>"; 
   
  foreach($arFields as $arId)
  {
    /*$db_res = CPrice::GetList(
        array(),
        array(
                "PRODUCT_ID" => $arId['ID'],
             )
    );
    if ($ar_res = $db_res->Fetch())
    {
      $arPride[]=$ar_res["PRICE"];
      
    } */
    $arrID[] = $arId['ID'];
  }
  
  /* echo "<pre>";
  print_r($arrID);
  echo "</pre>"; */
  if (!empty($arrID)) {  
  $arFilter2 = array(
   "IBLOCK_ID" => 6,
   "PROPERTY_CML2_LINK" => $arrID
   ); 
$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, Array("ID", $string1, "PROPERTY_CML2_LINK"));
  while($ob2 = $res2->GetNextElement())
  {
    $arOfferss[] = $ob2->GetFields();
  }
        
  //echo "132";
  //echo "<pre>";
  //print_r($arOfferss);
  //echo "</pre>";   
  }
  foreach ($arOfferss as $arPrice3){
    $arPride[] = $arPrice3[$string2];
  } 

   
  $arResult['SECTIONS'][$i]["MIN_PRICE"] = min($arPride);
//  unset($arItem);
//  unset($sku_items); 
//  unset($minPrice);
  unset ($arrID); 
  unset ($arOfferss);
  unset($ar_res);
  unset($arFields);
  unset($arPride);    
endif;  
$i++;
endforeach;    
?>      