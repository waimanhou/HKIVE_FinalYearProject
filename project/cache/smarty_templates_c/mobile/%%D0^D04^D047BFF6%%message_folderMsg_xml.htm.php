<?php /* Smarty version 2.6.26, created on 2011-05-14 17:55:55
         compiled from message_folderMsg_xml.htm */ ?>
<?php echo '<?xml'; ?>
 version='1.0' encoding='utf-8'<?php echo '?>'; ?>

<rows>
    <page><?php echo $this->_tpl_vars['page']; ?>
</page>
    <total><?php echo $this->_tpl_vars['total']; ?>
</total>
    <records><?php echo $this->_tpl_vars['records']; ?>
</records>
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
    <row>
        <cell><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getMsgId(); ?>
</cell>
        <cell><![CDATA[<?php if (! $this->_tpl_vars['read'][$this->_sections['i']['index']]): ?><b><?php endif; ?><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getSubject(); ?>
<?php if (! $this->_tpl_vars['read'][$this->_sections['i']['index']]): ?></b><?php endif; ?>]]></cell>
        <?php $this->assign('sender', $this->_tpl_vars['list'][$this->_sections['i']['index']]->getSender()); ?>
        <cell><?php echo $this->_tpl_vars['sender']->getNickName(); ?>
 (<?php echo $this->_tpl_vars['sender']->getLoginName(); ?>
)</cell>
        <cell><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getCREATED(); ?>
</cell>        
    </row>
    <?php endfor; endif; ?>
</rows>