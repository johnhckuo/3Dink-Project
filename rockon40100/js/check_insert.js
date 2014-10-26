function $(id){
        return document.getElementById(id);
        }
var check_insert=function(){
        if ($("receiverName").value == "" || $("receiverAddress").value == "" || $("receiverZip").value == "" || $("receiverTelephone").value == "") {
        //之後應該會用紅中之前弄的東西來顯示未填寫表格
        alert("You do not fill something, please fill it.");
        return false;
        }
        else{
                alert("OK");
        }

}
