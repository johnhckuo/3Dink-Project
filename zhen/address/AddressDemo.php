<!--  
/*
  此筆記在紀錄，由於縣市合併後舊式的下拉選單選擇縣市資料都要要更新，要一筆一筆對照然後更改有些累人(懶)
  就去找了"縣市合併新版 3 碼郵遞區號 MySQL 匯入檔"，參考網址http://www.powerweb.tw/modules/news/V99
  把資料庫整理了下，在自己利用jQuery寫了底下縣市下拉選單功能帶入郵遞區號，也順便把整理後的MySql資料庫匯出
  縣市資料庫下載
  @author m3fu0 2011-06-30 首度完成
  SQL
  https://docs.google.com/uc?id=0B-DuZTOLHg1TMzdmYmI5YTktZTgzNC00NTZlLWI5NmQtZmI1NDg3YzMxMThk&export=download&hl=zh_TW
  全部檔案
  https://docs.google.com/uc?id=0B-DuZTOLHg1TZmI2ZWVjOWEtNTEyYy00NzI5LWJiYTUtZDU1Y2ZhODllZDEw&export=download&hl=zh_TW
*/
-->
<?php
include 'Include/open.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //利用jQuery的ajax把縣市編號(CNo)傳到Town_ajax.php把相對應的區域名稱回傳後印到選擇區域(鄉鎮)下拉選單
                $('#myCity').change(function(){
                    var CNo= $('#myCity').val();
                    $.ajax({
                        type: "POST",
                        url: 'Town_ajax.php',
                        cache: false,
                        data:'CNo='+CNo,
                        error: function(){
                            alert('Ajax request 發生錯誤');
                        },
                        success: function(data){
                            $('#myTown').html(data);
                            $('#myZip').val("");//避免重新選擇縣市後郵遞區號還存在，所以在重新選擇縣市後郵遞區號欄位清空
                        }
                    });
                });
                //根據選擇區域(鄉鎮)的編號傳到Zip_ajax.php把區域對應的郵遞區號印到指定的郵遞區號欄位
                $('#myTown').change(function(){
                    var TNo= $('#myTown').val();
                    $.ajax({
                        type: "POST",
                        url: 'Zip_ajax.php',
                        cache: false,
                        data:'TNo='+TNo,
                        error: function(){
                            alert('Ajax request 發生錯誤');
                        },
                        success: function(data){
                            $('#myZip').val(data);
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>    
            <tr> 
                <td width="113" height="28">通訊地址：</td>
                <td height="28" colspan="3">
                    <select name="F_I_CNo" id="myCity">
                        <option value="">選擇縣市</option>
                        <?php
                        $City = "select * from City where State=0";
                        $City_rs = mysql_query($City);
                        while ($City_rows = mysql_fetch_array($City_rs)) {
                            ?>
                            <option value="<?php echo $City_rows["AutoNo"] ?>"><?php echo $City_rows["Name"]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="F_I_TNo" id="myTown">
                        <option value="">選擇鄉鎮</option>
                    </select>
                    郵遞區號：
                    <input id="myZip" type="text" class="field10" Name="F_S_NH_Zip" value="" size="5" readonly="ture"/>
                    地址：
                    <input type="text" class="field10" Name="F_S_NH_Address" value="" style="width:210px;"/>
                </td>
            </tr>
        </table>
    </body>
</html>
