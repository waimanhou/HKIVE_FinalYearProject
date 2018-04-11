<?php /* Smarty version 2.6.26, created on 2011-05-13 23:16:39
         compiled from showMsg.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strstr', 'showMsg.htm', 1, false),array('modifier', 'lang', 'showMsg.htm', 7, false),array('modifier', 'escape', 'showMsg.htm', 13, false),)), $this); ?>
<?php if (((is_array($_tmp=$_SERVER['HTTP_REFERER'])) ? $this->_run_mod_handler('strstr', true, $_tmp, 'type=iframe') : strstr($_tmp, 'type=iframe')) != ''): ?>
<table width="100%" height="100%">
    <tr><td align="center" valign="middle">

            <table border="1" width="75%" align="center">
                <tr><td align="center">
                        <b><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>
                    </td></tr>
                <tr><td align="center">
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['msg'])) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                    </td></tr>
                <tr><td align="center">
                        <input type="button" value="<?php echo ((is_array($_tmp='BACK')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="location='<?php echo ((is_array($_tmp=$_SERVER['HTTP_REFERER'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
'">

                    </td></tr>
            </table>

        </td></tr>
</table>
<?php else: ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table border="1" width="75%" align="center">
    <tr><td align="center">
            <b><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>
        </td></tr>
    <tr><td align="center">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['msg'])) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

        </td></tr>
    <tr><td align="center">            
            <input type="button" value="<?php echo ((is_array($_tmp='HOME')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="location='./'">

        </td></tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>