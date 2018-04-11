<?php /* Smarty version 2.6.26, created on 2011-05-07 15:53:52
         compiled from activity_newteam.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'activity_newteam.htm', 26, false),)), $this); ?>
<html><head>
        <link rel="stylesheet" type="text/css" href="./css/cupertino/jquery-ui-1.8.9.custom.css" />
        <link rel="stylesheet" type="text/css" href="./css/ui.jqgrid.css" />
        <link rel="stylesheet" type="text/css" href="./css/common.css" />

        <script language="JavaScript" src="./js/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="./js/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="./js/i18n/grid.locale-zh.js" type="text/javascript"></script>
        <script language="JavaScript" src="./js/jquery.jqGrid.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="./js/jquery.togglePanel.js" type="text/javascript"></script>
        <script language="JavaScript" src="./ckeditor/ckeditor.js" type="text/javascript"></script>
        <script language="JavaScript" src="./ckeditor/adapters/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="./js/ckeditor_patch.js" type="text/javascript"></script>
        <script language="JavaScript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false&language=zh-tw" type="text/javascript"></script>
        <script language="JavaScript" src="./common_js.php" type="text/javascript"></script>
        <script>
            $(function(){
                $.get('activity.php',{'action':'getCreateTeamList'},function(d,s){
                    var teams=d.getElementsByTagName("team");
                    $("#createrTeam").empty();
                    for(i in teams){
                        try{
                            $("#createrTeam").append($('<option></option>').html(teams[i].firstChild.data).val($(teams[i]).attr("id")));
                        }catch(e){}
                    }
                    $("#createrTeam").append($('<option></option>').html('<?php echo ((is_array($_tmp='Create temp team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
').val(-1));
                });
            });
        </script>
    </head><body>
        <?php if ($_GET['type'] == 'home'): ?>
        New Home Team
        <?php else: ?>
        New Away Team
        <?php endif; ?>

        <form action="?action=newteamsave" method="post">
            <input type="hidden" value="<?php echo $_GET['type']; ?>
" name="type">
            <input type="hidden" value="<?php echo $this->_tpl_vars['activity']->getActId(); ?>
" name="actId">
        <table border="1">
            <tbody>
                <tr>
                    <td>Activity</td>
                    <td><?php echo $this->_tpl_vars['activity']->getActId(); ?>
 - <?php echo $this->_tpl_vars['activity']->getName(); ?>
</td>
                </tr>
                <tr>
                    <td>Team:</td>
                    <td><select id="createrTeam" name="teamId"></select></td>
                </tr>
                <tr>
                    <td>Option</td>
                    <td>
                        <label><input type="checkbox" name="foreign">Allow Foreign players</label><br>
                        <!--label><input type="checkbox" name="invonly">Join by invitation only</label><br-->
                        <label><input type="checkbox" name="ijoin">I also join it</label>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td><td>
            <input type="submit" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
            <input type="button" value="BACK" onclick="history.go(-1)">
                    </td>
                </tr>
            </tbody>
        </table>
        </form>
    </body></html>