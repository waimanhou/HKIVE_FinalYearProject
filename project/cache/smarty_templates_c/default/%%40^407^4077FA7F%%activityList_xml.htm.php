<?php /* Smarty version 2.6.26, created on 2011-04-11 15:08:17
         compiled from activityList_xml.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'activityList_xml.htm', 13, false),array('modifier', 'date_format', 'activityList_xml.htm', 27, false),)), $this); ?>
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
        <cell><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getActId(); ?>
</cell>
        <cell><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</cell>
        <?php $this->assign('owner', $this->_tpl_vars['list'][$this->_sections['i']['index']]->getOwner()); ?>
        <?php $this->assign('venue', $this->_tpl_vars['list'][$this->_sections['i']['index']]->getVenue()); ?>        
        <cell><?php echo $this->_tpl_vars['owner']->getUserId(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['owner']->getNickName(); ?>
 (<?php echo $this->_tpl_vars['owner']->getLoginName(); ?>
)</cell>
        <cell><?php echo $this->_tpl_vars['owner']->getCredit(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['venue']->getVenueId(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['venue']->getAbbrName(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['venue']->getFullName(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['venue']->getTypeStr(); ?>
</cell>
        <cell><?php echo $this->_tpl_vars['venue']->getRegion(); ?>
</cell>
        <?php $this->assign('dist', $this->_tpl_vars['venue']->getDist()); ?>
        <cell><?php echo $this->_tpl_vars['dist']->getName(); ?>
</cell>
        <cell><?php echo ((is_array($_tmp=$this->_tpl_vars['venue']->getMap())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</cell>
        <cell><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</cell>
        <cell><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</cell>
        <cell><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getEndTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</cell>

    </row>
    <?php endfor; endif; ?>

</rows>


