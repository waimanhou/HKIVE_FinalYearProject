<?php /* Smarty version 2.6.26, created on 2011-05-07 22:29:08
         compiled from venueList.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'venueList.htm', 29, false),)), $this); ?>
<?php ob_start(); ?>
<script>
	function start(selected_typeId,selected_distCode,next_page) {
		var limit=10;
		var url="venueList.php?action=q&rows="+limit;

		if(selected_typeId!=null){
			url+='&type='+selected_typeId;
		}
		if(selected_distCode!=null){
			url+='&district='+selected_distCode;
		}
		if(next_page!=null){
			url+='&page='+next_page;
		}
		$.getJSON(
			url,
			function(json){
				var i=0;
				var result="";
				var page=parseInt(json['page']);
				var totalpage=parseInt(json['total']);
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
				$("#list").html("");
				result+='<div data-role="collapsible-set" class="ui-collapsible-set">';
				for(i=0;i<json['rows'].length;i++){
					var venueid=json['rows'][i]['cell'][0];
					var fullname=json['rows'][i]['cell'][1];
					var abbrname=json['rows'][i]['cell'][2];
					var type=json['rows'][i]['cell'][3];
					var tel=json['rows'][i]['cell'][4];
					var region=json['rows'][i]['cell'][5];
					var dist=json['rows'][i]['cell'][6];
					var address=json['rows'][i]['cell'][7];
					var map=json['rows'][i]['cell'][8];
					
					var details='<table width="100%">';
					details+='<tr align="left"><td><b><?php echo ((is_array($_tmp='Venue name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:'+fullname+'</td>';
					details+='<td><b><?php echo ((is_array($_tmp='Venue Abbr')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:'+abbrname+'</td><tr>';

					details+='<tr align="left">'
					details+='<td><b><?php echo ((is_array($_tmp='Type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:'+type+'</td>';
					details+='<td><b><?php echo ((is_array($_tmp='Tel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:'+tel+'</td>';
					details+='</tr>';
					
					if(region=='HK'){
						region='<?php echo ((is_array($_tmp='HKI')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
';
					}else if(region=='NT'){
						region='<?php echo ((is_array($_tmp='NT')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
';
					}else{
						region='<?php echo ((is_array($_tmp='KLN')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
';
					}
					details+='<tr align="left">'
					details+='<td><b><?php echo ((is_array($_tmp='Region')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:'+region+'</td>';
					details+='<td><b><?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:'+dist+'</td>';
					details+='</tr>';
					
					details+='<tr align="left">'
					details+='<td><b><?php echo ((is_array($_tmp='Address')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:'+address+'</td>';
					map=map.replace("[","(");
					map=map.replace("]",")");
					details+='<td><b><?php echo ((is_array($_tmp='Map')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:<a href="'+'http://maps.google.com.hk/maps?q='+map+'">Google Map</a></td>';
					details+='</tr>';
					details+='</table>';
					result+='<div data-role="collapsible" data-state="collapsed" data-collapsed="true"><h3>'+fullname+'['+type+']</h3><p>'+details+'</p></div>';
				}
				result+='</div>';
				$("#list").html(result);
				$("#list").find('div[data-role=collapsible]').collapsible({theme:'c',refresh:true});
			}
		);
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
		<h1><?php echo ((is_array($_tmp='Venue')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="index.php" data-icon="forward" class="ui-btn-left" rel=external><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
	</div><!-- /header -->
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
					<label for="type" class="select"><?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</label>
					<select name="district" id="district" class="distCode-menu" style="font-size:15px;">
						<option value="all"><?php echo ((is_array($_tmp='all district')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
						<?php $_from = $this->_tpl_vars['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['b']):
?>
						<option value="<?php echo $this->_tpl_vars['b']->getDistCode(); ?>
"><?php echo $this->_tpl_vars['b']->getName(); ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
		</table>
		<span id="list"></span>
		<span id="btnPreNext"></span>
    </div>
	<div data-role="footer" style="position:absolute;bottom:0;" class="h">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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