<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?require_once($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/func.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery-1.8.2.js"></script>
<title><?$APPLICATION->ShowTitle()?></title>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" />
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery.slider.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/mousewheel.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/checkbox/jquery.checkbox.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/check.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery.history.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery.opacityrollover.js"></script>
<?$APPLICATION->AddHeadScript("/bitrix/js/main/ajax.js");?>
<?$APPLICATION->ShowHead()?>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/main.js"></script>
<!--<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/cufon-yui.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/Myriad_Pro_400.font.js"></script>-->
<script type="text/javascript">
function rightArrow(id) {
        var height = $('#'+id).css('height');
        if ( height == "16px" ) {
            $('#'+id).append("<div class='arrow1'></div>");
        }
        if ( height == "30px" ) {
            $('#'+id).append("<div class='arrow2'></div>");
        }
        if ( height == "45px" ) {
            $('#'+id).append("<div class='arrow3'></div>");
        }
    }
$(document).ready(function(){
    $('.quan').keypress(function(e) {
        if (!(e.which==8 || e.which==44 ||e.which==45 ||e.which==46 ||(e.which>47 && e.which<58))) return false;
    });
    $('.index').keypress(function(e) {
        if (!(e.which==8 || e.which==44 ||e.which==45 ||e.which==46 ||(e.which>47 && e.which<58))) return false;
    });
    $('.numeric').keypress(function(e) {
        if (!(e.which==8 || e.which==44 ||e.which==45 ||e.which==46 ||(e.which>47 && e.which<58))) return false;
    });
    $(".section-element .section-element-main:first").addClass("active");
    $(".section-element .section-element-bottom:not(:first)").hide();
     $(".section-element .section-element-main .offers-title").click(function(){
         $(this).parent().next(".section-element-bottom").slideToggle("fast");
     });
 $(".clear-check").click(function() {
     $(".chck").removeAttr("checked");
     $(".chetkaCheck").css("background-position","0 0");
  });
$(".plus").click(function(){
    c = $(this).parent().find(".quan").val();
    if (c == "")
        {c = 1}
    c = parseInt(c);
    c++;
    if (c < 1){ c = 2; }
    $(this).parent().find(".quan").val(c);
});

$(".minus").click(function(){
    c = $(this).parent().find(".quan").val();
    if (c == "")
        {c = 1}
    c = parseInt(c);
    if (c == "")
        {c = 1}
    c--;
    if (c < 1){ c = 1; }
    $(this).parent().find(".quan").val(c);
}); 
$(".section-element-picture").fancybox();
 $(function() {
        $("a[rel]").overlay({
            mask: 'white',
            onBeforeLoad: function() {
                var wrap = this.getOverlay().find(".contentWrap");
                wrap.load(this.getTrigger().attr("href")+"?AJAX=2");
            },
            onLoad: function() {
				    jQuery(".chetkaCheck").mousedown(
						/* при клике на чекбоксе меняем его вид и значение */
						function() {
							changeCheck(jQuery(this));
						});
					jQuery(".chetkaCheck").each(
					/* при загрузке страницы нужно проверить какое значение имеет чекбокс и в соответствии с ним выставить вид */
					function() {
						changeCheckStart(jQuery(this));
						});
                  var options = { 
                    target: '.contentWrap',  
                    beforeSubmit: captFunc,
                    //success: showResponse,
                    url: '/callmeplz/index.php?AJAX=2&knopka=1'  
                    };
                       
               $('#callForm').submit(function() {
                    $(this).ajaxSubmit(options);
                    return false;
               });
                function captFunc(formData) {
                    a = $('#inpName').val();
                    b = $('#inpTime').val();
                    c = $('#inpPhone').val();
                    if (a.length == 0) {
                        if(!($("#err1").length)) {
                            $('#inpName').before("<p class='error' id='err1'>Введите ФИО</p>");
                        }    
                        $('#inpName').css("border","1px solid #f47a86");    
                    }
                    else {
                        $("#err1").remove();
                        $('#inpName').css("border","1px solid #888");    
                    }
                    if (b.length == 0) {
                        if(!($("#err2").length)) {
                            $('#inpTime').before("<p class='error' id='err2'>Введите время</p>");
                        }
                        $('#inpTime').css("border","1px solid #f47a86");    
                    }
                    else {
                        $("#err2").remove();    
                        $('#inpTime').css("border","1px solid #888");
                    }
                    if (c.length == 0) {
                        if(!($("#err3").length)) {
                            $('#inpPhone').before("<p class='error' id='err3'>Введите телефон</p>");
                        }
                        $('#inpPhone').css("border","1px solid #f47a86");    
                    }
                    else {
                        $("#err3").remove();    
                        $('#inpPhone').css("border","1px solid #888");    
                    }
                    if ((c.length == 0) || (a.length == 0) ||(b.length == 0)) {
                        return false;
                    }
                }
            }
        });
    });
        
});

</script>


<?if($_REQUEST["print"]=="Y"){?>	
<script type="text/javascript">
$(document).ready(function() {
window.print();
});	
</script>
<?}?>


 </head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id='overlay'>
    <div class="contentWrap"></div>
</div>
<div id='overlay2'>
    <div class="contentWrap"></div>
</div>
<div id='wrapper'>  <div id='zzzzzz'></div>
<?
  $leftComponentCount = 0;
  global $APPLICATION;
  $dir = $APPLICATION->GetCurDir();
?>
<? if ($dir == '/'):?>
	
	<?if($_REQUEST["print"]!="Y"){?>
  <div class='big-scroll'>
  <?$APPLICATION->IncludeComponent("bitrix:news.list", "scroll", array(
	"IBLOCK_TYPE" => "Scroll",
	"IBLOCK_ID" => "1",
	"NEWS_COUNT" => "5",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "ID",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "LINK",
		1 => "DESCRIPTION",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
  
  </div> 
  
	<?}?>
  
<?endif;?>
<div class='all-page'>
  <div id='header'>
    <div class='include-logo'>
    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
		"AREA_FILE_SHOW" => "file",
    "PATH" => "/include/logo.php", 
		"EDIT_TEMPLATE" => "standard.php" 
  	)
    );?>
    </div>
    <div class='top-contact' <?if($_REQUEST["print"]=="Y"){?>style="margin-top:68px; left: 763px"<?}?>>
    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
		"AREA_FILE_SHOW" => "file",
    "PATH" => "/include/phone.php", 
		"EDIT_TEMPLATE" => "standard.php" 
  	)
    );?>
    </div>
	
	<?if($_REQUEST["print"]!="Y"){?>
	
    <div class='search'>
    <?
    $APPLICATION->IncludeComponent("bitrix:search.form", "search-top", array(
	   "PAGE" => "#SITE_DIR#search/index.php",
	   "USE_SUGGEST" => "N"
	   ),
	   false
     );
     ?>
    </div>
	
	<?}?>
	
	
	
  </div>
  <?if($_REQUEST["print"]!="Y"){?>
  <div class='top-menu'>
    <div class='arrow-left'></div>
    <div class='menu-body'>
      <?
      $APPLICATION->IncludeComponent("bitrix:menu", "main-menu", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
      ?>
    </div>
    <div class='arrow-right'></div>
    <div class='clear'></div>
  </div>
  <?}?>
  
  <?if($_REQUEST["print"]=="Y"){?>
	<style>
		#main{
			margin-top:0 !important;
		}
	</style>
  <?}?>
  <div id='main' <? if ($dir == '/'):?>style='margin-top:440px;'<?$leftComponentCount++;?><?endif;?>>
    <div id='content-wrap'>
