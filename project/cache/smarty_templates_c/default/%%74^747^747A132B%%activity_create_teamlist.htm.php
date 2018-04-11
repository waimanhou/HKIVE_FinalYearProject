<?php /* Smarty version 2.6.26, created on 2011-05-07 15:53:53
         compiled from activity_create_teamlist.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'activity_create_teamlist.htm', 6, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version='1.0' encoding='utf-8'<?php echo '?>'; ?>

<teams>
    <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
    <team id="<?php echo $this->_tpl_vars['v']->getTeamId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</team>
    <?php endforeach; endif; unset($_from); ?>
</teams>