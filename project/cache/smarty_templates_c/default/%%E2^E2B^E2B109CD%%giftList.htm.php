<?php /* Smarty version 2.6.26, created on 2011-04-13 02:45:04
         compiled from giftList.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'giftList.htm', 36, false),)), $this); ?>
<?php ob_start(); ?>
    <style type="text/css">
/*      body{
        text-align:center;
      }
      table{
        margin:0px auto;
        border-width:0px;
      }
      img{
        border-style:none;
      }*/
      #table1{
           /*   margin:0px auto;*/
           margin:auto;
              border-width:0px;
      }
      #table1 img{
        border:none;
      }
    </style>
    <script language="Javascript">
      <!--
      function redeem(giftId,giftName,point){
        var option=confirm("Are you sure to redeem "+giftName+"? "+point+" points will be deducted from your account.");
        if(option==true){
          window.location="gift.php?action=redeem&giftId="+giftId;
        }
      }
      //-->
    </script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table align="center">
  <tr>
    <th><?php echo ((is_array($_tmp='Gift Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
    <th><?php echo ((is_array($_tmp='Remaining Quantity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
    <th><?php echo ((is_array($_tmp='Points Required')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
    <th><?php echo ((is_array($_tmp='Operation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
  </tr>
<?php $_from = $this->_tpl_vars['gifts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
  <tr><td colspan="4"><hr></td></tr>
  <tr>
    <td><?php echo $this->_tpl_vars['a']->getName(); ?>
<br><img src="images/gift/<?php echo $this->_tpl_vars['a']->getGid(); ?>
.JPG"></td>
    <td><div align="center"><?php echo $this->_tpl_vars['a']->getRemain(); ?>
/<?php echo $this->_tpl_vars['a']->getQty(); ?>
</div></td>
    <td><div align="center"><?php echo ((is_array($_tmp='x point')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['a']->getPoint()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['a']->getPoint())); ?>
</div></td>
    <td><div align="center"><input type="button" value="<?php echo ((is_array($_tmp='Redeem')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="redeem('<?php echo $this->_tpl_vars['a']->getGid(); ?>
','<?php echo $this->_tpl_vars['a']->getEngName(); ?>
','<?php echo $this->_tpl_vars['a']->getPoint(); ?>
');" <?php if ($this->_tpl_vars['a']->getRemain() <= 0): ?>disabled='disabled'<?php endif; ?>></div></td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>