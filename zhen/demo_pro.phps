<?
// 組態設定與連結 DataBase
include ($_SERVER["DOCUMENT_ROOT"] . "/configure.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/connect_db.php");

// 啟用 Session 函數
session_start();

// 決定本頁的排序方式
if ( !isset($_SESSION['this_sort']) ) $_SESSION['this_sort'] = 1;

if ( isset($_GET['new_sort']) ) $_SESSION['this_sort'] = $_GET['new_sort'];
?>

<html>
<head>
<title><?echo $cfgWebTitle_PHP;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<br><br>
<?
//======== 接收前頁傳來的 $Page，以決定本頁顯示的資料
$now_Page=$Page;
if ( $now_Page == "" ) $now_Page=0;

// 每頁顯示 5 筆
$show_num     = 5;
// 本頁之起始指標
$record_begin = $now_Page * $show_num;
// 本頁實際顯示筆數
$record_show  = $show_num;

//======== 計算資料總筆數
$sql  = "select count(*) from demo_friend ";
$rs_f = mysql_db_query($cfgDatabaseName, $sql, $link);
list($nTotal)=mysql_fetch_row($rs_f);

// 本頁之實際顯示筆數不可大於總筆數
if (( $record_begin + $record_show ) > $nTotal )
  $record_show = $nTotal - $record_begin;

if ( $nTotal > 0 ) {
  //======== 讀取資料（以本頁為限）
  $sql  = "select nickname, realname, phone, m_phone, address from demo_friend ";
  // 排序方式
  switch ($_SESSION['this_sort']) {
    case "1":      // 依暱稱
      $sql .= "order by nickname ";
      break;
    case "2":      // 依姓名
      $sql .= "order by realname ";
      break;
    case "3":      // 依電話
      $sql .= "order by phone ";
      break;
    case "4":      // 依行動電話
      $sql .= "order by m_phone ";
      break;
    case "5":      // 依地址
      $sql .= "order by address ";
      break;
    default:       // 依暱稱
      $sql .= "order by nickname ";
  }
  $sql .= "limit $record_begin , $record_show ";
  $rs_f = mysql_db_query($cfgDatabaseName, $sql, $link);
  $nT_f = mysql_num_rows($rs_f);

  if ( $nT_f > 0 ) {?>
    <b>我的通訊錄</b><br><br>
    <table border=1 cellpadding=2 cellspacing=0 width=80%
               bordercolorlight="#666666" bordercolordark="#FFFFFF">
      <tr bgcolor="#555555">
        <th class="myFont_12W">
          暱稱</th>
        <th class="myFont_12W">
          姓名</th>
        <th class="myFont_12W">
          電話</th>
        <th class="myFont_12W">
          行動電話</th>
        <th class="myFont_12W">
          地址</th></tr>
    <?
    for ( $i=1; $i<=$nT_f; $i++ ) {
      list($nickname, $realname, $phone, $m_phone, $address) = mysql_fetch_row($rs_f);?>
      <tr bgcolor="<?if ( $i % 2 ) echo "#888888";
                     else          echo "#AAAAAA";?>">
        <td nowrap class="myFont_12W">
          <?echo $nickname;?> </td>
        <th nowrap class="myFont_12W">
          <?echo $realname;?> </th>
        <th nowrap class="myFont_12W">
          <?echo $phone;?> </th>
        <th nowrap class="myFont_12W">
          <?echo $m_phone;?> </th>
        <td nowrap class="myFont_12W">
          <?echo $address;?> </td></tr>
    <?
    }?>
    </table>
    <br>

    <table border=0 cellpadding=2 cellspacing=0 width=80%>
      <?// 排序選擇 ?>
      <tr>
        <td align=right nowrap>
          <font class="myFont_9G">
          本頁目前依
          <?
          switch ($_SESSION['this_sort']) {
            case 1:
              echo "【暱稱】";
              break;
            case 2:
              echo "【姓名】";
              break;
            case 3:
              echo "【電話】";
              break;
            case 4:
              echo "【行動電話】";
              break;
            case 5:
              echo "【地址】";
              break;
            default:
              echo "【暱稱】";
          }
          echo "排序　　　　改依　";
          if ( $_SESSION['this_sort'] != 1 ) {?>
            <a href="X_3_demo_pro.php?new_sort=1" class="myFont_9G">暱稱</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 2 ) {?>
            <a href="X_3_demo_pro.php?new_sort=2" class="myFont_9G">姓名</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 3 ) {?>
            <a href="X_3_demo_pro.php?new_sort=3" class="myFont_9G">電話</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 4 ) {?>
            <a href="X_3_demo_pro.php?new_sort=4" class="myFont_9G">行動電話</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 5 ) {?>
            <a href="X_3_demo_pro.php?new_sort=5" class="myFont_9G">地址</a>
          <?
          }?>
          　重新排序</font>
        </td>
      </tr>
      <?// 分頁處理 ?>
      <tr>
        <td align=right nowrap>
          <form method="get" name="PageChange" action="X_3_demo_pro.php">
          <?
          if ( $now_Page > 0 ) {?>
            <a href="JavaScript:showPage(<?echo $now_Page-1;?>);">
              <img src="media/arrow_left.gif" border=0 alt="上一頁"></a>
          <?
          }

          // 計算總頁數
          $PageTotal = ceil($nTotal/$show_num);?>

          <font class="myFont_9G">
          第&nbsp;<?echo $now_Page+1;?>&nbsp;頁，
          共&nbsp;<?echo $PageTotal;?>&nbsp;頁&nbsp;
          (&nbsp;<?echo $nTotal;?>&nbsp;筆資料&nbsp;)</font>
          <?
          if ( $PageTotal > ($now_Page + 1) ) {?>
            <a href="JavaScript:showPage(<?echo $now_Page+1;?>);">
              <img src="media/arrow_right.gif" border=0 alt="下一頁"></a>
          <?
          }?>　
            <input type="hidden" name="Page" value="">
            <select name="PageSelect"
                onChange="JavaScript:showPage(document.PageChange.PageSelect.selectedIndex - 1);">
              <option value="">快速換頁
            <?
            for ( $b=1; $b<=$PageTotal; $b++ )
              echo "<option value=" . $b . ">第 " . $b . " 頁";?>
            </select>
          </form>
        </td>
      </tr>
    </table>
  <?
  }
}
else {?>
  <b>找不到任何資料！</b>
<?
}?>
</center>
<script language="JavaScript">
function showPage(Page) {
  document.PageChange.Page.value = Page;
  document.PageChange.submit();
}
</script>
</body>
</html>