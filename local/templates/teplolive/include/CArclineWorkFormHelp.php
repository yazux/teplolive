<?class CArclineWorkForm_main_form{

private $massage_about_success="Большое спасибо, Ваш заказ принят.";
private $massage_about_NOTsuccess="При передаче данных произошла ошибка. Попробуйте еще раз.";

public $razdel;



public $arError = array();
private $success=true;


function __construct($id_razdel){
  $this->razdel=$id_razdel;
}


//метод для вывода формы 
    function fn_PrintForm(){
?>
<form id='helpForm' action="/help/index.php?knopka=1" method="post">
	<input name="form_type" type="hidden" value="<?=$this->razdel?>">
	<input name="name" type="text" placeholder='Ф.И.О.' id='inpName' class="inp2">
	<input name="email" type="text" placeholder='email' id='email' class="inp2">
    <input name="phone" type="text" placeholder='телефон' id='inpPhone' class="inp2">
    <textarea name='question' id='inpquest' class='inp3' placeholder='ваш вопрос'></textarea>
 	<input name="knopka" type="submit" value='&nbsp' class="input_submit3">
</form>
<?
}

//метод для проверки полей обязательного ввода
function fn_CheckFields(){
    //echo "<pre>"; print_r($_REQUEST); echo "</pre>";
	if(strlen($_REQUEST["knopka"])>0){
		if (strlen($_REQUEST["name"])==0){
			$this->arError[]='Вы не ввели ваще имя';
		}
		if (strlen($_REQUEST["email"])==0){
			$this->arError[]='Вы не ввели время';
		}
		if (strlen($_REQUEST["phone"])==0){
			$this->arError[]='Вы не ввели ваш телефон';
		}
        if (strlen($_REQUEST["question"])==0){
			$this->arError[]='Вы не ввели ваш вопрос';
		} 
	}
	else{
		$this->arError=array();
	}
	if(count($this->arError)>0){
		return false;
	}
	else{
		return true;
	}
}
//метод для передачи данных

function fn_AddForm(){
global $APPLICATION;

$success=true;
if ((intval($_REQUEST["form_type"])==$this->razdel) && ($error == null)):
	$el = new CIBlockElement;
	$preview_text='<p>Ф.И.О.: '.htmlspecialchars($_REQUEST["name"]).'</p>';
	$preview_text.='<p>Email: '.htmlspecialchars($_REQUEST["email"]).'</p>';
	$preview_text.='<p>Телефон: '.htmlspecialchars($_REQUEST["phone"]).'</p>';
    $preview_text.='<p>Вопрос: '.htmlspecialchars($_REQUEST["question"]).'</p>';
	$preview_text.='<p>IP клиента: '.$_SERVER["REMOTE_ADDR"].'</p>';

	//вывожу в превью выбранные значения свойства

	//вывожу в превью выбранные разделы инфоблока

	$arProp = array();
	$arProp["ip"]=$_SERVER["REMOTE_ADDR"];
	$arLoadProductArray = Array(

	"IBLOCK_SECTION_ID" => intval($_REQUEST["form_type"]),          // элемент лежит в корне раздела
	"IBLOCK_ID"      => 10,
	"PROPERTY_VALUES"=> $arProp,
	"NAME"           => "Заполнение формы",
	"ACTIVE"         => "Y",            // активен
	"PREVIEW_TEXT"   => $preview_text,
	);

	if(!($PRODUCT_ID = $el->Add($arLoadProductArray))){
		$success=false;
	}
 
 if ($PRODUCT_ID>0)
 {
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
	$arFilter = Array("IBLOCK_ID"=>10, "SECTION_ID" => intval($_REQUEST["form_type"]), "ID"=>$PRODUCT_ID);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	$arItem = $res->GetNext();  
 
	$arFields = array(
		"ID"          => $PRODUCT_ID,
		"FIELD_1"    => htmlspecialchars($_REQUEST["name"]),
		"FIELD_2"    => htmlspecialchars($_REQUEST["email"]),
		"FIELD_3"    => htmlspecialchars($_REQUEST["phone"]),
        "FIELD_4"    => htmlspecialchars($_REQUEST["question"]),
		"FIELD_5"    => $_SERVER["REMOTE_ADDR"]         
    );    
   
	CEvent::Send("FEEDBACK_FORM","s1", $arFields);  
 }

 if($success==true){ LocalRedirect($APPLICATION->GetCurPage()."?ResultAdd=success"); }
 
endif;


//LocalRedirect($_SERVER['HTTP_REFERER']."?&name=".$_REQUEST["name"]."&e-mail=".$_REQUEST["e-mail"].$captcha."&vopros=".$_REQUEST["vopros"]);
    return $success;
}


function fn_Success(){
	?><p class="not_error"><?=$this->massage_about_success?></p><?
}

function fn_NotSuccess(){
	?><p class="error2"><?=$this->massage_about_NOTsuccess?></p><?
}

function ShowErrors(){
	if(count($this->arError)>0){
        ?><div class='errors'><?
		foreach($this->arError as $key){
			?><p class="error"><?=$key?></p><?
		}
        ?></div><?
	}
}
function fn_ShowForm(){
	if($this->fn_CheckFields()){
		$success=$this->fn_AddForm();
	}
	else{
		$this->ShowErrors();
	}
	if ($_REQUEST["ResultAdd"]=="success"){
		$this->fn_Success();	
	}
	else{
		if ($success==false){
			$this->fn_NotSuccess();
		}
		$this->fn_PrintForm();
	}
}
}    
?> 