<?
    $st1='/news/';
    $st2='/info/';
    $st3 = '/catalog/';
?>
    <? if ($dir !== '/'):?>
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "scrumbs", array(
	"START_FROM" => "0",
	"PATH" => "",
	"SITE_ID" => "s1"
	),
	false
);?>
    <?endif;?>
    <?if (!(stristr($dir, $st1)) && !(stristr($dir, $st2)) && !(stristr($dir, $st3)) && !($dir == '/') && !(stristr($dir, "callmeplz"))):?>
        <h1><?$APPLICATION->ShowTitle(false)?></h1>
    <?endif;?>
    <?if ((stristr($dir, $st1)) or (stristr($dir, $st2))/* or (stristr($dir, $st3))*/){
	     $leftComponentCount++;   
    }
?>
      <?if ($leftComponentCount > 0):?>
        <div id='left-column'>
        <?//if ($dir == '/catalog/'):?>
        <?if (($dir == '/') or (stristr($dir, $st2))):?>
         
          <?if ($dir == '/'):?>
            <?
            $APPLICATION->IncludeComponent("bitrix:menu", "catalog-menu", Array(
	"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
	"MENU_CACHE_TYPE" => "N",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
	"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);
            ?>
          <?endif;?>
         
          <?if ((stristr($dir, $st2))):?>
            <?
            $APPLICATION->IncludeComponent("bitrix:menu", "infonews", array(
	"ROOT_MENU_TYPE" => "left",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
          ?><div class='subscrc'><a href='/subscribe/'><img src='/images/subscribe.png' /></a></div>
          <?endif;?>
           <?$APPLICATION->IncludeComponent("bitrix:news.list", "main-page-news", array(
	"IBLOCK_TYPE" => "News",
	"IBLOCK_ID" => "2",
	"NEWS_COUNT" => "4",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "ID",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "DESCRIPTION",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
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
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "Y",
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
  <?endif;?>
   <?if (($dir == '/') or (stristr($dir, $st1))):?>
      <?if ((stristr($dir, $st1))):?>
       <?
       $APPLICATION->IncludeComponent("bitrix:menu", "infonews2", array(
	"ROOT_MENU_TYPE" => "left",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
       ?><div class='subscrc'><a href='/subscribe/'><img src='/images/subscribe.png' /></a></div>
     <?endif;?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "main-page-info", array(
	"IBLOCK_TYPE" => "infowarehouse",
	"IBLOCK_ID" => "3",
	"NEWS_COUNT" => "4",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "ID",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "DESCRIPTION",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
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
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "Y",
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
<?endif;?>
       </div>
      <?endif;?>
      <div id='content' <?if ($leftComponentCount > 0):?> style='padding-left:30px;width: 690px; float: left;'<?endif;?>>
 