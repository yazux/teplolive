<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo $arParams['ALICORN'];?>

<?
$arFilter = array(
    "IBLOCK_ID" => 8,                                                                                 // изменения тут!
    "SECTION_ID" => $arParams['ALICORN']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false);
while($ob = $res->GetNextElement())
{
    $arZecoror[] = $ob->GetFields();
}
if (!empty($arZecoror)){
    $everfree = true;
    //echo "есть элементы";
}
else {
    $everfree = false;
    //echo "нет элементов";
}
?>
<?if ($everfree == false):?>
<div class='catalog-left-column'>
    <?
    $APPLICATION->IncludeComponent("bitrix:menu", "catalog-multilevel", Array(
            "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
            "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
            "MAX_LEVEL" => "4",	// Уровень вложенности меню
            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
            "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            "DELAY" => "N",	// Откладывать выполнение шаблона меню
            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
        ),
        false
    );
    ?>
<?/*?>    
    <div class="big-filter" id="cat-filter">
        <?$APPLICATION->IncludeComponent("arcline:cat.filter.new", ".default", Array(
           "SECTION_ID" => "296",
           "FILTER_NAME" => "arrFilter",
            "ALICORN2" => $arParams['ALICORN'],
            //"AJX" => "Y"
           ),
           false
        );?>
    </div>
<?*/?>    
    <?/////////////////////////БРЕНД ФИЛЬТР/////////////////////////?>
    <?/*$res = CIBlockElement::GetList(Array(), array("IBLOCK_ID" => 15), false, false);
    while($ob = $res->GetNextElement()) {
        $arBrand[] = $ob->GetFields();
    }
    ?>  <?$dir = $APPLICATION->GetCurDir();?>
    <?if (!empty($arBrand)):?>
    <p class='brend-title'>Выбирете брэнд</p>
        <?//echo $_REQUEST['brand']."!@";?>
        <?foreach($arBrand as $brand):?>
            <a class='brend-filter' href='<?=$dir?>#brand=<?=$brand['NAME'];?>&catfilter=Y'><?=$brand['NAME'];?></a>
        <?endforeach;?>
    <?endif;*/?>
    <?/////////////////////////БРЕНД ФИЛЬТР КОНЕЦ///////////////////?>


</div>

<?/*$APPLICATION->IncludeComponent(
						"arcline:cat.sort",
						"",
						array (
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NAME" => $arParams["COMPARE_NAME"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],)
);       */
?>
<?if ($_REQUEST['catajaxrequest'] == 'Y')
  {
    $APPLICATION->RestartBuffer();  
  }
?>
<div class='catalog'>
    <?/////////////////////////////////////////////////////////////////////////////?>
    <?    ///               каталог разделов    ///
    $arSelect78 = array("UF_*");
    $arFilter78 = array(

        "IBLOCK_ID"        => 8,
        "IBLOCK_ACTIVE"    =>"Y",
        "SECTION_ID"       => $arParams['ALICORN']
    );
    $lich = CIBlockSection::GetList(Array(), $arFilter78, false, $arSelect78);
    while($leoric = $lich->GetNextElement()) {
        $ursa[] = $leoric->GetFields();
    }
    foreach ($ursa as $roshan) {
        $ursaId[] = $roshan['ID'];
    }
