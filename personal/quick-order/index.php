<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<?
function pr($mass){
	global $USER;
	if ($USER->IsAdmin()){
		echo "<pre>";
		print_r($mass);
		echo "</pre>";
	}
}
?>
<div class='personal-menu'>
    <a href='/personal/' class='profile'>Мои заказы</a>
	<a href='/personal/profile/' class='profile'>Ваш профиль</a>
	<p class='my-order'>Быстрый заказ</p>
    <div class="clear"></div>
</div>
<?CModule::IncludeModule("iblock");?>
<?CModule::IncludeModule("catalog");?>
<?$arFirstSect=array();?>
<?/*находим и кешируем разделы первого уровня вложенности и количество доступных к покупке элементов в них*/?>
<?$obFilterFirstSect=new CPHPCache; 
$life_cache = 86400;
$cache_id="FirstSections";
if($obFilterFirstSect->InitCache($life_cache,$cache_id,"/FirstSections")){
		$vars = $obFilterFirstSect -> GetVars();
		$arFirstSect = $vars["arFirstSect"];
	}else{
		$arFilter = Array('IBLOCK_ID'=>8, "ACTIVE"=>"Y", "DEPTH_LEVEL"=>"1");
		$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, false);
		if(intval($db_list->SelectedRowsCount())>0){
			while($arSection = $db_list->GetNext()){
				if(intval($arSection["ID"])>0){
					$arFilterSub = array(
						'IBLOCK_ID' => 9,
						'>CATALOG_QUANTITY' => 0
					);
					$res = CIBlockElement::GetList(array("SORT"=>"ASC"), array('IBLOCK_TYPE' => 'Catalog', 'IBLOCK_ID' => 8, 'ID'=>CIBlockElement::SubQuery('PROPERTY_CML2_LINK', $arFilterSub), "SECTION_ID"=>$arSection["ID"], "INCLUDE_SUBSECTIONS"=>"Y"),array(),false,array('ID', 'NAME'));
					$arFirstSect[$arSection["ID"]]["COUNT"]=$res;
					$arFirstSect[$arSection["ID"]]["NAME"]=$arSection["NAME"];
				}
			}
		}
	}		
