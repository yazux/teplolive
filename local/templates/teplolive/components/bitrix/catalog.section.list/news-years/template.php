<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>"; print_r($arResult); echo "</pre>";?>
<ul  class="news-years">
<?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
?>
<?if($CURRENT_DEPTH ==2 ):?>
<?$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];?>
<?if ($arSection["ELEMENT_CNT"]>0):?>
<li class="news-year" id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<?=$arSection["SECTION_PAGE_URL"]?><?//=$arResult["SECTION"]['CODE']?><?//=$arSection["CODE"]?>"><?=$arSection["NAME"]?></a></li>
<?endif;?>
<?endif;?>
 <?endforeach?>
</ul>
<div class="clear"></div>

