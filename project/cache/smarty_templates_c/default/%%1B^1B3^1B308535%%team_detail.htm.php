<?php /* Smarty version 2.6.26, created on 2011-05-15 13:45:48
         compiled from team_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'team_detail.htm', 70, false),array('modifier', 'escape', 'team_detail.htm', 93, false),array('modifier', 'nl2br', 'team_detail.htm', 112, false),array('modifier', 'date_format', 'team_detail.htm', 130, false),)), $this); ?>
<?php ob_start(); ?>
<script>
        <?php if ($_GET['type'] == 'iframe'): ?>
        if(top==self){
        location="?action=viewDetail&teamId=<?php echo $_GET['teamId']; ?>
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
    function sendInvitation(){
        //alert(123);
        loginId=prompt("Please enter the Login Name:")
        if(loginId!=null){
            location="?action=sendInv&ticket=<?php echo $this->_tpl_vars['invitationTicket']; ?>
&teamId=<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
&loginname="+escape(loginId);
        }else{
            jqAlert("Operation Cancelled");
        }
    }
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
<script>
    $(function(){
        $("input[type=text],textarea").addClass("text ui-widget-content ui-corner-all");
        $("input[type=submit]").button()
    });
</script>
<style>
    .tabdiv{
        font-size:70%;
        height:100%
    }

    .ui-dialog{
        font-size:80%
    }
    <?php if ($_GET['type'] == 'iframe'): ?>
    .header{display:none}
    body{
        background-color:transparent !important;
    }
    <?php endif; ?>
</style>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('leader', $this->_tpl_vars['team']->getLeader()); ?>


<h2 class="header"><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 #<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
</h2>

<div class="tabdiv">

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1"><?php echo ((is_array($_tmp='Details')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-2"><?php echo ((is_array($_tmp='Team Member')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-3"><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php if ($this->_tpl_vars['leader']->getUserId() == $_SESSION['userid']): ?>
            <li><a href="#tabs-4"><?php echo ((is_array($_tmp='Manage')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-5"><?php echo ((is_array($_tmp='Invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php endif; ?>
        </ul>
        <div id="tabs-1"> <!--Team Details-->
            <img src="<?php echo $this->_tpl_vars['team']->getLogoPath(128); ?>
" align="right">
            <table>
                <tr>
                    <td colspan="2"><b><?php echo ((is_array($_tmp='Team Leader Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                <tr>
                    <td valign="top"><?php echo ((is_array($_tmp='Team Leader')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><a href="javascript:showAccount('<?php echo $this->_tpl_vars['leader']->getLoginName(); ?>
')"><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
 (<?php echo $this->_tpl_vars['leader']->getLoginName(); ?>
)</a></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo ((is_array($_tmp='Email')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['leader']->getEmail())) ? $this->_run_mod_handler('escape', true, $_tmp, 'mail') : smarty_modifier_escape($_tmp, 'mail')); ?>
</a></td>
                </tr>
            </table>

            <table>
                <tr><td valign="top"><b><?php echo ((is_array($_tmp='Team Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                <?php if ($this->_tpl_vars['team']->getOrgId()): ?>
                <?php $this->assign('org', $this->_tpl_vars['team']->getOrg()); ?>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='chinese')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><a href="javascript:showOrg(<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
)"><?php echo $this->_tpl_vars['org']->getChiName(); ?>
</a></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='english')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><a href="javascript:showOrg(<?php echo $this->_tpl_vars['org']->getOrgId(); ?>
)"><?php echo $this->_tpl_vars['org']->getEngName(); ?>
</a></td></tr>
                <?php endif; ?>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='chinese')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><?php echo $this->_tpl_vars['team']->getChiName(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='english')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><?php echo $this->_tpl_vars['team']->getEngName(); ?>
</td></tr>
                <?php $this->assign('dist', $this->_tpl_vars['team']->getDist()); ?>
                <tr><td valign="top"><?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['dist']->getName(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='temporary')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php if ($this->_tpl_vars['team']->getTemporary() == 0): ?><?php echo ((is_array($_tmp='No')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='Yes')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php endif; ?></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='URL')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><a href="<?php echo $this->_tpl_vars['team']->getUrl(); ?>
" target="_blank"><?php echo $this->_tpl_vars['team']->getUrl(); ?>
</a></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='slogan')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['team']->getSlogan(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php if ($this->_tpl_vars['team']->getType() == 0): ?><?php echo ((is_array($_tmp='PUBLIC')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='PRIVATE')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php endif; ?></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='description')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['team']->getDescription())) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td></tr>
            </table>
        </div>
        <div id="tabs-2">
            <!--Team Member-->
            <?php if (! $this->_tpl_vars['isMember'] && $_SESSION['userId']): ?>            <a href="?action=joinrequest&teamId=<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
&ticket=<?php echo $this->_tpl_vars['joinTicket']; ?>
"><?php echo ((is_array($_tmp='Join this team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
            <?php endif; ?>
            <ul>
                <?php $_from = $this->_tpl_vars['memberlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mem']):
?>
                <li><?php echo $this->_tpl_vars['mem']->getNickName(); ?>
 (<a href="javascript:showAccount('<?php echo $this->_tpl_vars['mem']->getLoginName(); ?>
')"><?php echo $this->_tpl_vars['mem']->getLoginName(); ?>
</a>)
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
        <div id="tabs-3">
            <ul>
                <?php $_from = $this->_tpl_vars['activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['act']):
?>
                <?php $this->assign('venue', $this->_tpl_vars['act']->getVenue()); ?>
                <li><a href="javascript:showActivity(<?php echo $this->_tpl_vars['act']->getActId(); ?>
)"><?php echo $this->_tpl_vars['act']->getName(); ?>
</a>  <?php echo ((is_array($_tmp=$this->_tpl_vars['act']->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 @ <?php echo $this->_tpl_vars['venue']->getAbbrName(); ?>

                    <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>

        <?php if ($this->_tpl_vars['leader']->getUserId() == $_SESSION['userid']): ?>
        <div id="tabs-4">
            <div id="togglepanel">
                <h3><a href="#"><?php echo ((is_array($_tmp='Team Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div>
                    <form action="team.php?action=updateDetail" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="teamId" value="<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
">
                        <table>
                            <tr><td><b><?php echo ((is_array($_tmp='Team Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='chinese')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><input type="text" name="chiName" value="<?php echo $this->_tpl_vars['team']->getChiName(); ?>
"></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='english')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td><td><input type="text" name="engName" value="<?php echo $this->_tpl_vars['team']->getEngName(); ?>
"></td></tr>
                            <?php $this->assign('dist', $this->_tpl_vars['team']->getDist()); ?>
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
                            <tr><td><?php echo ((is_array($_tmp='temporary')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php if ($this->_tpl_vars['team']->getTemporary() == 0): ?><?php echo ((is_array($_tmp='No')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='Yes')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php endif; ?></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='URL')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><input type="text" name="url" value="<?php echo $this->_tpl_vars['team']->getUrl(); ?>
"></a></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='slogan')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><input type="text" name="slogan" value="<?php echo $this->_tpl_vars['team']->getSlogan(); ?>
"></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
                                <td>
                                    <label>
                                        <input type="radio" name="teamtype" value="0" <?php if ($this->_tpl_vars['team']->getType() == 0): ?>checked<?php endif; ?>> <?php echo ((is_array($_tmp='Public')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                    </label>
                                    <label>
                                        <input type="radio" name="teamtype" value="1" <?php if ($this->_tpl_vars['team']->getType() == 1): ?>checked<?php endif; ?>> <?php echo ((is_array($_tmp='Private')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 (<?php echo ((is_array($_tmp='Join by invitation only')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)
                                    </label>
                                </td>
                            </tr>

                            <tr><td><?php echo ((is_array($_tmp='logo')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td>    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /><input type="file" name="logo"></td></tr>
                            <tr><td><?php echo ((is_array($_tmp='description')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><textarea cols="60" rows="5" name="description"><?php echo ((is_array($_tmp=$this->_tpl_vars['team']->getDescription())) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</textarea></td></tr>
                            <tr><td></td><td><input type="submit" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
"></td></tr>
                        </table>
                    </form>
                </div>
                <h3><a href="#"><?php echo ((is_array($_tmp='Team Member')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div>
                    <button onclick="sendMsgToMem()"><?php echo ((is_array($_tmp='Send Message to selected member')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                    <!--button>Remove selected member</button--><br>
                    <table>
                        <tr>
                            <th><input type="checkbox" onchange='$("input[name=\"mem\"]").attr("checked",this.checked)'></th>
                            <th><?php echo ((is_array($_tmp='NickName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='LoginName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php $_from = $this->_tpl_vars['memberlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mem']):
?>
                                                <tr>
                            <td><input type="checkbox" name="mem" value="<?php echo $this->_tpl_vars['mem']->getLoginName(); ?>
"></td>
                            <td><?php echo $this->_tpl_vars['mem']->getNickName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['mem']->getChiName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['mem']->getEngName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['mem']->getLoginName(); ?>
</td>
                            <td>
                                <button onclick="showSendMsgDialog('<?php echo ((is_array($_tmp=$this->_tpl_vars['mem']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')"><?php echo ((is_array($_tmp='Send Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                                <button onclick="location='?action=delTM&teamId=<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
&userId=<?php echo $this->_tpl_vars['mem']->getUserId(); ?>
'"><?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                                <!--TODO: change (getUserId?!)-->

                            </td>
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
                            <th><?php echo ((is_array($_tmp='NickName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th>&nbsp;</th>

                        </tr>
                        <?php $_from = $this->_tpl_vars['TMList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tm']):
?>
                        <?php $this->assign('mem', $this->_tpl_vars['tm']->getUser()); ?>
                        <?php if (( $this->_tpl_vars['tm']->getType() == 0 ) || ( $this->_tpl_vars['tm']->getType() == 2 )): ?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['mem']->getNickName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['mem']->getChiName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['mem']->getEngName(); ?>
</td>
                            <td>
                                <?php if ($this->_tpl_vars['tm']->getType() == 0): ?>
                                <?php echo ((is_array($_tmp='Requested')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                <?php elseif ($this->_tpl_vars['tm']->getType() == 2): ?>
                                <?php echo ((is_array($_tmp='Request Rejected')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <button onclick="location='?action=acceptReq&tmId=<?php echo $this->_tpl_vars['tm']->getTmId(); ?>
&ticket=<?php echo $this->_tpl_vars['leaderTicket2']; ?>
'"><?php echo ((is_array($_tmp='Accept')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                                <button onclick="location='?action=rejectReq&tmId=<?php echo $this->_tpl_vars['tm']->getTmId(); ?>
&ticket=<?php echo $this->_tpl_vars['leaderTicket2']; ?>
'"><?php echo ((is_array($_tmp='Reject')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                                <button onclick="location='?action=deleteReq&tmId=<?php echo $this->_tpl_vars['tm']->getTmId(); ?>
&ticket=<?php echo $this->_tpl_vars['leaderTicket2']; ?>
'"><?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
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
                    <table>
                        <tr>
                            <th><?php echo ((is_array($_tmp='NickName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th><?php echo ((is_array($_tmp='Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                            <th>&nbsp;</th>

                        </tr>
                        <button onclick="sendInvitation()"><?php echo ((is_array($_tmp='Send Invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                        <?php $_from = $this->_tpl_vars['TMList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tm']):
?>
                        <?php $this->assign('mem', $this->_tpl_vars['tm']->getUser()); ?>
                        <?php if (( $this->_tpl_vars['tm']->getType() == 1 ) || ( $this->_tpl_vars['tm']->getType() == 3 )): ?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['mem']->getNickName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['mem']->getChiName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['mem']->getEngName(); ?>
</td>
                            <td>
                                <?php if ($this->_tpl_vars['tm']->getType() == 1): ?>
                                <?php echo ((is_array($_tmp='Invited')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                                <?php elseif ($this->_tpl_vars['tm']->getType() == 3): ?>
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
        <div id="tabs-5">
            <table>
                <tr>
                    <th><?php echo ((is_array($_tmp='Organization Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                    <th><?php echo ((is_array($_tmp='Organization creator')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                    <th><?php echo ((is_array($_tmp='Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                    <th>&nbsp;</th>
                </tr>
                <?php $_from = $this->_tpl_vars['ors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['or']):
?>
                <?php $this->assign('org', $this->_tpl_vars['or']->getOrg()); ?>
                <tr>
                    <td><?php echo $this->_tpl_vars['org']->getName(); ?>
</td>
                    <td><?php $this->assign('creater', $this->_tpl_vars['org']->getCreator()); ?><?php echo $this->_tpl_vars['creater']->getNickName(); ?>
</td>
                    <td>
                        <?php if ($this->_tpl_vars['or']->getStatus() == 0): ?>
                        <?php echo ((is_array($_tmp='Requested')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        <?php elseif ($this->_tpl_vars['or']->getStatus() == 2): ?>
                        <?php echo ((is_array($_tmp='Request Rejected')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        <?php endif; ?>
                    </td>
                    <td>
                        <button onclick="location='?action=acceptReqOR&orId=<?php echo $this->_tpl_vars['or']->getInvId(); ?>
'"><?php echo ((is_array($_tmp='Accept')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                        <button onclick="location='?action=rejectReqOR&orId=<?php echo $this->_tpl_vars['or']->getInvId(); ?>
'"><?php echo ((is_array($_tmp='Reject')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                        <button onclick="location='?action=deleteReqOR&orId=<?php echo $this->_tpl_vars['or']->getInvId(); ?>
'"><?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="3">No Records</td>
                </tr>
                <?php endif; unset($_from); ?>
            </table>
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