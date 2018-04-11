<?php /* Smarty version 2.6.26, created on 2011-05-07 22:29:30
         compiled from news.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'news.htm', 9, false),)), $this); ?>
<?php ob_start(); ?>
	<script>
		$(function(){
			var max=parseInt("<?php echo $this->_tpl_vars['max_page']; ?>
");
			var cpage=parseInt("<?php echo $this->_tpl_vars['current_page']; ?>
");
			var str='<center style="font-size:15px;">';
			
			str+="&nbsp;";
			if(cpage>3)str+='<a href="news.php?page=1" rel=external><?php echo ((is_array($_tmp='First')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a> , ';
			if(cpage>1)str+='<a href="news.php?page='+(cpage-1)+'" rel=external><?php echo ((is_array($_tmp='Prev')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a> ';
			start=cpage-2 < 1 ? 1: cpage-2;
			end=start+4 > max ? max : start+4
			for(n=start;n<=end;n++)
			{
				if(cpage!=1||n!=1)str+=(" , ")
				if(n==cpage){str+=(""+n).bold().big().big();}else{str+='<a href="news.php?page='+n+'" rel=external>'+n+"</a>";}
			}
			if(cpage<max)str+=' , <a href="news.php?page='+(cpage+1)+'" rel=external><?php echo ((is_array($_tmp='Next')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
			if(cpage<max-2)str+=' , <a href="news.php?page='+max+'" rel=external><?php echo ((is_array($_tmp='Last')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
			str+="</center>";
			$('span[name="news_page"]').each(function(){$(this).html(str)});
		});
	</script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div data-role="page" id="menu">
	<div data-role="header" class="h">
		<h1><?php echo ((is_array($_tmp='NEWS')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="index.php" data-icon="forward" class="ui-btn-left" rel=external><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
	</div><!-- /header -->
	<div data-role="content">
		<div data-role="collapsible-set" class="ui-collapsible-set">
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
				<div data-role="collapsible" data-state="collapsed" data-collapsed="true">
				  <h6 style="font-size:13px;"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getTitle(); ?>
<span class="ui-li-aside" style="font-size:10px;">(<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getTime(); ?>
)</span></h6>
				  <p style="font-size:13px;"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getBody(); ?>
</p>
				</div>
			<?php endfor; endif; ?>
		</div>
		<span name="news_page"></span><br>
	</div>
	<div data-role="footer" style="position:absolute;bottom:0;" class="h">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>