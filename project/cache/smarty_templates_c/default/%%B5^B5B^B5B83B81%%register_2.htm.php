<?php /* Smarty version 2.6.26, created on 2011-05-07 19:33:03
         compiled from register_2.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'register_2.htm', 2, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1><?php echo ((is_array($_tmp='register')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
<form action="register.php?action=submitReg" method="post"><input type=hidden name=ticket value="<?php echo $_SESSION['reg_email_form_ticket']; ?>
">
<input type=hidden name=eaId value="<?php echo $this->_tpl_vars['eaId']; ?>
">
<input type=hidden name=email value="<?php echo $this->_tpl_vars['email']; ?>
">
<input type=hidden name=code value="<?php echo $this->_tpl_vars['code']; ?>
">
<table>
	<tr><td><i>* - <?php echo ((is_array($_tmp='required_field_desc')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</i></td><td>&nbsp;</td></tr>
	<tr><td><?php echo ((is_array($_tmp='Email address')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['email']; ?>
</td></tr>
	<tr><td><?php echo ((is_array($_tmp='loginName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><input name=loginName></td></tr>
	<tr><td><?php echo ((is_array($_tmp='HKID')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
*</td><td><input name=HKID></td></tr>
	<tr><td><?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
*</td><td><input name=chiName></td></tr>
	<tr><td><?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
*</td><td><input name=engName></td></tr>
	<tr><td><?php echo ((is_array($_tmp='NickName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
*</td><td><input name=nickName></td></tr>
	<tr><td><?php echo ((is_array($_tmp='password')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
*</td><td><input type=password name="password"></td></tr>
	<tr><td><?php echo ((is_array($_tmp='password confirm')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
*</td><td><input type=password name="password2"></td></tr>
	<tr><td><?php echo ((is_array($_tmp='tel1')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
*</td><td><input name="tel1"></td></tr>
	<tr><td><?php echo ((is_array($_tmp='tel2')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
(<?php echo ((is_array($_tmp='tel2_desc')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><input name="tel2"></td></tr>
	<tr><td></td><td><label><input type="checkbox" name="accept" value=true><?php echo ((is_array($_tmp='I accept to the Terms of Service')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</label></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="<?php echo ((is_array($_tmp='Submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
"></td></tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>