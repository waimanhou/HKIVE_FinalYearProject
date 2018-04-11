<?php /* Smarty version 2.6.26, created on 2011-05-11 03:04:59
         compiled from comment.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'comment.htm', 43, false),)), $this); ?>
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
	<script>
    $(function(){
        $("input[type=text],textarea").addClass("text ui-widget-content ui-corner-all");
        $("input[type=submit]").button()
    });
</script>
<style>
    .ui-button{font-size:80%;}
</style>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h3><?php echo ((is_array($_tmp='Give comment to your opponent team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h3>
<table>
	<tr align="center"><td><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='Your Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='Opponent Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td></tr>
<?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['outer']['iteration']++;
?>
	<tr>
		<td><?php echo $this->_tpl_vars['list']['actName']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['list']['chiteamName']; ?>
(<?php echo $this->_tpl_vars['list']['engteamName']; ?>
)</td>
		<td align="center"><a href="comment.php?action=listopponentTeam&actId=<?php echo $this->_tpl_vars['list']['actId']; ?>
&itId=<?php echo $this->_tpl_vars['list']['itId']; ?>
"><?php echo ((is_array($_tmp='View')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
	</tr>
<?php endforeach; else: ?>
	<tr><td colspan="2">No activity have not given comment</td></tr>
<?php endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>