<?php /* Smarty version 2.6.26, created on 2011-05-07 22:29:02
         compiled from showMsg.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'showMsg.htm', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div data-role="page" id="menu">
	<div data-role="header">
		<h1><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
	</div><!-- /header -->
	<div data-role="content">
		<div align="center" style="font-size:20px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['msg'])) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</div>
		<div align="center">
		<button type="submit" data-theme="c" onclick="location='./'" rel=external data-inline="true"><?php echo ((is_array($_tmp='home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
		</div>
	</div>
</div>