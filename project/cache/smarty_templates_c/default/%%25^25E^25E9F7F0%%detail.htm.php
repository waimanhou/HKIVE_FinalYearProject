<?php /* Smarty version 2.6.26, created on 2011-04-10 14:29:36
         compiled from detail.htm */ ?>
<table>
<?php $_from = $this->_tpl_vars['data']->getDisplayProps(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prop'] => $this->_tpl_vars['v']):
?>
<?php if (( $this->_tpl_vars['v'] & 2 ) != 0): ?>
<tr><td>
<?php echo $this->_tpl_vars['data']->getPropName($this->_tpl_vars['prop']); ?>

    </td>
    <td>
        get<?php echo $this->_tpl_vars['prop']; ?>
()
    </td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>