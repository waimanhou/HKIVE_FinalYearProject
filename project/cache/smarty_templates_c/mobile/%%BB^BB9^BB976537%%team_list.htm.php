<?php /* Smarty version 2.6.26, created on 2011-05-07 22:30:09
         compiled from team_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'team_list.htm', 31, false),)), $this); ?>
<?php ob_start(); ?>
<script>
	function start(selected_typeId,selected_distCode,next_page) {
		var limit=10;
		var xmlurl="team.php?action=getList&rows="+limit;

		if(selected_typeId!=null){
			xmlurl+='&type='+selected_typeId;
		}
		if(selected_distCode!=null){
			xmlurl+='&district='+selected_distCode;
		}
		if(next_page!=null){
			xmlurl+='&page='+next_page;
		}
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
					btnstr+='<a href="#" onclick="'+"start($('.typeId-menu').val(),$('.distCode-menu').val(),"+(parseInt(page)-1)+');" style="font-size:20px;" return false;>&#60;&#60;<?php echo ((is_array($_tmp='Prev')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a> - ';
				}
				if(page<totalpage){
					btnstr+='<a href="#" onclick="'+"start($('.typeId-menu').val(),$('.distCode-menu').val(),"+(parseInt(page)+1)+');" style="font-size:20px;" return false;><?php echo ((is_array($_tmp='Next')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
&#62;&#62;</a>';
				}
				btnstr+='</div>';
				$("#btnPreNext").append(btnstr);
				
			 $(xml).find("row").each(function(i){
				var $item = $(this);
				var i=0;
				var teamid=$item.find("cell").eq(0).text();
				var teamname=$item.find("cell").eq(1).text();
				var orgname=$item.find("cell").eq(8).text();
				var s_orgname=orgname;
				if(orgname!=""){
					s_orgname='('+orgname+')';
				}
				result+='<li><a href="team.php?action=viewDetail&teamId='+teamid+'" rel=external>'+teamname+s_orgname+'</a></li>';
			 });

			 
			 $("ul").html(result);
			 $("ul").listview('refresh');
		});
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
		<h1><?php echo ((is_array($_tmp='Teams')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="index.php" data-icon="forward" class="ui-btn-left" rel=external><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
		<a href="team.php?action=createteam" data-icon="myapp-custom" class="ui-btn-right" rel=external><?php echo ((is_array($_tmp='Create Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
	</div>
	<div data-role="content" align="center">
		<table width="100%">
			<tr>
				<td>
					<label for="type" class="select"><?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</label>
					<select name="type" id="type" class="typeId-menu" style="font-size:15px;">
						<option value="all"><?php echo ((is_array($_tmp='all type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
						<?php $_from = $this->_tpl_vars['activityType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
						<option value="<?php echo $this->_tpl_vars['a']->getType(); ?>
"><?php echo $this->_tpl_vars['a']->getName(); ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
				<td>
					<label for="type" class="select"><?php echo ((is_array($_tmp='filter')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</label>
					<select name="district" id="district" class="distCode-menu" style="font-size:15px;">
							<option value="all"><?php echo ((is_array($_tmp='all district')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
							<option value="na">N/A</option>
							<?php $_from = $this->_tpl_vars['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['b']):
?>
							<option value="<?php echo $this->_tpl_vars['b']->getDistCode(); ?>
"><?php echo $this->_tpl_vars['b']->getName(); ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
		</table>
		<ul data-role="listview" data-inset="true" data-theme="d" data-divider-theme="e"></ul>
		<span id="btnPreNext"></span>
	</div>
</div>
<script>
	$('.typeId-menu').change(function() {
	  start($('.typeId-menu').val(),$('.distCode-menu').val());
	});
	$('.distCode-menu').change(function() {
	  start($('.typeId-menu').val(),$('.distCode-menu').val());
	});
</script>