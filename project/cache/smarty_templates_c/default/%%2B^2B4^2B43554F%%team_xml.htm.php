<?php /* Smarty version 2.6.26, created on 2011-04-10 13:48:34
         compiled from team_xml.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'team_xml.htm', 11, false),array('modifier', 'default', 'team_xml.htm', 16, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version='1.0' encoding='utf-8'<?php echo '?>'; ?>

<rows>
    <page><?php echo $this->_tpl_vars['page']; ?>
</page>
    <total><?php echo $this->_tpl_vars['totalpage']; ?>
</total>
    <records><?php echo $this->_tpl_vars['totalrecord']; ?>
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
        <cell><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getTeamId(); ?>
</cell>
        <cell><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</cell>
        <?php $this->assign('leader', $this->_tpl_vars['list'][$this->_sections['i']['index']]->getLeader()); ?>
        <cell><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['leader']->getLoginName(); ?>
</cell>
        <?php $this->assign('dist', $this->_tpl_vars['list'][$this->_sections['i']['index']]->getDist()); ?>
        <cell><?php echo ((is_array($_tmp=@$this->_tpl_vars['dist']->getName())) ? $this->_run_mod_handler('default', true, $_tmp, 'N/A') : smarty_modifier_default($_tmp, 'N/A')); ?>
</cell>
        <cell><?php echo ((is_array($_tmp=@$this->_tpl_vars['list'][$this->_sections['i']['index']]->getType())) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</cell>  <!--TODO: change this line-->
        <cell><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getUrl())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</cell>
        <?php $this->assign('org', $this->_tpl_vars['list'][$this->_sections['i']['index']]->getOrg()); ?>
        <cell><?php echo $this->_tpl_vars['org']->getOrgId(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['org']->getName(); ?>
</cell>
    </row>
    <?php endfor; endif; ?>

</rows>