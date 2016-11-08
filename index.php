<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Главная");
$APPLICATION->SetTitle("Главная страница");
?> <?
    $unicorn = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"8"/*, "ID"=>$arParams['ALICORN']*/),false, Array("UF_SPECIAL","UF_LEADER"));
    while($Twilight=$unicorn->GetNext()){
        $someArray[] = $Twilight;
    }
$analogIdCount = 0;
$leaderIdCount = 0;
    foreach ($someArray as $Spike => $Rarity) {
        if ($Rarity["UF_SPECIAL"] == 'Y') {
            if ($analogIdCount == 3) {break;}
            $arSpecialId[] = $Rarity['ID'];
            $analogIdCount++;
        }
        else {
            //    echo "нет элементов";
        }
        if ($Rarity["UF_LEADER"] == 'Y') {
            if ($leaderIdCount == 6) {break;}
            $arLeaderId[] = $Rarity['ID'];
            $leaderIdCount++;
        }
        else {
            //    echo "нет элементов";
        }
    }
    ?> <?if(!empty($arSpecialId)):?> 
<div class="special-offers"> 
  <h2 class="main-page-title">   Спецпредложения месяца   
    <div class="content-block"> 
      <div class="content-block-head"> 
        <br />
       </div>
     </div>
   </h2>
 <?$APPLICATION->IncludeComponent(
	"arcline:catalog.section.list",
	"special-catalog",
	Array(
		"IBLOCK_TYPE" => "Catalog",
		"IBLOCK_ID" => "8",
		"ANALOG_ID" => $arSpecialId,
		"SECTION_ID" => $arSpecialId,
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"SECTION_URL" => "/catalog/#CODE#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "Y"
	),
$component
);?> </div>
 <?endif;?> 
<div class="beslave"><span class="acceptbeslave"><font><font size="3">Подпишитесь на рассылку</font></font></span> 
<!--<input class='slaveemail' type="text">-->
 <?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form",
	".default",
	Array(
		"USE_PERSONALIZATION" => "Y",
		"PAGE" => "#SITE_DIR#subscribe/index.php",
		"SHOW_HIDDEN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => ""
	)
);?> </div>
 <?if(!empty($arSpecialId)):?> 
<div class="special-offers2">    
  <h2>Лидеры продаж</h2>
   <?$APPLICATION->IncludeComponent(
	"arcline:catalog.section.list",
	"leader-catalog",
	Array(
		"IBLOCK_TYPE" => "Catalog",
		"IBLOCK_ID" => "8",
		"ANALOG_ID" => $arLeaderId,
		"SECTION_ID" => $arLeaderId,
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"SECTION_URL" => "/catalog/#CODE#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "Y"
	),
$component
);?> </div>
 <?endif;?> 
<div class="main-page-description" align="justify"> 
  <h2 class="main-page-title" align="center"> 
    <div style="text-align: left;"> 
      <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7">Время - единственная не обесцениваемая валюта в мире. </font></span></div>
     <font size="3" color="#5e5ca7"> 
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7">Время не купить - его, в общем-то, не производят. </font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7">Время &ndash; это то, чего всегда не хватает. </font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7">Как часто мы мечтаем о том, чтобы сутки были 25 часов, потому что у нас тогда было бы больше времени. Больше времени на семью, друзей, отдых. </font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7"> 
              <br />
             </font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7">Время не купишь и не украдешь. </font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7">Его можно только СЭКОНОМИТЬ! </font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7"> 
              <br />
             </font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7">Наша компания создана для того, чтобы вы экономили свое ВРЕМЯ.</font></span></div>
       
        <div style="text-align: justify;"><span style="font-size: medium;"><font color="#5e5ca7"> 
              <br />
             </font></span></div>
       
        <div style="text-align: right;"><font size="3" color="#5e5ca7">Теплолайв.  </font></div>
       
        <div style="text-align: right;"><font size="3" color="#5e5ca7">Оператор регионального склада </font></div>
       
        <div style="text-align: right;"><font size="3" color="#5e5ca7">компании DAB в СФО.</font> </div>
       </font> 
      <br />
     </div>
   </h2>
 </div>
 <meta name="yandex-verification" content="60d83514694861a3"></meta> <meta name="Description" content="циркуляционные насосы теплорегулирование трубные системы запорная арматура"></meta><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>