function $(id){
        return document.getElementById(id);
        }
var check_insert=function(){
        if ($("receiverName").value == "" || $("receiverAddress").value == "" || $("receiverZip").value == "" || $("receiverTelephone").value == "") {
        //�������ӷ|�ά������e�˪��F�����ܥ���g���
        alert("You do not fill something, please fill it.");
        return false;
        }
        else{
                alert("OK");
        }

}
