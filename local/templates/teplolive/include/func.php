<?
function fn_getSectionCode($temp_code)
 {
  $section_code='';
 
  global $APPLICATION;

  if (strlen(htmlspecialchars($temp_code))>0)
  {
   $section_code=$APPLICATION->GetCurDir();
  
   $arSCode=split ("/",$section_code);
  
   if (count($arSCode)>1)
   {
    $section_code='';
    for ($i=count($arSCode); $i>0;$i--)
    {
     if (strlen($section_code)<1)
     {
      $section_code=$arSCode[$i-1];
     } 
    } 
   }
  }
  return $section_code;
 }

// function pr($mass){
	// global $USER;
	// if ($USER->IsAdmin()){
		// echo "<pre>";
		// print_r($mass);
		// echo "</pre>";
	// }
// }

function fn_get_count_section()
{
  CModule::IncludeModule('iblock');
  $path = $arIBlock["LIST_PAGE_URL"];
  
 return $path;
}

function fn_set_newslist_section_path($iblock)
{
 global $APPLICATION;
 $arIBLOCK=GetIBlock($iblock);
 if (strlen($arIBLOCK["LIST_PAGE_URL"])>0)
 {
  if (preg_match('#'.$arIBLOCK["LIST_PAGE_URL"].'#',$APPLICATION->GetCurDir()))
  {
	$section_code=fn_getSectionCode('1');
    $arFilter = Array('IBLOCK_ID'=>$arIBlock["ID"],  'CODE'=>$section_code);
    $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
    if ($db_list->SelectedRowsCount()>0)
    {
     $arSection = $db_list->GetNext();  
     fn_set_iblocknavchain($arSection['IBLOCK_ID'],$arSection['IBLOCK_TYPE_ID'],$arSection['ID'],'');
    } 
  }
 }
}



function fn_get_chainpath($iblock,$idsection)
 {
  CModule::IncludeModule('iblock');
  $arIBlock = GetIBlock($iblock);
  $path = $arIBlock["LIST_PAGE_URL"];
  $nav = CIBlockSection::GetNavChain($iblock,$idsection);
  while($arChain=$nav->GetNext())
  {
   $path.=$arChain["CODE"]."/";
  }
  return $path;
 }
 

function fn_set_iblocknavchain($iblock,$iblocktype,$idsection,$idelement)
 {
     CModule::IncludeModule('iblock');
     global $APPLICATION;
     
     $arSect=GetIBlockSection($idsection,$iblocktype);
     
	 $nav = CIBlockSection::GetNavChain($iblock,$idsection);
	 $title=' / ';
	 while($arChain=$nav->GetNext())
	 {
	  if (strlen($path)<1) {$path=$arChain["LIST_PAGE_URL"];}
 	  $path.=$arChain["CODE"]."/";
 	  $title.=$arChain["NAME"]." / ";
	  $APPLICATION->AddChainItem($arChain["NAME"],$path); 
	 }
     $APPLICATION->SetPageProperty("title", $APPLICATION->GetProperty('title').$title);	  
}


function fn_setpage_el($iblock, $idsection, $idelement)
{


$sec="";
$nav = CIBlockSection::GetNavChain($iblock,$idsection);

while($arChain=$nav->GetNext())
  {
	
	$sec=$sec." - ".$arChain["NAME"];
	  }
	

if($idelement)
{
$arSelect = Array("NAME");
$arFilter = Array("IBLOCK_ID"=>$iblock, "ID"=>$idelement);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
$ob = $res->GetNextElement();
$arFields = $ob->GetFields();
$arFields["NAME"]=" - ".$arFields["NAME"];
} 
	
	
return $sec.$arFields["NAME"];



} 
function fn_setCatalogApplicationPath($IBLOCK_ID,$path){

	global $APPLICATION;

	$arSection=fn_getCurrSectionID($IBLOCK_ID,$path);

	if ($arSection['ID']>0){

		$APPLICATION->sDocPath2 = '/catalog/'.$arSection['ID'].'/';	

		$APPLICATION->sDocPath2 .= 'index.php';

	}

}
function fn_getCurrSectionID($IBLOCK_ID,$path){

	$arFoundSection=array();

	$arPathSections=preg_split('#/#',$path);

	foreach($arPathSections as $arrkey => $value){

		if (strlen($value)<1){

			unset($arPathSections[$arrkey]);

		}

	}

	$arPathSections=array_reverse($arPathSections);

	

	$found=false;

	

	foreach($arPathSections as $sectioncode){

    	$arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID,  'CODE'=>$sectioncode);

    	$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);

   		if ($db_list->SelectedRowsCount()>0){

   			$arSection=$db_list->GetNext();

   			$CompiledPath=fn_get_chainpath($arSection['IBLOCK_ID'],$arSection['ID']);

   			if ($CompiledPath==$path) {

   				$arFoundSection=$arSection;

   				break;

   			}

   		}		

	}	

	return $arFoundSection;

}
?>