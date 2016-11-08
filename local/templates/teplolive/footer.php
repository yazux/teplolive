<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
    </div>
     <div class='clear'></div>
  </div>
   </div>

<?
//if ($dir !== '/') {
    $title = $APPLICATION->GetProperty("title");
    $title .= " TeploLive";
    $APPLICATION->SetPageProperty("title", $title);
//}
if (isset($_REQUEST["basketClear"]) && CModule::IncludeModule("sale")) {
   CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
}
?>
<?if($_REQUEST["print"]!="Y"){?>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "small-basket", array(
	"PATH_TO_BASKET" => "/cart/",
	"PATH_TO_ORDER" => "/personal/order/"
	),
	false
);?>
<?}?>
</div>


<div id='top-line'>
<?if($_REQUEST["print"]!="Y"){?>
    <div class='fol-line-wrap'>
         <div class="auth-links">
            <?
             global $USER;
             if ($USER->IsAuthorized()):?>
                 <a href="/personal/" style='float: left;'><?=$USER->GetFullName();?> / </a>
                 <form class='logoutform' action="">
                     <input type="hidden" name="logout" value="yes">
                    <input type="submit" name="logout_butt" value="Выйти" class="inputbuttonflat">
                </form>
                <div class="clear"></div>
             <?else:?>
                 <a href='/auth/register.php'>Регистрация</a> / <a href='/auth/login.php' rel="#overlay">Войти</a>
             <?endif;?>
         </div>
        <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "follow-basket", array(
	"PATH_TO_BASKET" => "/cart/",
	"PATH_TO_ORDER" => "/personal/order/"
	),
	false
);?>

		
		
        <div class='icons'>
            <a href='/contacts/' class='mail'><img alt='контакты' src='<?=SITE_TEMPLATE_PATH;?>/images/mail.png'></a>
            <a href='/map/' class='map'><img alt='карта сайта' src="<?=SITE_TEMPLATE_PATH;?>/images/map.png"></a>
        </div>
		<div class="pronter">
		<a href='<?=$APPLICATION->GetCurPage()?>?print=Y' class='printer'><img style="margin-top:2px" src='<?=SITE_TEMPLATE_PATH;?>/images/printer.png'></a>
		</div>
        <div class="clear"></div>
    </div>
<?}?>	
</div>
</div>
<div id="footerwrap" <?if($_REQUEST["print"]=="Y"){?>style="height: 60px;"<?}?>>
    <div class="all-page">
        <div class='rdscroller'>
		<?if($_REQUEST["print"]!="Y"){?>
            <?$APPLICATION->IncludeComponent("bitrix:news.list", "bottom-scroll", array(
	"IBLOCK_TYPE" => "Scroll",
	"IBLOCK_ID" => "5",
	"NEWS_COUNT" => "20",
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
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
		<?}?>
        </div>
    </div>
    <div id='footer'>
        <div class='all-page'>
            <div class='copyright'>
                <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/copyright.php",
                    "EDIT_TEMPLATE" => "standard.php"
                )
            );
                ?>
            </div>
            <div class='botphone'>
                <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/botphone.php",
                    "EDIT_TEMPLATE" => "standard.php"
                )
            );
                ?>
            </div>
            <div class='developer'>
                Разработка и поддержка сайта <a href='http://arcline.ru/'>arcline.ru</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>