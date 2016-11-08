<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 05.09.14
 * Time: 14:02
 */
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/teplolive/include/func.php');
CModule::IncludeModule('iblock');
CModule::IncludeModule('file');
$el = new CIBlockElement();
$iblockID = 3;
$sectionID = 2102;
//print_r($_REQUEST);
if(isset($_FILES) && !empty($_FILES)){
    $arFile = CFile::MakeFileArray($_FILES['clientDetails']['tmp_name'][0],$_FILES['clientDetails']['type'][0]);
    $fileID = CFile::SaveFile($arFile,"clientDetails");
    $arFields = array(
        "NAME" => "Реквизиты клиента ".$_REQUEST['BITRIX_SM_LOGIN'],
        "CODE" => $arFile['name'],
        "IBLOCK_ID" => $iblockID,
        "IBLOCK_SECTION_ID" => $sectionID,
        "ACTIVE" => "Y",
        "PREVIEW_TEXT" => $_REQUEST['BITRIX_SM_SALE_UID'],
        "PROPERTY_VALUES" => array(
            "FILE" => CFile::GetFileArray($fileID)
        )
    );
    $res = CIBlockElement::GetList(array("SORT"=>"ASC"),array("ACTIVE"=>"Y","IBLOCK_ID"=>$iblockID,"IBLOCK_SECTION_ID"=>$sectionID,"PREVIEW_TEXT"=>$_REQUEST['BITRIX_SM_SALE_UID']),false,array("nTopCount"=>1),array("ID","NAME"));
    if($res->SelectedRowsCount()>=1){
        $arElement = $res->GetNext();
        $elID = $arElement['ID'];
        $resUpd = $el->Update($elID,$arFields);
    }else{
        $elID = $el->Add($arFields);
    }

    echo $elID." (http://".$_SERVER['HTTP_HOST'].$arFields['PROPERTY_VALUES']['FILE']["SRC"].")";
}