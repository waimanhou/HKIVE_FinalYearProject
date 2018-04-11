<?php /* Smarty version 2.6.26, created on 2011-04-13 16:06:53
         compiled from message_message_xml.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'message_message_xml.htm', 8, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version='1.0' encoding='utf-8'<?php echo '?>'; ?>

<message id="<?php echo $this->_tpl_vars['msg']->getMsgId(); ?>
">
  <?php $this->assign('sender', $this->_tpl_vars['msg']->getSender()); ?>
  <sender id="<?php echo $this->_tpl_vars['sender']->getUserId(); ?>
" loginName="<?php echo $this->_tpl_vars['sender']->getLoginName(); ?>
"><?php echo $this->_tpl_vars['sender']->getNickName(); ?>
 (<?php echo $this->_tpl_vars['sender']->getLoginName(); ?>
)</sender>\
  <time><?php echo $this->_tpl_vars['msg']->getCREATED(); ?>
</time>
  <subject><?php echo ((is_array($_tmp=$this->_tpl_vars['msg']->getSubject())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</subject>
  <body><?php echo ((is_array($_tmp=$this->_tpl_vars['msg']->getBody())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</body>
</message>