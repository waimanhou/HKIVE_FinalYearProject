<?php /* Smarty version 2.6.26, created on 2011-05-15 12:39:17
         compiled from organization_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'organization_detail.htm', 68, false),array('modifier', 'escape', 'organization_detail.htm', 91, false),array('modifier', 'nl2br', 'organization_detail.htm', 105, false),array('modifier', 'date_format', 'organization_detail.htm', 125, false),)), $this); ?>
<?php ob_start(); ?>
<script>
        <?php if ($_GET['type'] == 'iframe'): ?>
        if(top==self){
        location="?action=viewDetail&orgId=<?php echo $_GET['orgId']; ?>
"
    }
        <?php endif; ?>
</script>
<script>

    $(function() {
        $( "#tabs" ).tabs({
            show: function(u, ui) {}
        });

        $("#togglepanel").togglePanel();
        $("#togglepanel button").button();
    });
    function sendMsgToMem(){
        a=$("input[name=mem]").get()
        b=[];
        for(i=0;i<=a.length;i++){
            if($(a[i]).attr('checked')){
                b.push($(a[i]).val());
            }
        }
        showSendMsgDialog(b.join(","));

    }
</script>
<script language="JavaScript" src="./js/jquery.fcbkcomplete.js" type="text/javascript"></script>
<script>
    $(function(){
        $("input[type=text],textarea").addClass("text ui-widget-content ui-corner-all");
        $("input[type=submit]").button()
        $("#teamlist").fcbkcomplete({
            json_url: "team.php?action=getFCBKList",
            addontab: true,
            maxitems: 99999,
            height: 10,
            cache: true,
            filter_case: false
        });
    });
</script>
<style>
    .tabdiv{
        font-size:70%;
        height:100%
    }
    <?php if ($_GET['type'] == 'iframe'): ?>
    .header{display:none}
    body{
        background-color:transparent !important;
    }
    <?php endif; ?>
    .ui-dialog{
        font-size:80%
    }
</style>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>

<?php $this->_tpl_vars['cssFiles'][] = "./css/fcbkcomplete.css"; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('creator', $this->_tpl_vars['org']->getCreator()); ?>
<?php $this->assign('teams', $this->_tpl_vars['org']->getTeams()); ?>
<h2 class="header"><?php echo ((is_array($_tmp='Organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 #<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
</h2>

<div class="tabdiv">

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1"><?php echo ((is_array($_tmp='Details')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-2"><?php echo ((is_array($_tmp='Teams')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-3"><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php if ($this->_tpl_vars['creator']->getUserId() == $_SESSION['userId']): ?>
            <li><a href="#tabs-4"><?php echo ((is_array($_tmp='Manage')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php endif; ?>

        </ul>
        <div id="tabs-1"> <!--Activity Details-->

            <img src="<?php echo $this->_tpl_vars['org']->getLogoPath(128); ?>
" align="right">
            <?php $this->assign('creator', $this->_tpl_vars['org']->getCreator()); ?>
            <table>
                <tr>
                    <td colspan="2"><b><?php echo ((is_array($_tmp='Organization Creator Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                <tr>
                    <td valign="top"><?php echo ((is_array($_tmp='Organization Creator')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo $this->_tpl_vars['creator']->getNickName(); ?>
 (<a href="javascript:showAccount('<?php echo $this->_tpl_vars['creator']->getLoginName(); ?>
')"><?php echo $this->_tpl_vars['creator']->getLoginName(); ?>
</a>)</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Email')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['creator']->getEmail())) ? $this->_run_mod_handler('escape', true, $_tmp, 'mail') : smarty_modifier_escape($_tmp, 'mail')); ?>
</td></tr>
            </table>
            <br/>
            <table>
                <tr><td valign="top" colspan="2"><b><?php echo ((is_array($_tmp='Organization Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                <tr><td valign="top" nowrap><?php echo ((is_array($_tmp='Organization name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='chinese')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><?php echo $this->_tpl_vars['org']->getChiName(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Organization name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='english')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><?php echo $this->_tpl_vars['org']->getEngName(); ?>
</td></tr>
                <?php $this->assign('dist', $this->_tpl_vars['org']->getDist()); ?>
                <tr><td valign="top"><?php echo ((is_array($_tmp='district')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['dist']->getName(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='URL')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><a href="<?php echo $this->_tpl_vars['org']->getUrl(); ?>
"><?php echo $this->_tpl_vars['org']->getUrl(); ?>
</a></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='slogan')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['org']->getSlogan(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp="no. of team")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['org']->getNoOfTeam(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp="no. of member")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['org']->getNoOfPlayer(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php if ($this->_tpl_vars['org']->getType() == 0): ?><?php echo ((is_array($_tmp='OPEN')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='PRIVATE')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php endif; ?></td></tr> <!--TODO:change this line-->
                <tr><td valign="top"><?php echo ((is_array($_tmp='Description')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['org']->getDescription())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td></tr>
            </table>

        </div>
        <div id="tabs-2">
            <?php if ($this->_tpl_vars['org']->getType() == 0): ?>
            <a href="javascript:showDialog('http://'+location.host+'/organization.php?action=join&orgId=<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
',undefined,undefined,'Join #<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['org']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')"><?php echo ((is_array($_tmp='Join this organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
            <?php endif; ?>
            <ul>
                <?php $_from = $this->_tpl_vars['teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
                <li><a href="javascript:showTeam(<?php echo $this->_tpl_vars['m']->getTeamId(); ?>
)"><img src="<?php echo $this->_tpl_vars['m']->getLogoPath(); ?>
"><?php echo $this->_tpl_vars['m']->getName(); ?>
</a>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
        <div id="tabs-3">
            <ul>
                <?php $_from = $this->_tpl_vars['teamAct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
                <?php $this->assign('team', $this->_tpl_vars['m']['0']); ?>
                <?php $this->assign('act', $this->_tpl_vars['m']['1']); ?>
                <?php $this->assign('venue', $this->_tpl_vars['act']->getVenue()); ?>
                <li><a href="javascript:showActivity(<?php echo $this->_tpl_vars['act']->getActId(); ?>
)"><?php echo $this->_tpl_vars['act']->getName(); ?>
</a> <?php echo ((is_array($_tmp=$this->_tpl_vars['act']->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 @ <?php echo $this->_tpl_vars['venue']->getAbbrName(); ?>
 (
                    <a href="javascript:showTeam(<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['team']->getName(); ?>
</a> )
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
        <?php if ($this->_tpl_vars['creator']->getUserId() == $_SESSION['userId']): ?>
        <div id="tabs-4">
            <div id="togglepanel">
                <h3><a href="#"><?php echo ((is_array($_tmp='Organization Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div>
                    <form action="organization.php?action=updateDetail" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="orgId" value="<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
">
                        <table>
                            <tr><td><?php echo ((is_array($_tmp='Organization name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='chinese')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><input type="text" name="chiName" value="<?php echo $this->_tpl_vars['org']->getChiName(); ?>
"></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='Organization name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='english')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><input type="text" name="engName" value="<?php echo $this->_tpl_vars['org']->getEngName(); ?>
"></td></tr>
                            <?php $this->assign('dist', $this->_tpl_vars['org']->getDist()); ?>
                            <tr><td><?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
                                <td>
                                    <select name="district" id="distCode">
                                        <option value="na">N/A</option>
                                        <?php $_from = $this->_tpl_vars['allDistrict']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['b']):
?>
                                        <option value="<?php echo $this->_tpl_vars['b']->getDistCode(); ?>
" <?php if ($this->_tpl_vars['dist']->getDistCode() == $this->_tpl_vars['b']->getDistCode()): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['b']->getName(); ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr><td><?php echo ((is_array($_tmp='URL')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><input type="text" name="url" value="<?php echo $this->_tpl_vars['org']->getUrl(); ?>
"></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='slogan')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><input type="text" name="slogan" value="<?php echo $this->_tpl_vars['org']->getSlogan(); ?>
"></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='Type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
                                <td>
                                    <label>
                                        <input type="radio" name="orgtype" value="0" <?php if ($this->_tpl_vars['org']->getType() == 0): ?>checked<?php endif; ?>> <?php echo ((is_array($_tmp='Public')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                    </label>
                                    <label>
                                        <input type="radio" name="orgtype" value="1" <?php if ($this->_tpl_vars['org']->getType() == 1): ?>checked<?php endif; ?>> <?php echo ((is_array($_tmp='Private')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='Join by invitation only')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)
                                    </label>
                                </td>
                            </tr>
                            <tr><td><?php echo ((is_array($_tmp='logo')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td>    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /><input type="file" name="logo"></td></tr>

                            <tr><td valign="top"><?php echo ((is_array($_tmp='Description')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><textarea cols="60" rows="5" name="description"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['org']->getDescription())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</textarea></td></tr>
                            <tr><td></td><td><input type="submit" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
"></td></tr>
                        </table>
                    </form>
                </div>

                <h3><a href="#"><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div>
                    <button onclick="sendMsgToMem()"><?php echo ((is_array($_tmp='Send Message to selected team leader')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                    <!--button>Remove selected member</button--><br>
                    <table>
                        <tr>
                            <th><input type="checkbox" onchange='$("input[name=\"mem\"]").attr("checked",this.checked)'></th>
                            <th><?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Team leader')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php $_from = $this->_tpl_vars['teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['team']):
?>
                        <?php $this->assign('leader', $this->_tpl_vars['team']->getLeader()); ?>
                        <tr>
                            <td><input type="checkbox" name="mem" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['leader']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"></td>
                            <td><?php echo $this->_tpl_vars['team']->getChiName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['team']->getEngName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['leader']->getLoginName(); ?>
</td>
                            <td><button onclick="showSendMsgDialog('<?php echo ((is_array($_tmp=$this->_tpl_vars['leader']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')"><?php echo ((is_array($_tmp='Send message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button></td>
                            <td><button onclick="location='?action=delTeam&teamId=<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
&orgId=<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
'"><?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6">No Records</td>
                        </tr>
                        <?php endif; unset($_from); ?>
                    </table>
                </div>
                <h3><a href="#"><?php echo ((is_array($_tmp='Requests Received')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div>
                    <table>
                        <tr>
                            <th><?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Team leader')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th>&nbsp;</th>

                        </tr>
                        <?php $_from = $this->_tpl_vars['ORList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tm']):
?>
                        <?php $this->assign('team', $this->_tpl_vars['tm']->getTeam()); ?>
                        <?php $this->assign('leader', $this->_tpl_vars['team']->getLeader()); ?>
                        <?php if (( $this->_tpl_vars['tm']->getStatus() == 1 ) || ( $this->_tpl_vars['tm']->getStatus() == 3 )): ?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['team']->getChiName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['team']->getEngName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
                            <td>
                                <?php if ($this->_tpl_vars['tm']->getStatus() == 1): ?>
                                <?php echo ((is_array($_tmp='Requested')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                <?php elseif ($this->_tpl_vars['tm']->getStatus() == 3): ?>
                                <?php echo ((is_array($_tmp='Request Rejected')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo $this->_tpl_vars['tm']->getReqMsg(); ?>
</td>
                            <td>
                                <button onclick="location='?action=acceptReq&invId=<?php echo $this->_tpl_vars['tm']->getInvId(); ?>
&ticket=<?php echo $this->_tpl_vars['cTicket2']; ?>
'">Accept</button>
                                <button onclick="location='?action=rejectReq&invId=<?php echo $this->_tpl_vars['tm']->getInvId(); ?>
&ticket=<?php echo $this->_tpl_vars['cTicket2']; ?>
'">Reject</button>
                                <button onclick="location='?action=deleteReq&invId=<?php echo $this->_tpl_vars['tm']->getInvId(); ?>
&ticket=<?php echo $this->_tpl_vars['cTicket2']; ?>
'">Delete</button>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="4">No Records</td>
                        </tr>
                        <?php endif; unset($_from); ?>
                    </table>
                </div>
                <h3><a href="#"><?php echo ((is_array($_tmp='Invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div>
                    <div style="border:solid 1px #000000">
                        <?php echo ((is_array($_tmp='send Invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        <form action="?action=invitation" method="POST">
                            <input type="hidden" name="orgId" value="<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
">
                            <div class="fcbk">
                                <?php echo ((is_array($_tmp='Teams')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:
                                <select id="teamlist" name="teamlist">
                                </select>
                                <br><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<br>
                                <textarea name="msg" cols="80" rows="5"></textarea>
                            </div>
                            <input type="submit" class="btn" value="<?php echo ((is_array($_tmp='send')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
                        </form>
                    </div>
                    <br>
                    <table>
                        <tr>
                            <th><?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Team leader')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                        </tr>
                        <?php $_from = $this->_tpl_vars['ORList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tm']):
?>
                        <?php $this->assign('team', $this->_tpl_vars['tm']->getTeam()); ?>
                        <?php $this->assign('leader', $this->_tpl_vars['team']->getLeader()); ?>
                        <?php if (( $this->_tpl_vars['tm']->getStatus() == 0 ) || ( $this->_tpl_vars['tm']->getStatus() == 2 )): ?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['team']->getChiName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['team']->getEngName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
                            <td>
                                <?php if ($this->_tpl_vars['tm']->getStatus() == 0): ?>
                                <?php echo ((is_array($_tmp='Invited')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                <?php elseif ($this->_tpl_vars['tm']->getStatus() == 3): ?>
                                <?php echo ((is_array($_tmp='Invitation Rejected')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="4">No Records</td>
                        </tr>
                        <?php endif; unset($_from); ?>
                    </table>
                </div>                
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>

<?php if ($_GET['type'] != 'iframe'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>