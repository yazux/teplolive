<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo '<pre>';
//print_r($arResult);
//echo '</pre>';
?>
<a name="order_form"></a>
<div id='hideall'>
    <img src='/bitrix/templates/teplolive/components/bitrix/sale.order.ajax/oformlenie/images/325.gif'>
</div>
<div id="order_form_div">
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/checkbox/jquery.checkbox.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/jquery.form.js"></script>
<NOSCRIPT>
 <div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
</NOSCRIPT>
<?
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
{
	if(!empty($arResult["ERROR"]))
	{
		foreach($arResult["ERROR"] as $v)
			echo ShowError($v);
	}
	elseif(!empty($arResult["OK_MESSAGE"]))
	{
		foreach($arResult["OK_MESSAGE"] as $v)
			echo "<p class='sof-ok'>".$v."</p>";
	}

	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
}
else
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			?>
			<script>
			<!--
			//top.location.replace = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			//setInterval("window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';",2000);
			//-->
			</script>
			<?
			die();
		}
		else
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
	}
	else
	{
		$FORM_NAME = 'ORDERFORM_'.RandString(5);
		if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);
			?>
			<script>
			top.location.hash = '#order_form';
			</script>
			<?
		}
		?>
		
		<script>
		<!--
		function submitForm(val)
		{
			if(val != 'Y') 
				document.getElementById('confirmorder').value = 'N';
			
			var orderForm = document.getElementById('ORDER_FORM_ID_NEW');
			
			//jsAjaxUtil.InsertFormDataToNode(orderForm, 'order_form_div', true);
		 //jsAjaxUtil.ShowLocalWaitWindow("qwerty", "order_form_div", true); 
         $('#hideall').css("display", "block");
         jsAjaxUtil.SendForm(orderForm, function(data) { 
                    
                   document.getElementById("order_form_div").innerHTML = data;
                                                 
                   $("#thesame").change(function() {sameWords()});
                   $('.order-checkbox').checkbox();
                  // jsAjaxUtil.CloseLocalWaitWindow("qwerty", "order_form_div");
                  $('#hideall').css("display", "none"); 
      
                   jQuery(".fullCheck").mousedown(
                    /* при клике на чекбоксе меняем его вид и значение */
                    function() {
                        changeCheck2(jQuery(this));
                    });
                    jQuery(".fullCheck").each(
                            /* при загрузке страницы нужно проверить какое значение имеет чекбокс и в соответствии с ним выставить вид */
                        function() {
                            changeCheckStart2(jQuery(this));
                        });
         });     
                   if ($('#ORDER_PROP_15').val().length>0) {
                        	var region="индекс "+$('#ORDER_PROP_15').val(); 
                   }
                   if ($('#ORDER_PROP_24').val().length>0) {
                        	var region=", регион "+$('#ORDER_PROP_24').val(); 
                   }
                   if ($('#ORDER_PROP_17').val().length>0) {
                        	var district=", район "+$('#ORDER_PROP_16').val(); 
                   }
                   if ($('#ORDER_PROP_17').val().length>0) {
                        	var sreet=", ул. "+$('#ORDER_PROP_17').val(); 
                   }
                   if ($('#ORDER_PROP_18').val().length>0) {
                        	var dom=", дом "+$('#ORDER_PROP_18').val(); 
                   }           
                   if ($('#ORDER_PROP_19').val().length>0) {
                        	var office=", офис "+$('#ORDER_PROP_19').val(); 
                   }                  
                   var city =", город "+$(".order-select:eq(1) option:selected").html();
                   var vcx = $('#ORDER_PROP_34').val(region+city+district+sreet+dom+office);  
            orderForm.submit();
			return true;
		}
      
         function changeCheck2(el)
        {
            var el = el,
            input = el.find("input").eq(0);
            if(!input.attr("checked")) {
            el.css("background-position","-15px 0");
            input.attr("checked", true)
            } else {
            el.css("background-position","0 0");
            input.attr("checked", false)
            }
            return true;
       }
        function changeCheckStart2(el)
        {
            var el = el,
            input = el.find("input").eq(0);
            if(input.attr("checked")) {
            el.css("background-position","-15px 0");
             }
            return true;
        }
        
		function SetContact(profileId)
		{
			document.getElementById("profile_change").value = "Y";
			submitForm();
		}
		//-->
		</script>

		<div style="display:none;">
			<div id="order_form_id">
			&nbsp;
				<?
				if(count($arResult["PERSON_TYPE"]) > 1)
				{
					?>
					
					<b><?=GetMessage("SOA_TEMPL_PERSON_TYPE")?></b>
					<table class="sale_order_full_table">
					<tr>
					<td>
					<?
					foreach($arResult["PERSON_TYPE"] as $v)
					{
						?><input type="radio" id="PERSON_TYPE_<?= $v["ID"] ?>" name="PERSON_TYPE" value="<?= $v["ID"] ?>"<?if ($v["CHECKED"]=="Y") echo " checked=\"checked\"";?> onClick="submitForm()"> <label for="PERSON_TYPE_<?= $v["ID"] ?>"><?= $v["NAME"] ?></label><br /><?
					}
					?>
					<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>">
					</td></tr></table>
					<br /><br />
					<?
				}
				else
				{
					if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
					{
						?>
						<input type="hidden" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
						<input type="hidden" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
						<?
					}
					else
					{
						foreach($arResult["PERSON_TYPE"] as $v)
						{
							?>
							<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>">11
							<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>">
							<?
						}
					}
				}

				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
				?>			
				<?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
				?>
				<?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
				?>			
				<?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
				?>
				<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
				<input type="hidden" name="profile_change" id="profile_change" value="N">
				<br /><br />
				<div align="right">
				<input type="button" class='basket-order' name="submitbutton" onClick="submitForm('Y');" value="<?//=GetMessage("SOA_TEMPL_BUTTON")?>">
				</div>
			</div>
		</div>
		<div id="form_new"></div>
		<script>
		<!--
		var newform = document.createElement("FORM");
		newform.method = "POST";
		newform.action = "";
		newform.name = "<?=$FORM_NAME?>";
		newform.id = "ORDER_FORM_ID_NEW";
		var im = document.getElementById('order_form_id');
		document.getElementById("form_new").appendChild(newform);
		newform.appendChild(im);
		//-->
		</script>
		
		<?
	}
}
?>
</div>
