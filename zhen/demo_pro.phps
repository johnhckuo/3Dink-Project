<?
// �պA�]�w�P�s�� DataBase
include ($_SERVER["DOCUMENT_ROOT"] . "/configure.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/connect_db.php");

// �ҥ� Session ���
session_start();

// �M�w�������ƧǤ覡
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
//======== �����e���ǨӪ� $Page�A�H�M�w������ܪ����
$now_Page=$Page;
if ( $now_Page == "" ) $now_Page=0;

// �C����� 5 ��
$show_num     = 5;
// �������_�l����
$record_begin = $now_Page * $show_num;
// ���������ܵ���
$record_show  = $show_num;

//======== �p�����`����
$sql  = "select count(*) from demo_friend ";
$rs_f = mysql_db_query($cfgDatabaseName, $sql, $link);
list($nTotal)=mysql_fetch_row($rs_f);

// �����������ܵ��Ƥ��i�j���`����
if (( $record_begin + $record_show ) > $nTotal )
  $record_show = $nTotal - $record_begin;

if ( $nTotal > 0 ) {
  //======== Ū����ơ]�H���������^
  $sql  = "select nickname, realname, phone, m_phone, address from demo_friend ";
  // �ƧǤ覡
  switch ($_SESSION['this_sort']) {
    case "1":      // �̼ʺ�
      $sql .= "order by nickname ";
      break;
    case "2":      // �̩m�W
      $sql .= "order by realname ";
      break;
    case "3":      // �̹q��
      $sql .= "order by phone ";
      break;
    case "4":      // �̦�ʹq��
      $sql .= "order by m_phone ";
      break;
    case "5":      // �̦a�}
      $sql .= "order by address ";
      break;
    default:       // �̼ʺ�
      $sql .= "order by nickname ";
  }
  $sql .= "limit $record_begin , $record_show ";
  $rs_f = mysql_db_query($cfgDatabaseName, $sql, $link);
  $nT_f = mysql_num_rows($rs_f);

  if ( $nT_f > 0 ) {?>
    <b>�ڪ��q�T��</b><br><br>
    <table border=1 cellpadding=2 cellspacing=0 width=80%
               bordercolorlight="#666666" bordercolordark="#FFFFFF">
      <tr bgcolor="#555555">
        <th class="myFont_12W">
          �ʺ�</th>
        <th class="myFont_12W">
          �m�W</th>
        <th class="myFont_12W">
          �q��</th>
        <th class="myFont_12W">
          ��ʹq��</th>
        <th class="myFont_12W">
          �a�}</th></tr>
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
      <?// �Ƨǿ�� ?>
      <tr>
        <td align=right nowrap>
          <font class="myFont_9G">
          �����ثe��
          <?
          switch ($_SESSION['this_sort']) {
            case 1:
              echo "�i�ʺ١j";
              break;
            case 2:
              echo "�i�m�W�j";
              break;
            case 3:
              echo "�i�q�ܡj";
              break;
            case 4:
              echo "�i��ʹq�ܡj";
              break;
            case 5:
              echo "�i�a�}�j";
              break;
            default:
              echo "�i�ʺ١j";
          }
          echo "�Ƨǡ@�@�@�@��̡@";
          if ( $_SESSION['this_sort'] != 1 ) {?>
            <a href="X_3_demo_pro.php?new_sort=1" class="myFont_9G">�ʺ�</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 2 ) {?>
            <a href="X_3_demo_pro.php?new_sort=2" class="myFont_9G">�m�W</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 3 ) {?>
            <a href="X_3_demo_pro.php?new_sort=3" class="myFont_9G">�q��</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 4 ) {?>
            <a href="X_3_demo_pro.php?new_sort=4" class="myFont_9G">��ʹq��</a> /
          <?
          }
          if ( $_SESSION['this_sort'] != 5 ) {?>
            <a href="X_3_demo_pro.php?new_sort=5" class="myFont_9G">�a�}</a>
          <?
          }?>
          �@���s�Ƨ�</font>
        </td>
      </tr>
      <?// �����B�z ?>
      <tr>
        <td align=right nowrap>
          <form method="get" name="PageChange" action="X_3_demo_pro.php">
          <?
          if ( $now_Page > 0 ) {?>
            <a href="JavaScript:showPage(<?echo $now_Page-1;?>);">
              <img src="media/arrow_left.gif" border=0 alt="�W�@��"></a>
          <?
          }

          // �p���`����
          $PageTotal = ceil($nTotal/$show_num);?>

          <font class="myFont_9G">
          ��&nbsp;<?echo $now_Page+1;?>&nbsp;���A
          �@&nbsp;<?echo $PageTotal;?>&nbsp;��&nbsp;
          (&nbsp;<?echo $nTotal;?>&nbsp;�����&nbsp;)</font>
          <?
          if ( $PageTotal > ($now_Page + 1) ) {?>
            <a href="JavaScript:showPage(<?echo $now_Page+1;?>);">
              <img src="media/arrow_right.gif" border=0 alt="�U�@��"></a>
          <?
          }?>�@
            <input type="hidden" name="Page" value="">
            <select name="PageSelect"
                onChange="JavaScript:showPage(document.PageChange.PageSelect.selectedIndex - 1);">
              <option value="">�ֳt����
            <?
            for ( $b=1; $b<=$PageTotal; $b++ )
              echo "<option value=" . $b . ">�� " . $b . " ��";?>
            </select>
          </form>
        </td>
      </tr>
    </table>
  <?
  }
}
else {?>
  <b>�䤣������ơI</b>
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