//echo "<pre>";
//print_r($ursaId);
//echo "</pre>"	?>
    <?/////////////////////////////////////////////////////////////////////////////?>
    <?GLOBAL $arrFilter;?>
    <?////////////////////////////////////////////////////////////////?>
    <?         ///            фильтр             ///
    $brandName = htmlspecialchars($_REQUEST['brand']);
    if (!empty($brandName)){
        $arFilter = array(
            "IBLOCK_ID" => 8,
            "SECTION_ID" => $arParams['ALICORN'],
            "INCLUDE_SUBSECTIONS" => "Y"
        );
        $arFilter["NAME"]="%".$brandName."%";
        $mergedFilter = array_merge($arFilter, $arrFilter);
        $res = CIBlockSection/*Element*/::GetList(Array(),  $arFilter, false, false);
        while($ob = $res->GetNextElement()) {
            $arSmall[] = $ob->GetFields();
        }
        foreach ($arSmall as $arSectId) {
            $arSectionId[] = $arSectId['ID'];
        }
    }
    ?>
    <?////////////////////////////////////////////////////////////////?>

    <?$APPLICATION->IncludeComponent(
    "arcline:catalog.section.list.root",
    "main-catalog-modified-root",
    Array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "ANALOG_ID" => $ursaId,
        "SECTION_ID" =>  $arParams["SECTION_ID_VARIABLE"],
        "itemCount" => $_SESSION["SHOW_COUNT"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "ADD_SECTIONS_CHAIN" => "N",
        "ALICORN" => $arParams['ALICORN']
    ),
    $component
);
    ?>
    <div id="hide-catalog">
        <img src='/images/325.gif'>
    </div>
    <?if (!empty($arSectionId) || empty($brandName)):?>
        <?$APPLICATION->IncludeComponent(
            "arcline:catalog.section.list",
            "main-catalog",
            Array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "ANALOG_ID" => $arSectionId,
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                "ADD_SECTIONS_CHAIN" => "N",
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "ALICORN" => $arParams['ALICORN']
            ),
            $component
            );?>
    <?elseif(!empty($_REQUEST['brand']) && empty($arSectionId)):?>
        <p>По вашему запросу ничего не найдено</p>
    <?endif;?>
    </div>
    <?if ($_REQUEST['catajaxrequest'] == 'Y'){ die(); } ?>
 <?endif;?>

<?if ($everfree == true):?>

<?ob_start();?>
<?$res = CIBlockSection::GetList(array(),array("CODE"=>fn_getSectionCode($_REQUEST['SECTION_CODE']),"IBLOCK_ID"=>8),false,array("ID","NAME"));
    if($res->SelectedRowsCount()==1){
        while($arSec = $res->GetNext()){
            $secName .= $arSec['NAME']." ";
        }
        $arSecName = explode(" ",trim($secName));
        foreach($arSecName as $k => $name){
            $arSecName[$k] = "%".$name."%";
        }
               
        $IDs = array();
        $x = array();
?>
<!--
if ($USER->IsAdmin()){
	print_r($arSecName);
}
-->
<?
        $res2 = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>3, "SECTION_ID"=>11,"TAGS"=>$arSecName));
        if($res2->SelectedRowsCount()>0){
            while($x = $res2->GetNext())
                $IDs[] = $x['ID'];
        }else{$IDs = array();}
    }?>
    <?
   
        $unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$arParams['ALICORN']),false, Array("UF_INFO"));
    if($sweetie=$unicorn->GetNext()){
        $arInfoId = array();
        foreach ($sweetie["UF_INFO"] as $Fluttershy => $Angel) {
            if ($Angel > 0) {
                $arInfoId[] = $Angel;
            }
        }
    }?>

    
<?if (!empty($arInfoId) || !empty($IDs)):?>
    <?//$yobaFilter?>
    <?
    	if (empty($IDs)) {$IDs = array();}
    	if (empty($arInfoId)) {$arInfoId = array();}
    	    	
    	$GLOBALS['yobaFilter'] = array(
            "ID"=>array_merge($arInfoId,$IDs)
        );    
    ?>
    <div class='cat-bottom-news'>
        <h2 class="catnewsbottitle">Инфосклад</h2>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "catalog-bottom", array(
	"IBLOCK_TYPE" => "infowarehouse",
	"IBLOCK_ID" => "3",
	"NEWS_COUNT" => "8",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "NAME",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "yobaFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "FILE",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "arrow",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
    </div>
    <?endif;?>
	
<?global $infosklad;?>
<?$infosklad=ob_get_contents();?>
<?ob_end_clean();?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"catalog-detail",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => "CML2_ARTICLE",
		"ELEMENT_SORT_ORDER" => "asc",
 		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		//"FILTER_NAME" => "arrFilter",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
	),
	$component
);
?>	
<?
$unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$arParams['ALICORN']),false, Array("UF_ANALOG"));
if($Twilight=$unicorn->GetNext()){}
    $analogIdCount = 0;
    foreach ($Twilight["UF_ANALOG"] as $Spike => $Rarity) {
        if ($Rarity > 0) {
            if ($analogIdCount == 4) {break;}
            $arAnalogId[] = $Rarity;
            $analogIdCount++;
        }
        else {
        //    echo "нет элементов";
        }
    }
    ?>
    <?if(!empty($arAnalogId)):?>
        <div class='analog'>
        <?$APPLICATION->IncludeComponent(
        "arcline:catalog.section.list",
        "analog-catalog",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ALICORN" => $arParams['ALICORN'],
            "ANALOG_ID" => $arAnalogId,
            "SECTION_ID" => $arAnalogId,
            "SECTION_CODE" => ''/*$arResult["VARIABLES"]["SECTION_CODE"]*/,
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "ADD_SECTIONS_CHAIN" => "N",
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            ),
            $component
        );?>
        </div>
    <?endif;?>
