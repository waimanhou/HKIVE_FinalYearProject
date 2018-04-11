<?php /* Smarty version 2.6.26, created on 2011-05-14 22:47:41
         compiled from notification.htm */ ?>
<?php ob_start(); ?>
<script>
    $(function(){
        $("#tabs").tabs();
    })
</script>
<style>
    .tabdiv{
        font-size:70%;
        height:100%
    }
</style>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="tabdiv"> 
    <div id="tabs"> 
        <ul> 
            <li><a href="#summary">Summary</a></li>
            <li><a href="#activity">Activities</a></li>
            <li><a href="#team">Join Team Requests</a></li>
            <li><a href="#gift">Gift Redemption</a></li>
            <li><a href="#teamlead">The teams you lead</a></li>
            <li><a href="#org">Your Organizations</a></li>

        </ul>
        <div id="summary">
        </div>
        <div id="activity">
        </div>
        <div id="team">
        </div>
        <div id="gift">
        </div>
        <div id="teamlead">
        </div>
        <div id="org">
        </div>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>