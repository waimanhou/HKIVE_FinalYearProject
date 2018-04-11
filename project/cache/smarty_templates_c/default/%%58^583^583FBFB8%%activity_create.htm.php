<?php /* Smarty version 2.6.26, created on 2011-04-11 15:18:18
         compiled from activity_create.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'activity_create.htm', 48, false),)), $this); ?>
<?php $this->_tpl_vars['cssFiles'][] = "./css/calendrical.css"; ?>
<?php ob_start(); ?>
<?php if ($_SESSION['lang'] == 'zh'): ?>
<script language="JavaScript" src="./js/jquery.ui.datepicker-zh-HK.js" type="text/javascript"></script>
<?php else: ?>
<script language="JavaScript" src="./js/jquery.ui.datepicker-en-GB.js" type="text/javascript"></script>
<?php endif; ?>
<script language="JavaScript" src="./js/jquery.calendrical.js" type="text/javascript"></script>
<script>
    $(function(){
        $("#date").datepicker({
            minDate:0,
            showOtherMonths: true,
            selectOtherMonths: true
        })
        $('#start, #end').calendricalTimeRange({
            isoTime:true
        });
        var updateVenue=function(){
            var typeId=$('#typeId').val();
            var distCode=$('#distCode').val();
            $.get('activity.php',{'action':'getVenueList','typeId':typeId,'distCode':distCode},function(d,s){
                //alert(d);
                //data=d;
                //alert(d.getElementsByTagName("venue")[0].firstChild.data);
                var venues=d.getElementsByTagName("venue");
                $("#venue").empty();
                for(i in venues){
                    //alert();
                    try{
                        $("#venue").append($('<option></option>').html(venues[i].firstChild.data).val($(venues[i]).attr("id")))
                    }catch(e){}
                }

            });
        }
        $('#distCode,#typeId').change(updateVenue);
        updateVenue();
        
        /*$.get('activity.php',{'action':'getCreateTeamList'},function(d,s){
            var teams=d.getElementsByTagName("team");
            $("#createrTeam").empty();
            for(i in teams){
                try{
                    $("#createrTeam").append($('<option></option>').html(teams[i].firstChild.data).val($(teams[i]).attr("id")));
                }catch(e){}
            }
            $("#createrTeam").append($('<option></option>').html('<?php echo ((is_array($_tmp='createtempteam')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
').val(-1));
        });*/

        $("#reqteam, #reqPlayer").keyup(function(){
            $(this).val(isNaN(parseInt($(this).val())) ? '' : parseInt($(this).val()));
        })
    });

</script>
<style>
    .ui-widget{
        font-size:80%;

    }
    .calendricalTimePopup {
        font-size:80%;}
    </style>
    <?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <h1><?php echo ((is_array($_tmp='Create Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
    <form action="?action=saveCreateActivity" method="POST">
        <table>
            <tr>
                <td>
                    <?php echo ((is_array($_tmp='activityname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                </td>
                <td>
                    <input type="text" name="actName" id="actName">
            </td>
        </tr>
        <tr>
            <td>
                <?php echo ((is_array($_tmp='venue type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

            </td>
            <td>
                <select name="typeId" id="typeId">
                    <?php $_from = $this->_tpl_vars['activityType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
                    <option value="<?php echo $this->_tpl_vars['a']->getType(); ?>
"><?php echo $this->_tpl_vars['a']->getName(); ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
        </tr>    
        <tr>
            <td>
                <?php echo ((is_array($_tmp='district')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

            </td>
            <td>
                <select name="distCode" id="distCode">

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
            <td>
                <?php echo ((is_array($_tmp='Venue')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

            </td>
            <td>
                <select name="venue" id="venue"></select>
            </td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='Date')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><input type="text" id="date" name="date"></td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='Time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><input type="text" size="5" id="start" name="start"> - <input type="text" size="5" id="end" name="end"></td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp="Require # of Team")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><input type="text" size="5" name="reqteam" id="reqteam"></td>
        </tr>
        <tr>
            <td><?php echo ((is_array($_tmp='Player Per Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><input type="text" size="5" name="reqPlayer" id="reqPlayer"></td>
        </tr>
        <!--tr>
            <td>
                <?php echo ((is_array($_tmp='Creater Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

            </td>
            <td>
                <select name="createrTeam" id="createrTeam"></select><input type="checkbox">By Invite only
<input type="checkbox">Team Member only
<input type="checkbox">I also join it<br>

            </td>
        </tr-->
        <tr>
            <td><?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td>
                <select name="type">
                    <option value="0"><?php echo ((is_array($_tmp='PUBLIC')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
                    <option value="1"><?php echo ((is_array($_tmp='By Invite only')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
                    <option value="2"><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
                    <option value="3"><?php echo ((is_array($_tmp='Org only')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
                </select>
            </td>
        </tr>
        <tr>
            <td valign="top"><?php echo ((is_array($_tmp='Other Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
            <td><textarea cols="80" rows="4" name="otherInfo"></textarea></td>
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