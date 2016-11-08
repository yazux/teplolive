<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>
<?if (intval($_REQUEST["AJAX"]) == 2) {$APPLICATION->RestartBuffer();
    ?><script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/check.js"></script>
<?}?>

<link href="/bitrix/templates/teplolive/components/bitrix/system.auth.authorize/.default/style.css" type="text/css" rel="stylesheet">
<link href="/bitrix/js/socialservices/css/ss.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/bitrix/js/socialservices/ss.js"></script>
<div class="autorization">
<?if($arResult["AUTH_SERVICES"]):?>
	<?if (intval($_REQUEST['AJAX']) == 2):?>
        <div class="login-title">Вход</div>
    <?endif;?>
<?endif?>
	<form name="form_auth" method="post" target="_top" action="/auth/login.php?login=yes">
	
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>


				<input class="bx-auth-input" placeholder="логин" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
				<input class="bx-auth-input" placeholder="пароль" type="password" name="USER_PASSWORD" maxlength="255" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
				<?if($arResult["CAPTCHA_CODE"]):?>
				<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:
                <input class="bx-auth-input" type="text" name="captcha_word" maxlength="50" value="" size="15" />
			<?endif;?>
<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
			<div class='dontforget'><span class="chetkaCheck"><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /></span>
            <span class="remember-me">запомнить меня</span></div>
<?endif?>
			<input class='vhod' type="submit" name="Login" value="войти" />

<?if($arResult["AUTH_SERVICES"]):?>
        <?
        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", ".default",
            array(
                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                "CURRENT_SERVICE"=>$arResult["CURRENT_SERVICE"],
                "AUTH_URL"=>$arResult["AUTH_URL"],
                "POST"=>$arResult["POST"],
            ),
            $component,
            array("HIDE_ICONS"=>"Y")
        );
        ?>
 <?endif?>
<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
		<noindex>
			<p class="fgt">
				<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow">Вспомнить пароль</a>
			</p>
		</noindex>
<?endif?>

<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
		<noindex>
			<p class="fgt">
				<a href="/auth/register.php" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
			</p>
		</noindex>
<?endif?>

	</form>
</div>

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>
<?if (intval($_REQUEST["AJAX"]) == 2):?>
    <?die();?>
<?endif;?>