<?
    $unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$arParams['ALICORN']),false, Array("UF_RELATED"));
    if($Lyra=$unicorn->GetNext()){}
    $relatedIdCount = 0;
    foreach ($Lyra["UF_RELATED"] as $Fluttershy => $Angel) {
        if ($Angel > 0) {
            if ($relatedIdCount == 4) {break;}
            $arRelatedId[] = $Angel;
            $relatedIdCount++;
        }
        else {
        //        echo "нет элементов";
        }
    }
    ?>

<?if(!empty($arRelatedId)):?>
    <div class='analog'>
        <?$APPLICATION->IncludeComponent(
        "arcline:catalog.section.list",
        "analog-catalog",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ALICORN" => $arParams['ALICORN'],
            "RELATED" => 'Y',
            "ANALOG_ID" => $arRelatedId,
            "SECTION_ID" => $arRelatedId,
            "SECTION_CODE" => ''/*$arResult["VARIABLES"]["SECTION_CODE"]*/,
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "ADD_SECTIONS_CHAIN" => "N",
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        ),
        $component
    );?>
    </div>
    <?endif;?>


<?
    $unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8", "ID"=>$arParams['ALICORN']),false, Array("UF_NEWS"));
    if($sweetieBalle=$unicorn->GetNext()){}
    foreach ($sweetieBalle["UF_NEWS"] as $Fluttershy => $Angel) {
        if ($Angel > 0) {
            $arNewsId[] = $Angel;
        }
        else {
        }
    }
    ?>
<?if (!empty($arNewsId)):?>
    <?GLOBAL $yobaFilter2?>
    <?$yobaFilter2 = array("ID"=>$arNewsId);?>
    <div class='cat-bottom-news'>
    <h2 class="catnewsbottitle">Статьи по теме</h2>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "catalog-bottom", array(
	"IBLOCK_TYPE" => "News",
	"IBLOCK_ID" => "2",
	"NEWS_COUNT" => "8",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "yobaFilter2",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "FILE",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "arrow",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

        </div>
    <?endif;?>
<?if(!empty($_SESSION['LAST_CAT_ID'])):?>
        <?
        foreach ($_SESSION['LAST_CAT_ID'] as $someKe => $someIte) {
            $arrTempId[] = $someIte;
        }
        for ($g = 0; $g < count($arrTempId); $g++){
            for ($l = 0; $l < count($arrTempId); $l++){
                if ($arrTempId[$g] == $arrTempId[$l] && $g <> $l ){
                    unset($arrTempId[$l]);
                }
            }
        }
        foreach ($arrTempId as $Ke => $zZz) {
            if ($zZz == $arParams['ALICORN']) {
                unset($arrTempId[$Ke]);
             }
        }
        foreach ($arrTempId as $someKe => $someIte) {
        $arrTempId2[] = $someIte;
    }
        $y = count($arrTempId2);
        if (end($arrTempId2) == $arParams['ALICORN']) {
            $u = 2;
            $t = 15;
        }
        else {
            $u = 1;
            $t = 14;
        }
        for ($v=$y-$u; $v >= $y-$t; $v--) {
            if (!empty($arrTempId2[$v])) {
            $arrViewedId[]=$arrTempId2[$v];
            }
        }
        ?>
  <?if(!empty($arrViewedId)):?>
    <div class='viewed'>
        <h2 class="catnewsbottitle">Последние просмотренные</h2>
        <?$APPLICATION->IncludeComponent(
        "arcline:catalog.section.list",
        "viewed",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "RELATED" => 'Y',
            "ANALOG_ID" => $arrViewedId,
            "SECTION_ID" => $arrViewedId,
            "SECTION_CODE" => '',
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "ADD_SECTIONS_CHAIN" => "N",
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        ),
        $component
    );?>
    </div>
    <div class='clear'></div>
  <?endif;?>
<?endif;?>
<?endif;?>