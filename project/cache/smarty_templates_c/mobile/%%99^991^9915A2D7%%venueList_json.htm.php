<?php /* Smarty version 2.6.26, created on 2011-05-07 22:29:09
         compiled from venueList_json.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'venueList_json.htm', 13, false),)), $this); ?>
{
"page":"<?php echo $this->_tpl_vars['page']; ?>
",
"total":"<?php echo $this->_tpl_vars['totalpage']; ?>
",
"records":"<?php echo $this->_tpl_vars['totalrecord']; ?>
",
"rows":[
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
    <?php if ($this->_sections['i']['index'] != 0): ?> , <?php endif; ?>
        {
            "id":"<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getVenueId(); ?>
",
            "cell":[

                <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getVenueId(); ?>
,
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getFullName())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
",
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getAbbrName())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
",
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getTypeStr())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
",
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getTel())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
",
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getRegion())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
",
                <?php $this->assign('dist', $this->_tpl_vars['list'][$this->_sections['i']['index']]->getDist()); ?>
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['dist']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
",
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getAddress())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
",
                "<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]->getMap())) ? $this->_run_mod_handler('escape', true, $_tmp, 'slash') : smarty_modifier_escape($_tmp, 'slash')); ?>
"
            ]
        }
<?php endfor; endif; ?>
]
}