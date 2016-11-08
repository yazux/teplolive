<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
	<?if(intval($arElement["IBLOCK_SECTION_ID"])>0){?>
		<?$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), array("ID"=>$arElement["IBLOCK_SECTION_ID"]), true, array("IBLOCK_ID","NAME", "CODE"));
			if($arSect = $db_list->GetNext()){
				$arResult["ITEMS"][$cell]["SECTION_CODE"]=$arSect["CODE"];
			}
		?>
	<?}?>
<?endforeach;?>
	