<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type="text/css" href="../css/fixbar.css">
<link rel=stylesheet type="text/css" href="common.css" />
<?php
session_start();
require("../db/dblogin.php");
require("../db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
?>
<title>3D列印討論區</title>
</head>

<body>
<div class="navbar navbar-fixed-top" >
      <div class="navbar-inner" >
	  <span class="brand" href="#" ><img src="../img/3D-ink_transparent.png"></img></span>
        <div class="navcontainer" >
			<?php include('login_success.php')?>
			<ul class="nav searchbox">
				<li><input type="text"  placeholder="搜尋"></li>
			</ul>  
		</div>
    </div>
</div>
<div style=margin-top:300px>
<form method="post" autocomplete="off" id="postform"
action="forum.php?mod=post&amp;action=newthread&amp;fid=555&amp;extra=&amp;topicsubmit=yes"
onsubmit="return validate(this)">

<div id="ct" class="ct2_a ct2_a_r wp cl">
<div class="mn">
<input type="hidden" name="formhash" id="formhash" value="5c0da4c4" />
<input type="hidden" name="posttime" id="posttime" value="1398606331" />
<input type="hidden" name="wysiwyg" id="e_mode" value="0" />
<div class="bm bw0 cl" id="editorbox">
<ul class="tb cl mbw">
<li class="a"><a href="javascript:;" onclick="switchpost('forum.php?mod=post&action=newthread')">發表文章</a></li></ul>

<div id="draftlist_menu" style="display:none">
<ul class="xl xl1">
<li class="xi2"><a href="forum.php?mod=guide&amp;view=my&amp;type=thread&amp;filter=save&amp;fid=0" target="_blank">查看所有草稿</a></li>
</ul>
</div>


            
<div id="postbox">
<script type="text/javascript" src="http://jk.mx500.com/source/plugin/tc_sc_translate/js/cove.js"></script>
<div class="pbt cl">
<div class="ftid">
<select name="typeid" id="typeid" width="80">
<option value="0">選擇主題分類</option><option value="723">社會</option>
<option value="724">地方</option>
<option value="726">財經</option>
<option value="1085">上班族</option>
<option value="719">生活</option>
<option value="716">政治</option>
<option value="717">運動</option>
<option value="718">教育</option>
<option value="722">科技</option>
<option value="725">健康</option>
<option value="721">知識</option>
<option value="720">惡搞</option>
<option value="715">娛樂</option>
<option value="1567">國際</option>
<option value="1568">氣象</option>
<option value="1569">綜合</option>
<option value="714">其他</option>
<option value="713">公告</option>
</select>
</div>
<div class="z">
<span><input type="text" name="subject" id="subject" class="px" value="" onblur="if($('tags')){relatekw('-1','-1');doane();}" onkeyup="strLenCalc(this, 'checklen', 120);" style="width: 25em" tabindex="1" /></span>
<span id="subjectchk">還可輸入 <strong id="checklen">120</strong> 個字符</span>
</div>
</div>

<div id="attachnotice_attach" class="tbms mbm xl" style="display:none">
您有 <span id="unusednum_attach"></span> 個未使用的附件 &nbsp; <a href="javascript:;" class="xi2" onclick="attachoption('attach', 2);" />查看</a><span class="pipe">|</span><a href="javascript:;" class="xi2" onclick="attachoption('attach', 1)">使用</a><span class="pipe">|</span><a href="javascript:;" class="xi2" onclick="attachoption('attach', 0)">刪除</a>
<div id="unusedlist_attach" style="display:none"></div>
</div>
<div id="attachnotice_img" class="tbms mbm xl" style="display:none">
您有 <span id="unusednum_img"></span> 個未使用的圖片 &nbsp; <a href="javascript:;" class="xi2" onclick="attachoption('img', 2);" />查看</a><span class="pipe">|</span><a href="javascript:;" class="xi2" onclick="attachoption('img', 1)">使用</a><span class="pipe">|</span><a href="javascript:;" class="xi2" onclick="attachoption('img', 0)">刪除</a>
<div id="unusedlist_img" style="display:none"></div>
</div>

<div id="e_body_loading"><img src="static/image/common/loading.gif" width="16" height="16" class="vm" /> 請稍後 ...</div>
<div class="edt" id="e_body" style="display: none">
<div id="e_controls" class="bar">
<div class="y">
<div class="b2r nbl nbr" id="e_adv_5">
<p>
<a id="e_undo" title="撤銷">Undo</a>
</p>
<p>
<a id="e_redo" title="重做">Redo</a>
</p>
</div>
<div class="z">
<span class="mbn"><a id="e_fullswitcher"></a><a id="e_simple"></a></span>
<label id="e_switcher" class="bar_swch ptn"><input id="e_switchercheck" type="checkbox" class="pc" name="checkbox" value="0" checked="checked" onclick="switchEditor(this.checked?0:1)" />純文本</label>
</div>
</div>
<div id="e_button" class="btn cl">
<div class="b2r nbr nbl" id="e_adv_s2">
<a id="e_fontname" class="dp" title="設定字體" menupos="43!"><span id="e_font">字體</span></a>
<a id="e_fontsize" class="dp" title="設定文字大小" menupos="43!" menuwidth="25"><span id="e_size">大小</span></a>
<span id="e_adv_1">
<a id="e_inserthorizontalrule" title="分隔線">Hr</a>
<br />
</span>
<a id="e_bold" title="文字加粗">B</a>
<a id="e_italic" title="文字斜體">I</a>
<a id="e_underline" title="文字加下劃線">U</a>
<a id="e_forecolor" title="設定文字顏色">Color</a>
<a id="e_backcolor" title="設定文字背景色">BgColor</a>
<a id="e_url" title="增加連接">Url</a>
<span id="e_adv_8">
<a id="e_unlink" title="移除連接">Unlink</a>
</span>
</div>
<div class="b2r nbl" id="e_adv_2">
<p id="e_adv_3">
<a id="e_tbl" title="增加表格">Table</a>
</p>
<p>
<a id="e_removeformat" title="清除文本格式">Removeformat</a>
</p>
</div>
<div class="b2r">
<p>
<a id="e_autotypeset" title="自動排版">Autotypeset</a>
<a id="e_justifyleft" title="居左">Left</a>
<a id="e_justifycenter" title="居中">Center</a>
<a id="e_justifyright" title="居右">Right</a>
</p>
<p id="e_adv_4">
<a id="e_floatleft" title="左浮動">FloatLeft</a>
<a id="e_floatright" title="右浮動">FloatRight</a>
<a id="e_insertorderedlist" title="排序的列表">Orderedlist</a>
<a id="e_insertunorderedlist" title="未排序列表">Unorderedlist</a>
</p>
</div>
<div class="b1r" id="e_adv_s1">
<a id="e_sml" title="增加表情">表情</a>
<div id="e_imagen" style="display:none">!</div>
<a id="e_image" title="增加圖片" menupos="00" menuwidth="600">圖片</a>
<div id="e_attachn" style="display:none">!</div>
<a id="e_attach" title="增加附件" menupos="00" menuwidth="600">附件</a>
</div>
<div class="b2r" id="e_adv_6">
<p>
<a id="e_code" title="增加代碼文字">代碼</a>
<a id="e_free" title="增加免費訊息">Free</a><a id="e_pasteword" title="從 Word 粘貼內容">Word 粘貼</a>
</p>
<p>
<a id="e_quote" title="增加引用文字">引用</a>
<a id="e_hide" title="增加隱藏內容">Hide</a><a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=e_textarea&amp;from=forumeditor" class="cst" onclick="showWindow(this.id, this.href, 'get', 0)"><img src="static/image/magic/doodle.small.gif" alt="doodle" title="塗鴉板" style="margin-top:2px" /></a>
</p>
</div>
<div class="b2r cst nbb" id="e_cst" style="display:none">
<a id="e_cst1_youtube" class="cst" title="插入 youtube 影片"><img src="static/image/common/bb_youtube.gif" title="插入 youtube 影片" alt="youtube" /></a>
<a id="e_cst1_facebook" class="cst" title="插入 facebook 影片"><img src="static/image/common/bb_facebook.gif" title="插入 facebook 影片" alt="facebook" /></a>
<a id="e_cst1_xvideos" class="cst" title="插入 xvideos 影音"><img src="static/image/common/bb_xvideos.gif" title="插入 xvideos 影音" alt="xvideos" /></a>
<a id="e_cst1_youku" class="cst" title="插入 優酷網 視頻"><img src="static/image/common/bb_youku.gif" title="插入 優酷網 視頻" alt="youku" /></a>
<a id="e_cst3_rtmp" class="cst" title="插入 rtmp 影音"><img src="static/image/common/bb_rmtp.png" title="插入 rtmp 影音" alt="rtmp" /></a>
<a id="e_cst1_myvi" class="cst" title="插入myvi影音"><img src="static/image/common/bb_myvi.png" title="插入myvi影音" alt="myvi" /></a>
<a id="e_cst1_goovideo" class="cst" title="插入google影片"><img src="static/image/common/bb_goovideo.png" title="插入google影片" alt="goovideo" /></a>
<a id="e_cst1_qvod" class="cst" title="插入 QVOD 快播影音"><img src="static/image/common/bb_qvod.gif" title="插入 QVOD 快播影音" alt="qvod" /></a>
<a id="e_cst2_ymovie" class="cst" title="插入 Yahoo 電影預告"><img src="static/image/common/bb_ymovie.gif" title="插入 Yahoo 電影預告" alt="ymovie" /></a>
<a id="e_cst1_wma" class="cst" title="插入 Windows media 影音"><img src="static/image/common/bb_wma.gif" title="插入 Windows media 影音" alt="wma" /></a>
<a id="e_cst1_fc2" class="cst" title="插入 fc2 影音"><img src="static/image/common/bb_fc2.gif" title="插入 fc2 影音" alt="fc2" /></a>
<a id="e_cst1_yammp3" class="cst" title="插入yam mp3 播放器"><img src="static/image/common/bb_yammp3.gif" title="插入yam mp3 播放器" alt="yammp3" /></a>
<a id="e_cst1_xuite" class="cst" title="插入 xuite 影音"><img src="static/image/common/bb_xuite.gif" title="插入 xuite 影音" alt="xuite" /></a>
<a id="e_cst3_nextmedia" class="cst" title="插入 動新聞影音"><img src="static/image/common/nextmedia.gif" title="插入 動新聞影音" alt="nextmedia" /></a>
<a id="e_cst1_userporn" class="cst" title="插入 userporn 影音"><img src="static/image/common/userporn.gif" title="插入 userporn 影音" alt="userporn" /></a>
</div>
</div>
</div>

<div id="rstnotice" class="ntc_l bbs" style="display:none">
<a href="javascript:;" title="清除內容" class="d y" onclick="userdataoption(0)">close</a>您有上次未提交成功的數據 <a class="xi2" href="javascript:;" onclick="userdataoption(1)"><strong>恢複數據</strong></a>
</div>

<div class="area">
<textarea name="message" id="e_textarea" class="pt" rows="15" tabindex="2"></textarea>
</div><link rel="stylesheet" type="text/css" href="data/cache/style_4_editor.css?mCS" />
<script src="static/js/editor.js?mCS" type="text/javascript"></script>
<script src="static/js/bbcode.js?mCS" type="text/javascript"></script>
<script type="text/javascript">
var editorid = 'e';
var textobj = $(editorid + '_textarea');
var wysiwyg = (BROWSER.ie || BROWSER.firefox || (BROWSER.opera >= 9)) && parseInt('0') == 1 ? 1 : 0;
var allowswitcheditor = parseInt('1');
var allowhtml = parseInt('1');
var allowsmilies = parseInt('1');
var allowbbcode = parseInt('1');
var allowimgcode = parseInt('1');
var simplodemode = parseInt('0');
var fontoptions = new Array("細明體", "新細明體", "黑體", "微軟雅黑", "Arial", "Verdana", "Mingliu", "Helvetica", "Trebuchet MS", "Tahoma", "Impact", "Times New Roman", "仿宋,仿宋_GB2312", "楷體,標楷體");
var smcols = 8;
var custombbcodes = new Array();
custombbcodes["youtube"] = {'prompt' : '請貼上youtube影片網址上 v=  與 &search 中間部分文字'};
custombbcodes["facebook"] = {'prompt' : '插入 Wvideo.php?v=photo.php?v=代碼'};
custombbcodes["xvideos"] = {'prompt' : '插入 id_video= 後面的代碼'};
custombbcodes["youku"] = {'prompt' : 'id_後面到.html之間的代碼'};
custombbcodes["rtmp"] = {'prompt' : 'streamer	file	image'};
custombbcodes["myvi"] = {'prompt' : '插入代碼'};
custombbcodes["goovideo"] = {'prompt' : '插入代碼'};
custombbcodes["qvod"] = {'prompt' : '請插入 QVOD影片網址'};
custombbcodes["ymovie"] = {'prompt' : '請插入mediaId	請填寫預告片名稱'};
custombbcodes["wma"] = {'prompt' : '請輸入 Windows media 影音的 URL:'};
custombbcodes["fc2"] = {'prompt' : '輸入影片網址上類似20110210w3nH0ynD格式的代碼'};
custombbcodes["yammp3"] = {'prompt' : '加入網址http://mymedia.yam.com/m/後代碼'};
custombbcodes["xuite"] = {'prompt' : ''};
custombbcodes["nextmedia"] = {'prompt' : '請插入原始碼中IssueID/後面到/的日期	請插入原始碼中Photo/後面到.的代碼	請插入原始碼Video/後面到/的代碼'};
custombbcodes["userporn"] = {'prompt' : '插入 網址video/後面的代碼'};
</script>

<div id="e_bbar" class="bbar">
<em id="e_tip"></em>
<span id="e_svdsecond"></span>
<a href="javascript:;" onclick="discuzcode('svd');return false;" id="e_svd">保存數據</a> |
<a href="javascript:;" onclick="discuzcode('rst');return false;" id="e_rst">恢複數據</a> &nbsp;&nbsp;
<a href="javascript:;" onclick="discuzcode('chck');return false;" id="e_chck">字數檢查</a> |
<a href="javascript:;" onclick="discuzcode('tpr');return false;" id="e_tpr">清除內容</a> &nbsp;&nbsp;
<span id="e_resize"><a href="javascript:;" onclick="editorsize('+');return false;">加大編輯框</a> | <a href="javascript:;" onclick="editorsize('-');return false;">縮小編輯框</a><img src="static/image/editor/resize.gif" onmousedown="editorresize(event)" /></span>
</div></div>
<div id="post_extra" class="ptm cl">
<div id="post_extra_tb" class="cl" onselectstart="return false">
</div>

<div id="post_extra_c">
</div>
</div><div class="mtm">
<input name="sechash" type="hidden" value="S11114z0" />

驗證碼 <span id="seccodeS11114z0" onclick="showMenu(this.id);"><input name="seccodeverify" id="seccodeverify_S11114z0" type="text" autocomplete="off" style="ime-mode:disabled;width:100px" class="txt px vm" onblur="checksec('code', 'S11114z0')" tabindex="1" />
<a href="javascript:;" onclick="updateseccode('S11114z0');doane(event);" class="xi2">換一個</a>
<span id="checkseccodeverify_S11114z0"><img src="static/image/common/none.gif" width="16" height="16" class="vm" /></span>
</span><div id="seccodeS11114z0_menu" class="p_pop p_opt" style="display:none"><span id="seccode_S11114z0"></span>
<script type="text/javascript" reload="1">updateseccode('S11114z0');</script>
</div>

</div>

<div class="mtm mbm pnpost">
<a href="home.php?mod=spacecp&amp;ac=credit&amp;op=rule&amp;fid=555" class="y" target="_blank">本版積分規則</a>
<button type="submit" id="postsubmit" class="pn pnc" value="true" name="topicsubmit">
<span>發表文章</span>
</button>
<input type="hidden" id="postsave" name="save" value="" />
<button type="button" id="postsubmit" class="pn" value="true" onclick="$('postsave').value = 1;$('postsubmit').click();"><em>保存草稿</em></button>
</div>

</div>
</div>
</div><div id="psd" class="appl">
<h3 class="mbm pbm bbs">附加選項</h3>
<div class="bn">
<p class="mbn"><input type="checkbox" name="htmlon" id="htmlon" class="pc" value="0"  disabled="disabled" /><label for="htmlon">HTML 代碼</label></p>
<p class="mbn"><input type="checkbox" id="allowimgcode" class="pc" disabled="disabled" checked="checked" /><label for="allowimgcode">[img] 代碼</label></p>
<p class="mbn"><input type="checkbox" id="allowimgurl" class="pc" checked="checked" /><label for="allowimgurl">解析圖片連接</label></p>
<p class="mbn"><input type="checkbox" name="parseurloff" id="parseurloff" class="pc" value="1"  /><label for="parseurloff">禁用連接識別</label></p>
<p class="mbn"><input type="checkbox" name="smileyoff" id="smileyoff" class="pc" value="1"  /><label for="smileyoff">禁用表情</label></p>
<p class="mbn"><input type="checkbox" name="bbcodeoff" id="bbcodeoff" class="pc" value="1"  /><label for="bbcodeoff">禁用編輯器代碼</label></p>

<hr class="bk" />

<p class="mbn"><input type="checkbox" name="usesig" id="usesig" class="pc" value="1" disabled /><label for="usesig">使用個人簽名</label></p>
<p class="mbn"><input type="checkbox" name="hiddenreplies" id="hiddenreplies" class="pc" value="1"><label for="hiddenreplies">回覆僅作者可見</label></p>
<p class="mbn"><input type="checkbox" name="ordertype" id="ordertype" class="pc" value="1"  /><label for="ordertype">回覆倒序排列</label></p>
<p class="mbn"><input type="checkbox" name="allownoticeauthor" id="allownoticeauthor" class="pc" value="1" checked="checked" /><label for="allownoticeauthor">接收回覆通知</label></p>
<p class="mbn"><input type="checkbox" name="addfeed" id="addfeed" class="pc" value="1" checked="checked"><label for="addfeed">發送動態</label></p>
</div>
</div></div>
</form>


</div>
</body>
</html>