<?php /* Smarty version 2.6.26, created on 2011-04-17 16:01:42
         compiled from message_foldertree_xml.htm */ ?>
<?php echo '<?xml'; ?>
 version='1.0' encoding='utf-8'<?php echo '?>'; ?>

<rows>
    <page>1</page>
    <total>1</total>
    <records>1</records>
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
    <?php $this->assign('folder', $this->_tpl_vars['list'][$this->_sections['i']['index']][0]); ?>
    <row>
        <cell><?php echo $this->_tpl_vars['folder']->getFolderId(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['folder']->getName(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']][1]; ?>
</cell>            <cell><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']][3]; ?>
</cell>            <cell><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']][2]; ?>
</cell>            <cell>true</cell>
    </row>
    <?php endfor; endif; ?>
</rows>