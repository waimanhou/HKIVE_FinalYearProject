<?php /* Smarty version 2.6.26, created on 2011-04-11 11:15:25
         compiled from news.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'news.htm', 53, false),)), $this); ?>
<?php ob_start(); ?>
<style type="text/css">
.table1 {
  border-collapse: collapse;
  border: 1px solid #666666;
  font: normal verdana, arial, helvetica, sans-serif;
  color: #363636;
  background: #f6f6f6;
  text-align:left;
  width:90%;
  margin-top:4px;
  margin-left:auto;
  margin-right:auto;
  }
.table1 caption {
  text-align: center;
  font: bold 16px arial, helvetica, sans-serif;
  background: transparent;
  padding:6px 4px 8px 0px;
  color: #CC00FF;
  text-transform: uppercase;
}
.table1 thead, .table1 tfoot {
background:url(bg1.png) repeat-x;
text-align:left;
height:30px;
}
.table1 thead th, .table1 tfoot th {
padding:5px;
}
.table1 a {
color: #333333;
text-decoration:none;
}
.table1 a:hover {
text-decoration:underline;
}
.table1 tr.odd {
background: url(./images/bg1.png);
}
.table1 tbody th, .table1 tbody td {
padding:5px;
}
.table1 .time{
width:200px;
}
</style>
<script>
$(function(){
    var max=parseInt("<?php echo $this->_tpl_vars['max_page']; ?>
");
    var cpage=parseInt("<?php echo $this->_tpl_vars['current_page']; ?>
");
    var str="<center>";
    str+="Go to".link("javascript:location='?page='+(parseInt(prompt('<?php echo ((is_array($_tmp='Page no')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
? (<?php echo ((is_array($_tmp='max')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:"+max+")',"+cpage+")))")
    str+="&nbsp;";
    if(cpage>3)str+='<a href=\'?page=1\'><?php echo ((is_array($_tmp='First')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a> , ';
    if(cpage>1)str+='<a href=\'?page='+(cpage-1)+'\'><?php echo ((is_array($_tmp='Prev')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a> ';
    start=cpage-2 < 1 ? 1: cpage-2;
    end=start+4 > max ? max : start+4
    for(n=start;n<=end;n++)
    {
        if(cpage!=1||n!=1)str+=(" , ")
        if(n==cpage){str+=(""+n).bold().big().big();}else{str+="<a href='?page="+n+"'>"+n+"</a>";}
    }
    if(cpage<max)str+=' , <a href=\'?page='+(cpage+1)+'\'><?php echo ((is_array($_tmp='Next')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
    if(cpage<max-2)str+=' , <a href=\'?page='+max+'\'><?php echo ((is_array($_tmp='Last')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
    str+="</center>";
    $('span[name="page"]').each(function(){$(this).html(str)});
});
</script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1><?php echo ((is_array($_tmp='NEWS')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
<span name="page"></span>
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
    <table border="1" class="table1">
        <tr class='odd'>
            <td>
                <b><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getTitle(); ?>
</b>
            </td>
            <td class="time">    <?php echo ((is_array($_tmp='Time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getTime(); ?>
</td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getBody(); ?>

            </td>
        </tr>
    </table>
<?php endfor; endif; ?>
<span name="page"></span>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>