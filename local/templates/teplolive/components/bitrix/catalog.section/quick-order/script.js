$(document).ready(function(){
	$('.quan').change(function(){
		fn_recalcOrder();
	});
	
	$('.quick-order-main-button').click(function(){
		fn_sendOrder();
	});
	
	
	$('.minus-quick-order').click(function(){
		var oQuan=$(this).parent().find('.quan');
		var oProduct = $(this).parent().find('[name="id"]');
		
		var vQuantity = parseInt(oQuan.val());
		
		if (vQuantity<=1) {
			oQuan.val(0);
		} else {
			oQuan.val(vQuantity-1);
		}
		fn_sendOrderItem(oProduct.val(),oQuan.val());
		fn_recalcOrder();
	});
	
	$('.plus-quick-order').click(function(){
		var oQuan=$(this).parent().find('.quan');
		var oProduct = $(this).parent().find('[name="id"]');
		var vQuantity = parseInt(oQuan.val());
		
		oQuan.val(vQuantity+1);
		
		fn_sendOrderItem(oProduct.val(),oQuan.val());	
		fn_recalcOrder();
	});	
	
	fn_recalcOrder();
});


function fn_recalcOrder(){
	var vAllQuantity=0;
	var vAllSum=0;
		
	$('.quan').each(function(){
		var vQuantity=parseInt($(this).val());
		if (vQuantity>0){
			vAllQuantity+=vQuantity;
			vAllSum+=vQuantity*parseInt($(this).attr('rel'));
			
		}			
	});
	$('.kolvo-jq').html(vAllQuantity);
	$('.summ-jq').html(vAllSum);
	
	console.log('count');

}

function fn_sendOrderItem(vProduct,vQuantity){
	$.ajax({
	    method: "POST",
	    url: "/ajax/go-to-basket.php",
	    data: { product: vProduct, quantity : vQuantity, quick_order : 'Y' },
	});			
	
}

function fn_setQuantity(vProduct,vQuantity){
	$('.product_'+vProduct).val(vQuantity);
}

function fn_sendOrder(){
	
/*
	$('.quan').each(function(){
		var vQuantity=parseInt($(this).val());
		if (vQuantity>0){		
			var oProduct=$(this).parent().find('input[name="id"]');
			
			if( oProduct.val()>0){		
				$.ajax({
					method: "POST",
					url: "/ajax/go-to-basket.php",
					data: { product: oProduct.val(), quantity : vQuantity },
				});			
			}
		}
	});
*/
	setTimeout(function(){
		window.location.href='/personal/order/index.php';
	}, 1000);
}