<?php /* Smarty version 2.6.26, created on 2011-05-07 15:56:18
         compiled from team_create_form.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'team_create_form.htm', 13, false),)), $this); ?>
<?php ob_start(); ?>
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
<h1><?php echo ((is_array($_tmp='Create Your Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
<form action="?action=saveCreateNewTeam" method="POST">
    <table>
        <tr>
            <td><?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
(<?php echo ((is_array($_tmp='Chinese')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td>
            <td><input type="text" name="chiName"></td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
(<?php echo ((is_array($_tmp='English')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td>
            <td><input type="text" name="engName"></td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='URL')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><input type="text" name="url"></td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td>
                <select name="district" id="distCode">
                    <option value="na">N/A</option>
                    <?php $_from = $this->_tpl_vars['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['b']):
?>
                    <option value="<?php echo $this->_tpl_vars['b']->getDistCode(); ?>
"><?php echo $this->_tpl_vars['b']->getName(); ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='Type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td>
                <label><input type="radio" name="type" value="PUBLIC"><?php echo ((is_array($_tmp='PUBLIC')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</label>
                <label><input type="radio" name="type" value="PRIVATE"><?php echo ((is_array($_tmp='PRIVATE')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</label>
            </td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='Slogan')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><textarea cols="80" rows="2" name="Slogan" ></textarea></td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='Description')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><textarea cols="80" rows="4" name="description"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
"></td>
        </tr>
    </table>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>