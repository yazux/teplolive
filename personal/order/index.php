<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Оформление заказа");
$APPLICATION->SetTitle("Офрмление заказа");
if(isset($_REQUEST['ORDER_ID'])){
    CModule::IncludeModule('sale');
    $resOrder = CSaleOrderPropsValue::GetList(array("ORDER"=>"ASC"),array("ORDER_PROPS_ID"=>35,"ORDER_ID" => $_REQUEST['ORDER_ID']));
    $x = $resOrder->GetNext();
    CSaleOrder::CommentsOrder($_REQUEST['ORDER_ID'],$x['VALUE']);
}
?>
<?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "oformlenie", array(
	"PAY_FROM_ACCOUNT" => "Y",
	"COUNT_DELIVERY_TAX" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
	"ALLOW_AUTO_REGISTER" => "N",
	"SEND_NEW_USER_NOTIFY" => "Y",
	"DELIVERY_NO_AJAX" => "Y",
	"PROP_1" => array(
	),
	"PROP_2" => array(
	),
	"PATH_TO_BASKET" => "/cart/",
	"PATH_TO_PERSONAL" => "/personal/",
	"PATH_TO_PAYMENT" => "/personal/payment.php",
	"PATH_TO_AUTH" => "/auth/",
	"SET_TITLE" => "Y"
	),
	false
);?>
<?if($USER->IsAdmin()):?>
    <script>
        function IsRequestSuccessful (httpRequest) {
            // IE: sometimes 1223 instead of 204
            var success = (httpRequest.status == 0 ||
                (httpRequest.status >= 200 && httpRequest.status < 300) ||
                httpRequest.status == 304 || httpRequest.status == 1223);

            return success;
        }

        function OnStateChange (xhr) {
            var flag = false;
            if (xhr.readyState==4){
                if (IsRequestSuccessful(xhr)) {    // defined in ajax.js
                    flag = xhr.responseText;
                }else{
                    flag = false;
                }
            }
            return flag;
        }

        var form = document.getElementById('file-form');
        var fileSelect = document.getElementById('file-select');
        var uploadButton = document.getElementById('upload-button');

        form.onsubmit = function(event) {
            event.preventDefault();

            // Update button text.
            uploadButton.innerHTML = 'Загрузка...';

            // Get the selected files from the input.
            var files = fileSelect.files;
            // Create a new FormData object.
            var formData = new FormData();
            // Loop through each of the selected files.
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                // Check the file type.
//                if (!file.type.match(['image.*','pdf'])) {
//                    continue;
//                }

                // Add the file to the request.
                formData.append('clientDetails[]', file, file.name);
            }
//             var filename = file.name;
            // Files
//            formData.append(name, file, filename);

            // Blobs
//            formData.append(name, blob, filename);

            // Strings
//            formData.append(name, value);

            // Set up the request.
            var xhr = new XMLHttpRequest();

            // Open the connection.
            xhr.open('POST', '/ajax/uploadRec.php', true);

            // Set up a handler for when the request finishes.
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // File(s) uploaded.
                    uploadButton.innerHTML = 'Загрузить';
                } else {
                    console.log('An error occurred!');
                }
            };

            // Send the Data.
            xhr.send(formData);
            var elID;
            var cycle = setInterval(function(){
                elID = OnStateChange(xhr);

                if(elID){
                    clearInterval(cycle);
                    console.log(elID);
                    document.getElementById('ORDER_PROP_35').setAttribute("value",elID);
                    document.getElementById('ORDER_PROP_6').setAttribute("value","file");
                    document.getElementById('ORDER_PROP_7').setAttribute("value","file");
                    document.getElementById('ORDER_PROP_8').setAttribute("value","file");
                    document.getElementById('ORDER_PROP_20').setAttribute("value","file");
                }
            },100);
        }
    </script>
<?endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>