if($obFilterFirstSect->StartDataCache()){
	$obFilterFirstSect->EndDataCache(array(
	"arFirstSect"=>$arFirstSect
	));
}	
?>
<?if((intval($_REQUEST["SECTION_ID"])==0)&&(strlen($_REQUEST["filter-butt"])==0)){
	$_REQUEST["SECTION_ID"]="1551";/*id razdela nasosov*/
}?>
<?//pr($_REQUEST);?>
<div class="quick-order-cont">
	<?if(!empty($arFirstSect)){?>
		<div class="quick-order-title">Разделы каталога:</div>
		<div class="first-sections">
			<div class="sect-block-1 sect-block">
			<?$i=0;?>
			<?foreach($arFirstSect as $key=>$oneFirstSect){?>
				<div class="one-first-sect"><a <?if($key==$_REQUEST["SECTION_ID"]){?>class="selected"<?}?> href="<?=$APPLICATION->GetCurPageParam("SECTION_ID=".$key, array("SECTION_ID"));?>"><?=$oneFirstSect["NAME"]?></a><span class="count"> (<?=$oneFirstSect["COUNT"]?>)</span></div>
				<?$i++;?>
				<?//echo $i;?>
				<?if($i==ceil(count($arFirstSect)/3)){?>
					</div><div class="sect-block-2 sect-block">
					<?$i=0;?>
				<?}?>
			<?}?>
			</div>
			<div class="clear"></div>
		</div>
	<?}?>
	<form class="" action="/personal/quick-order/" method="post" enctype="multipart/form-data">	<div class="filter-cont"><span class="filt-title">Поиск товара.</span><span class="filt-label">Наименование: </span><input name="naimenovanie" class="filt-inp filt-inp-1" <?if(strlen($_REQUEST["naimenovanie"])>0){?>value="<?=$_REQUEST["naimenovanie"]?>"<?}?>/><span class="filt-label">Артикул: </span><input name="article" class="filt-inp filt-inp-2" <?if(strlen($_REQUEST["article"])>0){?>value="<?=$_REQUEST["article"]?>"<?}?>/><input type="submit" value="найти товар" name="filter-butt" class="filt-main-button"/></div>
	</form>
	
	<?if(intval($_REQUEST["SECTION_ID"])>0){?>
		<?$arFilterDL2 = Array('IBLOCK_ID'=>8, "ACTIVE"=>"Y", "DEPTH_LEVEL"=>"2", "SECTION_ID"=>intval($_REQUEST["SECTION_ID"]));
		$db_listDL2 = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilterDL2, false, array("ID","NAME"));
		if(intval($db_listDL2->SelectedRowsCount())>0){
			while($arSectionDL2 = $db_listDL2->GetNext()){
				$arSectMass[$arSectionDL2["ID"]]["NAME"]=$arSectionDL2["NAME"];
				$arFilterSubDL2 = array(
					'IBLOCK_ID' => 9,
					'>CATALOG_QUANTITY' => 0
				);
				$resAvialable = CIBlockElement::GetList(array("SORT"=>"ASC"), array('IBLOCK_TYPE' => 'Catalog', 'IBLOCK_ID' => 8, 'ID'=>CIBlockElement::SubQuery('PROPERTY_CML2_LINK', $arFilterSubDL2), "SECTION_ID"=>$arSectionDL2["ID"], "INCLUDE_SUBSECTIONS"=>"Y"),false,false,array('ID', 'NAME'));
				if(intval($resAvialable->SelectedRowsCount())>0){
					while($obAvialable = $resAvialable->GetNextElement()){ 
						$arFieldsAvialable = $obAvialable->GetFields();
						$arSectMass[$arSectionDL2["ID"]]["ITEMS"][]=$arFieldsAvialable["ID"];
					}	
				}	
			}
		}
		?>
	<?}elseif((strlen($_REQUEST["naimenovanie"])>0)||(strlen($_REQUEST["article"])>0)){?>
		<?
			$arSelectTwo = Array("ID", "IBLOCK_ID", "NAME", "SECTION_ID");
			$arFilterTwo = Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y");
			/*if((strlen($_REQUEST["naimenovanie"])>0)&&(strlen($_REQUEST["article"])>0)){
				$arFilterTwo[] = array(
					"LOGIC" => "OR",
						array("NAME"=>"%".$_REQUEST["naimenovanie"]."%"),
						array("PROPERTY_CML2_ARTICLE"=>"%".$_REQUEST["article"]."%")
				); */
			if(strlen($_REQUEST["naimenovanie"])>0){
				$arFilterTwo["NAME"]="%".$_REQUEST["naimenovanie"]."%";
			}
			if(strlen($_REQUEST["article"])>0){
				$arFilterTwo["PROPERTY_CML2_ARTICLE"]="%".$_REQUEST["article"]."%";
			}
			$resTwo = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilterTwo, false, false, $arSelectTwo);
			if(intval($resTwo->SelectedRowsCount())>0){
				while($obTwo = $resTwo->GetNextElement()){
					$arFieldsTwo = $obTwo->GetFields();
						$arMass[]=$arFieldsTwo["ID"];
				}
			}
		?>
	<?}?>
	<table cellpadding="0" cellspacing="0" border="0" class="tablehead">
		<tr>
			<td class="kod">Артикул:</td>
			<td class="title">Наименование:</td>
			<td class="nalichie">Наличие: (шт.)</td>
			<td class="price" style="text-align: left;"><span style="padding-left:12px;">Цена: руб.</span></td>
			<td class="kolvo" ><span style="padding-left:52px;">Количество:</span></td>
		</tr>	
	</table>
	<?if(intval($_REQUEST["SECTION_ID"])>0){?>
		<?foreach($arSectMass as $sectkey=>$sectvalue){?>
			<?if((array_key_exists("ITEMS",$sectvalue))&&(!empty($sectvalue["ITEMS"]))){?>
				<div class="section-title-row"><span><?=$sectvalue["NAME"];?></span></div>
				<?$arFilterIDS=array("ID"=>$sectvalue["ITEMS"]);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"quick-order",
						Array(
							"IBLOCK_TYPE" => "Catalog",
							"IBLOCK_ID" => "8",
							"ELEMENT_SORT_FIELD" => "CML2_ARTICLE",
							"ELEMENT_SORT_ORDER" => "asc",
							"PROPERTY_CODE" => Array ("0" => "CML2_BASE_UNIT", "1" => "CML2_TRAITS", "2" => "CML2_ATTRIBUTES", "3" => "CML2_BAR_CODE", "4" => "MAXTIME", "5" => "PODA4A", "6" => "PODEM", "7" => "MOWNOSTb", "8" => "REZBA"),
							"META_KEYWORDS" => "",
							"META_DESCRIPTION" => "",
							"BROWSER_TITLE" => "",
							"BASKET_URL" => "/personal/basket.php",
							"ACTION_VARIABLE" => "action",
							"PRODUCT_ID_VARIABLE" => "",
							"SECTION_ID_VARIABLE" => "",
							"PRODUCT_QUANTITY_VARIABLE" => "quantity",
							"FILTER_NAME" => "arFilterIDS",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "Y",
							"INCLUDE_SUBSECTIONS" => "Y",
							"SHOW_ALL_WO_SECTION" => "Y",
							"SET_TITLE" => "N",
							"SET_STATUS_404" => "N",
							"DISPLAY_COMPARE" => "N",
							"PAGE_ELEMENT_COUNT" => "999",
							"LINE_ELEMENT_COUNT" => "999",
							"PRICE_CODE" => Array ("0" => "Основная цена продажи"),
							"USE_PRICE_COUNT" => "N",
							"SHOW_PRICE_COUNT" => "1",
							"PRICE_VAT_INCLUDE" => "Y",
							"USE_PRODUCT_QUANTITY" => "Y",
							"DISPLAY_TOP_PAGER" => "Y",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
							"PAGER_SHOW_ALL" => "N",
							"OFFERS_CART_PROPERTIES" => Array("0" => "CML2_LINK"),
							"OFFERS_FIELD_CODE" => Array ("0" => "NAME"),
							"OFFERS_PROPERTY_CODE" => Array("0" => "CML2_LINK"),
							"OFFERS_SORT_FIELD" => "sort",
							"OFFERS_SORT_ORDER" => "asc",
							"OFFERS_LIMIT" => "0",
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"SECTION_URL" => "",
							"DETAIL_URL" => "",
							'CONVERT_CURRENCY' => "Y",
							'CURRENCY_ID' => "RUB",
						),
						$component
					);
					?>	
			<?}?>
		<?}?>
	<?}elseif(!empty($arMass)){?>
		<?$arFilterIDS=array("ID"=>$arMass);?>
		
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"quick-order",
			Array(
				"IBLOCK_TYPE" => "Catalog",
				"IBLOCK_ID" => "8",
				"ELEMENT_SORT_FIELD" => "CML2_ARTICLE",
				"ELEMENT_SORT_ORDER" => "asc",
				"PROPERTY_CODE" => Array ("0" => "CML2_BASE_UNIT", "1" => "CML2_TRAITS", "2" => "CML2_ATTRIBUTES", "3" => "CML2_BAR_CODE", "4" => "MAXTIME", "5" => "PODA4A", "6" => "PODEM", "7" => "MOWNOSTb", "8" => "REZBA"),
				"META_KEYWORDS" => "",
				"META_DESCRIPTION" => "",
				"BROWSER_TITLE" => "",
				"BASKET_URL" => "/personal/basket.php",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "",
				"SECTION_ID_VARIABLE" => "",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"FILTER_NAME" => "arFilterIDS",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "Y",
				"INCLUDE_SUBSECTIONS" => "Y",
				"SHOW_ALL_WO_SECTION" => "Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"DISPLAY_COMPARE" => "N",
				"PAGE_ELEMENT_COUNT" => "999",
				"LINE_ELEMENT_COUNT" => "999",
				"PRICE_CODE" => Array ("0" => "Основная цена продажи"),
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"USE_PRODUCT_QUANTITY" => "Y",
				"DISPLAY_TOP_PAGER" => "Y",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
				"PAGER_SHOW_ALL" => "N",
				"OFFERS_CART_PROPERTIES" => Array("0" => "CML2_LINK"),
				"OFFERS_FIELD_CODE" => Array ("0" => "NAME"),
				"OFFERS_PROPERTY_CODE" => Array("0" => "CML2_LINK"),
				"OFFERS_SORT_FIELD" => "sort",
				"OFFERS_SORT_ORDER" => "asc",
				"OFFERS_LIMIT" => "0",
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				'CONVERT_CURRENCY' => "Y",
				'CURRENCY_ID' => "RUB",
			),
			$component
		);
		?>
	<?}?>
	<div class="quick-order-bottom quick-order-bottom-fixed">
		<div class="quick-order-text-block">Выбрано товаров на странице: <span class="quick-order-blue kolvo-jq">0</span></div><div class="quick-order-text-block">на сумму: <span class="quick-order-blue"><span class="summ-jq">0</span> руб.</span></div><a href="javascript:void(0)" class="quick-order-main-button">Оформить заказ</a>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>