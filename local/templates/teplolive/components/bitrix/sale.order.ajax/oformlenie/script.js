$(document).ready(function(){
    /*if ($('#ORDER_PROP_24').val().length>0) {
                        	var region=" регион "+$('#ORDER_PROP_24').val(); 
                   }
                   if ($('#ORDER_PROP_17').val().length>0) {
                        	var district=" район "+$('#ORDER_PROP_16').val(); 
                   }
                   if ($('#ORDER_PROP_17').val().length>0) {
                        	var sreet=" ул. "+$('#ORDER_PROP_17').val(); 
                   }
                   if ($('#ORDER_PROP_18').val().length>0) {
                        	var dom=" дом "+$('#ORDER_PROP_18').val(); 
                   }           
                   if ($('#ORDER_PROP_19').val().length>0) {
                        	var office=" офис "+$('#ORDER_PROP_19').val(); 
                   }  
                   alert (region+district+sreet+dom+office+"1234"); */           
    $('.order-checkbox').checkbox();
    $("#thesame").change(function() {
        sameWords()
    });
 
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
 
 function changeCheck2(el)
/*
функция смены вида и значения чекбокса
el - span контейнер дял обычного чекбокса
input - чекбокс
*/
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
/*
если установлен атрибут checked, меняем вид чекбокса
*/
{
    var el = el,
    input = el.find("input").eq(0);
    if(input.attr("checked")) {
    el.css("background-position","-15px 0");
    }
return true;
}

 function sameWords() {
    var n = $(".index").val(); $(".index").val(n);
    var n = $(".region").val(); $(".region").val(n);
    var n = $(".district").val(); $(".district").val(n);
    var n = $(".street").val(); $(".street").val(n);
    var n = $(".build").val(); $(".build").val(n);
    var n = $(".office").val(); $(".office").val(n);

	var n=$('#ORDER_FORM_ID_NEW select').eq(3).val();
	$('#ORDER_PROP_27').val(n);
	
	
    submitForm();

}
