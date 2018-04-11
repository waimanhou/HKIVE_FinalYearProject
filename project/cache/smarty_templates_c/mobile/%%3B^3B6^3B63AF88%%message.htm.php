<?php /* Smarty version 2.6.26, created on 2011-05-14 17:53:21
         compiled from message.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'message.htm', 54, false),)), $this); ?>

<?php ob_start(); ?>
<script>
	var curr_folderid;
	var curr_next_page;
	function start() {
		var xmlurl="message.php?q=getfoldertree";

		$(document).ready(function(){
			var xml = $.ajax({
			  url: xmlurl,
					async: false
			 }).responseXML;
			 var result="";
				
			 $(xml).find("row").each(function(i){
				var $item = $(this);
				var i=0;
				var folderid=$item.find("cell").eq(0).text();
				var foldername=$item.find("cell").eq(1).text();
				var level=$item.find("cell").eq(2).text();
				var parent=$item.find("cell").eq(3).text();
				var isLeaf=$item.find("cell").eq(4).text();
				
				result+='<li><a href="#msgList" onclick="javascript:getMessageList('+folderid+')";>'+foldername+'</a></li>';
			 });

			 $("#msgFolder ul").html(result);
			 $("#msgFolder ul").listview('refresh');
		});
	}
	function getMessageList(folderid,next_page) {
		var p_page=1;
		if(next_page!=null){
			p_page=next_page;
		}
		curr_folderid=folderid;
		curr_next_page=p_page;
		var xmlurl="message.php?q=getFolderMessage&folderid="+folderid+"&page="+p_page+"&rows=10";

		$(document).ready(function(){
			var xml = $.ajax({
			  url: xmlurl,
					async: false
			 }).responseXML;
			 var result="";
			 var page=$(xml).find("page").eq(0).text();
			 var totalpage=$(xml).find("total").eq(0).text();
			 
			$("#btnPreNext").html("");
			var btnstr="";
			btnstr+='<div align=center>';
			if(page>1){
				btnstr+='<a href="#" onclick="'+"getMessageList("+folderid+","+(parseInt(page)-1)+');" style="font-size:20px;" return false;>&#60;&#60;<?php echo ((is_array($_tmp='Prev')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a> - ';
			}
			if(page<totalpage){
				btnstr+='<a href="#" onclick="'+"getMessageList("+folderid+","+(parseInt(page)+1)+');" style="font-size:20px;" return false;><?php echo ((is_array($_tmp='Next')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
&#62;&#62;</a>';
			}
			btnstr+='</div>';
			$("#btnPreNext").append(btnstr);
			
			 $(xml).find("row").each(function(i){
				var $item = $(this);
				var i=0;
				var msgid=$item.find("cell").eq(0).text();
				var msgtitle=$item.find("cell").eq(1).text();
				var sender=$item.find("cell").eq(2).text();
				var time=$item.find("cell").eq(3).text();
				
				if(msgtitle.length>30){
					msgtitle=msgtitle.substring(0,30)+"...";
					if(msgtitle.substring(0,3)=="<b>"){
						msgtitle+="</b>";
					}
				}
				if(msgtitle.substring(0,3)=="<b>"){
					result+='<li data-theme="e"><a href="#msgContent" onclick="javascript:getMessageContent('+msgid+')";>'+msgtitle+'</a><p class="ui-li-count">'+time+'</p></li>';
				}else{
					result+='<li><a href="#msgContent" onclick="javascript:getMessageContent('+msgid+')";>'+msgtitle+'</a><p class="ui-li-count">'+time+'</p></li>';
				}
			 });

			 $("#msgList ul").html(result);
			 $("#msgList ul").listview('refresh');

		});
	}
	function getMessageContent(msgid){
		
		var xmlurl="message.php?q=getMessage&messageId="+msgid;

		$(document).ready(function(){
			var xml = $.ajax({
			  url: xmlurl,
					async: false
			 }).responseXML;
			 var result="";
			 var senderid=$(xml).find("sender").attr("id"); 
			 var senderloginName=$(xml).find("sender").attr("loginName"); 
			 var sender=$(xml).find("sender").eq(0).text();
			 var time=$(xml).find("time").eq(0).text();
			 var subject=$(xml).find("subject").eq(0).text();
			 var body=$(xml).find("body").eq(0).text();
			 
			 
			 $("#msgContent #sender").html(sender);
			 $("#msgContent #time").html(time);
			 $("#msgContent #subject").html(subject);
			 $("#msgContent #body").html(body);
			 
			 $("#receiver").val(senderloginName);
			 $("#title").val("RE: "+subject);
			 $('#btn_unread').attr('onclick', 'javascript:setUnread('+msgid+');');
			 $('#btn_delete').attr('onclick', 'javascript:deleteMsg('+msgid+');');
		});
		refreshMsgList();
	}
	function refreshMsgList(){
		getMessageList(curr_folderid,curr_next_page);
	}
	function setUnread(msgid){
		  $.get("message.php",{'q':'makeAsUnreadMessage','messageId':msgid});
		  refreshMsgList();
		  history.back(1);
	}
	function showReply(){
		window.location="#reply_page";
	}
	function replyMsg(){
		$.post("message.php?q=addMessage", $("#reply_form").serialize());
		alert("<?php echo ((is_array($_tmp='Mail Sent')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
");
		window.location.replace("index.php");
	}
	function deleteMsg(msgid){
		var answer = confirm ("<?php echo ((is_array($_tmp='Are you sure you want to delete those message?')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
");
		if (answer){
		  $.get("message.php",{'q':'delMessage','messageId':msgid});
		  refreshMsgList();
		  history.back(1);
		}
	}
	start();
</script>


<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div data-role="page">
	<div data-role="header" class="h">
		<h1><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="index.php" data-icon="forward" class="ui-btn-left" rel=external><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
	</div><!-- /header -->
	<div data-role="content" align="center">
		<div id="msgFolder">
			<ul data-role="listview" data-inset="true" data-theme="d"></ul>
		</div>
	</div>
	<div data-role="footer" style="position:absolute;bottom:0;" class="h">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
<div data-role="page" id="msgList">
	<div data-role="content" align="center">
		<ul data-role="listview" data-theme="d" data-filter="true" data-inset="true"></ul>
		<span id="btnPreNext"></span>
	</div>
</div>
<div data-role="page" id="msgContent">
	<div data-role="content">
		<table>
			<tr><td width="50px"><b><?php echo ((is_array($_tmp='Subject')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: </b></td><td><span id="subject"></span></td></tr>
			<tr><td><b><?php echo ((is_array($_tmp='Sender')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: </b></td><td><span id="sender"></span></td></tr>
			<tr><td><b><?php echo ((is_array($_tmp='Time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: </b></td><td><span id="time"></span></td></tr>
		</table>
		<hr>
		<div id="body"></div>
		<br>
		<div align="center" id="control_btns">
			<button id="btn_reply" type="submit" data-theme="c" onclick="showReply();" rel=external data-inline="true"><?php echo ((is_array($_tmp='Reply')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
			<button id="btn_move" type="submit" data-theme="c" onclick="" rel=external data-inline="true"><?php echo ((is_array($_tmp='Move')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
			<button id="btn_delete" type="submit" data-theme="c" onclick="" rel=external data-inline="true"><?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
			<button id="btn_unread" type="submit" data-theme="c" onclick="" rel=external data-inline="true"><?php echo ((is_array($_tmp='Mark as unread')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
		</div>
	</div>
</div>
<div data-role="page" id="reply_page">
	<div data-role="content">
		<form action="#" method="post" id="reply_form">
			<b><?php echo ((is_array($_tmp='Receiver')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: </b><input type="text" name="receiver" id="receiver" value="" /><br>
			<b><?php echo ((is_array($_tmp='Subject')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: </b><br>
			<input type="text" name="title" id="title" value=""/>
			<hr>
			<textarea id="bodyeditor" name="bodyeditor" data-theme="d"></textarea>
			<div align="center">
				<input type="submit" data-rel="dialog" value="<?php echo ((is_array($_tmp='Send')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="replyMsg();" data-inline="true" data-theme="b">
			</div>
		</form>
	</div>
</div>
</body>
</html>