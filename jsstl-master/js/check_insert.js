function checkLength( o, min, max ) {
                        //if ( o.val().length > max || o.val().length < min ) {
        if ( o.length > max || o.length < min ) {
                return false;
        } else {
                return true;
        }
}
                
function check_insert(){
        var receiverName=document.getElementById("receiverName").value;
        var receiverAddress=document.getElementById("receiverAddress").value;
        var receiverTelephone=document.getElementById("receiverTelephone").value;
        if (receiverName == "" ) {
                alert("請輸入收件人姓名");
                return false;
        }
        else if(receiverTelephone==""){
                alert("請輸入收件人電話");
                return false;
        }
        else if(!(checkLength(receiverAddress, 10, 50 ))){
                alert("請輸入正確地址");
                return false;
        }
        else if(!(checkLength(receiverName, 1, 10 ))){
                 alert("收件人應少於10個字");
                return false;
        }
        else{
                return true;
        }

}
