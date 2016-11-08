<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>"; print_r($arResult); echo "</pre>";
?>
<?
//  $arResult['Navi']->NavPrint("", false, "", "/bitrix/templates/teplolive/components/bitrix/system.pagenavigation/navigation/template.php");
?>
<?
$arFilter = array (
  "IBLOCK_ID" => 8                                                                  // изменения тут!
);
?>

<div class="viewed-catalog">
<?foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?if ($CURRENT_DEPTH >= 1):                    //изменения тут?>
 <div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class='viewed-item'>
    <div class='img-wrap'><?
        if (!empty($arSection["PICTURE"]['SRC'])):
            ?><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src='<?=$arSection["PICTURE"]['SRC'];?>'></a>
            <?else:?>
                <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src='<?=$arSection["PREVIEW_PICTURE"]?>'></a>
            <?endif;?>
    </div>
     <div class='name-wrap'>
        <?if (strlen($arSection["NAME"]) > 26):?>
        <?
            $name = substr ($arSection["NAME"],0, 26);
            $name = $name."...";
        ?>
        <?else:?>
            <?$name = $arSection["NAME"];?>
        <?endif;?>
        <a class='viewed-item-name' href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$name?></a>
     </div>
     </div>
    <?endif;?>
<?endforeach?>
<div class='clear'></div>
<?
//  $arResult['Navi']->NavPrint("", false, "", "/bitrix/templates/teplolive/components/bitrix/system.pagenavigation/navigation/template.php");
?>
</div>

