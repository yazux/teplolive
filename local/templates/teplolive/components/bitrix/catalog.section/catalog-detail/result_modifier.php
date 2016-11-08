<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$arResult['ID']),false, Array("UF_SECTION_FILE", "UF_OPTIONS"));
if($Twilight=$unicorn->GetNext()){}
//echo "<pre>";
//print_r($arParams);
//echo "</pre>";
//die();
if (!empty($Twilight["UF_SECTION_FILE"])){
    $arFltr = array(
        "IBLOCK_ID" => 11,                                                                                 // изменения тут!
        "ID" => $Twilight["UF_SECTION_FILE"]);
    $res = CIBlockElement::GetList(Array(), $arFltr, false, false, array("PROPERTY_FILE"));
    while($od = $res->GetNextElement()){
        $arFiles[] = $od->GetFields();
    }
    foreach ($arFiles as $Spike => $Rarity) {
      if (!empty($Rarity)) {
            ($arResult["SECTION_FILE"][$Spike] = CFile::GetFileArray($Rarity['PROPERTY_FILE_VALUE']));
        }
    }
}
//echo "<pre>"; print_r($arFiles); echo "</pre>";

$arResult["SECTION_OPTIONS"] = $Twilight["UF_OPTIONS"];
?>

<?
CModule::IncludeModule("catalog");    

$db_res = GetCatalogGroups(($b="SORT"), ($o="ASC"));

while ($zes = $db_res->Fetch())
{
  $priceType[] = $zes;
}

  //echo "<pre>";
  //print_r($priceType);
  //echo "</pre>";  

foreach ($priceType as $type) {
  if ($arParams[PRICE_CODE][0] == $type['NAME']) {
  //echo "zbs";
    $GROUP_ID = $type['ID'];
  }
}
//echo $GROUP_ID;
$string1 = "CATALOG_GROUP_".$GROUP_ID."_VALUE";
$string2 = "CATALOG_PRICE_".$GROUP_ID;
$string3 = "CATALOG_CURRENCY_".$GROUP_ID;
                                                          
$arFilter = array(
    "IBLOCK_ID" => 8,                                                                                 // изменения тут!
    "SECTION_CODE" => /*$arSection["CODE"]*/$arResult['CODE']);
  $res = CIBlockElement::GetList(Array(), $arFilter, false, false);
  while($ob = $res->GetNextElement())
  {
    $arFields[] = $ob->GetFields();
  } 
  //echo "<pre>";
  //print_r($arFields);
  //echo "</pre>";
 if (!empty($arResult['DETAIL_PICTURE']['SRC'])) {
        echo "";
 }
 else {
    foreach ($arFields as $arPicture){
        if (!empty($arPicture['DETAIL_PICTURE'])){
            $arResult['DETAIL_PICTURE']['SRC'] = CFile::GetPath($arPicture['DETAIL_PICTURE']);
            break;
        }
    }
 }

  foreach($arFields as $arId)
  {
    $arrID[] = $arId['ID'];
  }
  
  /* echo "<pre>";
  print_r($arrID);
  echo "</pre>"; */
  if (!empty($arrID)) {  
  $arFilter2 = array(
   "IBLOCK_ID" => 9,                                                                 // изменения тут!
   "PROPERTY_CML2_LINK" => $arrID
   ); 
$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, Array("ID", $string1, "PROPERTY_CML2_LINK"));
  while($ob2 = $res2->GetNextElement())
  {
    $arOfferss[] = $ob2->GetFields();
  }
   if (!empty($arOfferss)) {
    $arResult['SECTIONS'][$i]["EMPTYNESS"]="N";
   }
  //echo "132";
  //echo "<pre>";
  //print_r($arOfferss);
  //echo "</pre>";   
  }
  else {
    $arResult['SECTIONS'][$i]["EMPTYNESS"]="Y";
   }
  foreach ($arOfferss as $arPrice3) {
    if (($arPrice3['CATALOG_VAT']>0) && ($arPrice3['CATALOG_VAT_INCLUDED']=='N')){
	    	$arPride[] = round($arPrice3[$string2]+$arPrice3[$string2]*floatval($arPrice3['CATALOG_VAT'])/100,2);
    } else {
       	$arPride[] = $arPrice3[$string2];	
    }
    $arCur = $arPrice3[$string3];
    $arVat = $arPrice3['CATALOG_VAT'];
    $Pride = min($arPride);
  } 
  if ($arParams['PRICE_VAT_INCLUDE'] === 1){
  
  }
   if ($arCur <> "RUB"){
         $arResult["MIN_PRICE"] = CCurrencyRates::ConvertCurrency($Pride, $arCur, "RUB");      //!!внимательно!!!!
         //echo          
    }
    else {
        $arResult["MIN_PRICE"] = $Pride;                                                      //!!внимательно!!!!
    } 
 // $arResult["MIN_PRICE"] = min($arPride);
  //$arResult["VALUTA"] = $arCur;
  //echo " ";
  unset ($arrID); 
  unset ($arOfferss);
  unset($ar_res);
  unset($arFields);
  unset($arPride);
  unset($arCur);
//echo "<pre>"; print_r($arResult); echo "</pre>";

?>
