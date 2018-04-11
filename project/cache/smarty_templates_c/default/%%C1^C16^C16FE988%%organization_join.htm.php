<?php /* Smarty version 2.6.26, created on 2011-05-15 12:09:33
         compiled from organization_join.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'organization_join.htm', 12, false),)), $this); ?>
<form action="?action=savejoin" method="POST">
    Join Organization #<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
 <?php echo $this->_tpl_vars['org']->getName(); ?>
<br>
    Please select the team that you want to be joined this organization:<br>
    <select name="teamId">
    <?php $_from = $this->_tpl_vars['teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
    <option value="<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
"><?php echo $this->_tpl_vars['t']->getName(); ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
    </select><br>
    Message:
    <textarea name="reqMsg"></textarea>
    <input type="hidden" name="orgId" value="<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
">
    <input type="submit" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
</form>