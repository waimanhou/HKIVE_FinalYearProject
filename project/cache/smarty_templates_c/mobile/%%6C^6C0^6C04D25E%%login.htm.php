<?php /* Smarty version 2.6.26, created on 2011-05-07 22:28:44
         compiled from login.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'login.htm', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div data-role="page">
<!-- start header -->
	<div style="background: #A9A9A9;" data-role="header" data-nobackbtn="true">
		<h1><?php echo ((is_array($_tmp='login')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
	</div>
	<!-- end header -->
	<div data-role="content" data-theme="c" data-inset="true" align="center">
		<form action="login.php?action=login" method="post">
			<input type=hidden name=ticket value="<?php echo $this->_tpl_vars['ticket']; ?>
">
			<table width="100%">
				<tr>
					<td><h2><?php echo ((is_array($_tmp='loginName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</h2></td>
					<td width="80%"><input type="text" name="loginName" id="loginName" style="width:80%;"/></td>
				</tr>
				<tr>
					<td><h2><?php echo ((is_array($_tmp='password')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</h2></td>
					<td width="80%"><input type="password" name="password" id="password" style="width:80%;"></td>
				</tr>
			</table>
			<input type="submit" data-rel="dialog" value="<?php echo ((is_array($_tmp='login')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" data-inline="true" data-theme="b">
		</form>
	</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>