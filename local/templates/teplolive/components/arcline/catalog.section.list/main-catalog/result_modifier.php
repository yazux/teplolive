<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>"; print_r($arResult); echo "</pre>";
//echo $arParams[PRICE_CODE][0];


CModule::IncludeModule("catalog");    
$sectionsCounter = 0;
foreach ($arResult['SECTIONS'] as $arPicture) {
    if (!empty($arPicture['PREVIEW_PICTURE'])) {
        echo "";
    }
    else {
        $arFilter = array(
            "IBLOCK_ID" => 8,                                                                                 // изменения тут!
            "SECTION_CODE" => $arPicture["CODE"]);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false);
        while($ob = $res->GetNextElement())
        {
            $arSmall[] = $ob->GetFields();
        }
        $sectionsItemCounter = 0;
        foreach ($arSmall as $arPreview){
            if (!empty($arPreview['PREVIEW_PICTURE'])){
                $arResult['SECTIONS'][$sectionsCounter]['PREVIEW_PICTURE'] = CFile::GetPath($arPreview['PREVIEW_PICTURE']);
                break;
            }
            $sectionsItemCounter++;
        }
        unset ($arSmall);
    }
    $sectionsCounter++;
}
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

 
//foreach($arResult["SECTIONS"] as $arSection):
//$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
//if ($CURRENT_DEPTH >= 3):                                   // изменения тут!
//  $arElements[]=$arSection['ID'];
///endif;
//endforeach;

$i=0;

foreach($arResult["SECTIONS"] as $arSection):
    //$sectionCode = $arSection["ID"];
    $res78 = CIBlockSection::GetList(array(),
        array('ID'=> $arSection["ID"]),
        false,
        array('UF_*')
    );
    while($ob78 = $res78->GetNextElement())
    {
        $Rarity = $ob78->GetFields();
    }
//    echo "<pre>"; print_r($Rarity); echo "</pre>";
//    if ( 0 < $arSection['ID'] ) {
        $arSelect78 = array(
            "UF_*",
        );
        $arFilter78 = array(
            "ACTIVE"           =>"Y",
            "GLOBAL_ACTIVE"    =>"Y",
            "IBLOCK_ID"        =>$arSection['IBLOCK_ID'],
            "IBLOCK_ACTIVE"    =>"Y",
            "ID"               =>$arSection['ID'],
        );
        $rsZzZ = CIBlockSection::GetList(Array(), $arFilter78, false, $arSelect78);
         $arResult78 = $rsZzZ->GetNext();
//    echo "<pre>"; print_r($arResult78); echo "</pre>";
//    }

    $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
    if ($CURRENT_DEPTH >= 1):                                            // изменения тут!!!

    $arFilter = array(
        "IBLOCK_ID" => 8,                                                                                 // изменения тут!
        "SECTION_CODE" => $arSection["CODE"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false);
    while($ob = $res->GetNextElement())
    {
        $arFields[] = $ob->GetFields();
    }
  //echo "<pre>";
  //print_r($arFields);
  //echo "</pre>";
   
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
        $arCur = $arPrice3 [$string3];
  } 
   
  $arResult['SECTIONS'][$i]["MIN_PRICE"] = min($arPride);
  $arResult['SECTIONS'][$i]["VALUTA"] = $arCur;
  //echo " ";
  

 // pr($arPride);
    
  unset ($arrID); 
  unset ($arOfferss);
  unset($ar_res);
  unset($arFields);
  unset($arPride);
  unset($arCur);    
endif;  
$i++;
endforeach;
foreach ($arResult['SECTIONS'] as $numKey => $arPic) {
    if (strlen($arPic['PREVIEW_PICTURE'])<=0){
        $arResult['SECTIONS'][$numKey]['PREVIEW_PICTURE'] = '/images/zaglushka.jpg';
    }
    $unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$arPic['ID']),false, Array("UF_LABEL"));
        if($Twilight=$unicorn->GetNext()){}
        if (strlen($Twilight["UF_LABEL"]) > 0) {
            $arFltr = array(
            "IBLOCK_ID" => 12,                                                                                 // изменения тут!
            "ID" => $Twilight["UF_LABEL"]);
            $res = CIBlockElement::GetList(Array(), $arFltr, false, false, array());
            $od = $res->GetNextElement();
            $arLabel = $od->GetFields();
            $arResult['SECTIONS'][$numKey]['label'] = CFile::GetFileArray($arLabel['PREVIEW_PICTURE']);
        }
        unset ($arLabel);   
}
//echo "<pre>"; print_r($arResult); echo "</pre>";
?>      