<?php /* Smarty version 2.6.26, created on 2011-05-13 15:52:37
         compiled from account_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'account_detail.htm', 47, false),array('modifier', 'escape', 'account_detail.htm', 60, false),)), $this); ?>
<?php ob_start(); ?>
<script>
        <?php if ($_GET['type'] == 'iframe'): ?>
        if(top==self){
        location="?loginName=<?php echo $this->_tpl_vars['account']->getloginName(); ?>
"
    }
        <?php endif; ?>
</script>
<script>
    $(function() {
        $("#tabs").tabs({
        });
        $("#oldPassword").change(
        function(o){
            if($("#oldPassword").val()==""){
                $("#submit_btn").attr("disabled", true);
                $("#plz_fill_in_pw").show();
            }else{
                $("#submit_btn").attr("disabled", false);
                $("#plz_fill_in_pw").hide();
            }
        });
    });
</script>
<style>
    <?php if ($_GET['type'] == 'iframe'): ?>
    .header{display:none}
    body{
        background-color:transparent !important;
    }
    <?php endif; ?>
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
            <li><a href="#tabs-1"><?php echo ((is_array($_tmp='Details')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-2"><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-3"><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-4"><?php echo ((is_array($_tmp='Comment')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php if ($this->_tpl_vars['isYou']): ?><li><a href="#tabs-5"><?php echo ((is_array($_tmp='Edit Your Details')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li><?php endif; ?>
            <?php if ($this->_tpl_vars['isYou']): ?><li><a href="#tabs-6"><?php echo ((is_array($_tmp='Invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li><?php endif; ?>
        </ul>
        <div id="tabs-1"><!--Account Details-->
            <img src="<?php echo $this->_tpl_vars['account']->getPhotoPath(128); ?>
" align="right">
            <table>
                <tr><td colspan="2"><b><?php echo ((is_array($_tmp='Account Detail')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='loginname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo $this->_tpl_vars['account']->getLoginName(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo $this->_tpl_vars['account']->getnickName(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='email')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['account']->getEmail())) ? $this->_run_mod_handler('escape', true, $_tmp, 'mail') : smarty_modifier_escape($_tmp, 'mail')); ?>
</td></tr>
                <tr><td valign="top"><hr></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='point')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo $this->_tpl_vars['account']->getPoint(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='credit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo $this->_tpl_vars['account']->getCredit(); ?>
</td></tr>
                <tr><td valign="top"><hr></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='lastlogin')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><?php echo $this->_tpl_vars['account']->getLastLogin(); ?>
</td></tr>
            </table>
        </div>
        <div id="tabs-2">
            <b><?php echo ((is_array($_tmp='Your Teams')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b>
            <ul>
                <?php $_from = $this->_tpl_vars['leaderteams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
                <li><a href="javascript:showTeam(<?php echo $this->_tpl_vars['m']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['m']->getName(); ?>
</a><?php if ($this->_tpl_vars['m']->getOrgId()): ?> <?php $this->assign('o', $this->_tpl_vars['m']->getOrg()); ?>( <a href="javascript:showOrg(<?php echo $this->_tpl_vars['o']->getOrgId(); ?>
)"><?php echo $this->_tpl_vars['o']->getName(); ?>
</a> )<?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
            <b><?php echo ((is_array($_tmp='Team you belong to')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b>
            <ul>
                <?php $_from = $this->_tpl_vars['teamMembers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
                <?php $this->assign('n', $this->_tpl_vars['m']->getTeam()); ?>
                <li><a href="javascript:showTeam(<?php echo $this->_tpl_vars['n']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['n']->getName(); ?>
</a><?php if ($this->_tpl_vars['n']->getOrgId()): ?> <?php $this->assign('o', $this->_tpl_vars['n']->getOrg()); ?>( <a href="javascript:showOrg(<?php echo $this->_tpl_vars['o']->getOrgId(); ?>
)"><?php echo $this->_tpl_vars['o']->getName(); ?>
</a> )<?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
        <div id="tabs-3">
            <b><?php echo ((is_array($_tmp='Created Activities')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b>
            <ul>
                <?php $_from = $this->_tpl_vars['createdActivities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
                <li><a href="javascript:showActivity(<?php echo $this->_tpl_vars['m']->getActId(); ?>
)"><?php echo $this->_tpl_vars['m']->getName(); ?>
</a>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
            <b><?php echo ((is_array($_tmp='Joined Activities')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b>
            <ul>
                <?php $_from = $this->_tpl_vars['involveaccount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
                <?php $this->assign('n', $this->_tpl_vars['m']->getIt()); ?>
                <?php $this->assign('n', $this->_tpl_vars['n']->getAct()); ?>

                <li><a href="javascript:showActivity(<?php echo $this->_tpl_vars['n']->getActId(); ?>
)"><?php echo $this->_tpl_vars['n']->getName(); ?>
</a>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
        <div id="tabs-4">
            <b><?php echo ((is_array($_tmp='This user have')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 <?php echo $this->_tpl_vars['comment']->getLastCount(); ?>
 <?php echo ((is_array($_tmp="comment(s)")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>
            <ul>
                <?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
                <li>
                    <p>
                        <?php if ($this->_tpl_vars['m']->getValue() == -1): ?>
                        <span style='color:#bb0000;font-weight:bold'><?php echo ((is_array($_tmp='Negative')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 </span>
                        <?php elseif ($this->_tpl_vars['m']->getValue() == 0): ?>
                        <span style='color:#000000;font-weight:bold'><?php echo ((is_array($_tmp='Neutral')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 </span>
                        <?php else: ?>
                        <span style='color:#00bb00;font-weight:bold'><?php echo ((is_array($_tmp='positive')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 </span>
                        <?php endif; ?>------
                        <b><?php echo ((is_array($_tmp='Appraiser')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:<?php $this->assign('f', $this->_tpl_vars['m']->getFrom()); ?><span><?php echo $this->_tpl_vars['f']->getNickName(); ?>
(<a href="javascript:showAccount('<?php echo $this->_tpl_vars['f']->getLoginName(); ?>
')"><?php echo $this->_tpl_vars['f']->getLoginName(); ?>
</a></span>)
                        <b><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:<?php $this->assign('a', $this->_tpl_vars['m']->getAct()); ?><span><a href="javascript:showActivity(<?php echo $this->_tpl_vars['a']->getActId(); ?>
)"><?php echo $this->_tpl_vars['a']->getName(); ?>
</a></span>-----<?php echo $this->_tpl_vars['m']->getCREATED(); ?>
<br />
                        <b><?php echo ((is_array($_tmp='Feedback')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b>:<span><?php echo $this->_tpl_vars['m']->getComment(); ?>
</span>
                    </p>
                </li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
        <?php if ($this->_tpl_vars['isYou']): ?>
        <div id="tabs-5">
            <form action="?action=save" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="ticket" value="<?php echo $this->_tpl_vars['ticket']; ?>
">
                <table>
                    <tr>
                        <td><?php echo ((is_array($_tmp='Current Password')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
                        <td><input type="password" name="oldPassword" id="oldPassword"> (<?php echo ((is_array($_tmp="Please fill in the current password if you want to change any setting(s)")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='UserID')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo $this->_tpl_vars['account']->getUserId(); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='loginName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['account']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='ChiName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['account']->getChiName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='EngName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['account']->getEngName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='HKID')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo $this->_tpl_vars['account']->getFormattedHKID(); ?>
 (<?php echo ((is_array($_tmp="to change, please contact us")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='Email address')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['account']->getEmail())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 (<?php echo ((is_array($_tmp="to change, please contact us")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='Point')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo $this->_tpl_vars['account']->getPoint(); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='Credit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo $this->_tpl_vars['account']->getCredit(); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo ((is_array($_tmp='New Password')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
                        <td><input type="password" name="newPassword" value="">(<?php echo ((is_array($_tmp="Please leave blank if you don't want to change password")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td>
                    </tr>
                    <tr>
                        <td><?php echo ((is_array($_tmp='Confirm New Password')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td>
                        <td><input type="password" name="newPassword2" value="">(<?php echo ((is_array($_tmp="Please leave blank if you don't want to change password")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='NickName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <input type="text" name="nickname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['account']->getNickName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='Tel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>

                            <input type="text" name="tel1" value="<?php echo $this->_tpl_vars['account']->getTel1(); ?>
">,
                            <input type="text" name="tel2" value="<?php echo $this->_tpl_vars['account']->getTel2(); ?>
">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='LastLogin')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo $this->_tpl_vars['account']->getLastLogin(); ?>


                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ((is_array($_tmp='LastIP')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        </td>
                        <td>
                            <?php echo $this->_tpl_vars['account']->getLastIp(); ?>

                        </td>
                    </tr>
                     <tr><td><?php echo ((is_array($_tmp='Photo')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td>    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /><input type="file" name="photo"></td></tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" disabled id="submit_btn"><span id="plz_fill_in_pw">(<?php echo ((is_array($_tmp='Please fill in the current password')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
)</span></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="tabs-6">
        <table>
            <tr>
                <th><?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                <th><?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                <th><?php echo ((is_array($_tmp='Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th>
                <th>&nbsp;</th>
            </tr>
            <?php $_from = $this->_tpl_vars['its']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?>
            <?php $this->assign('team', $this->_tpl_vars['it']->getTeam()); ?>
            <tr>
                <td><?php echo $this->_tpl_vars['team']->getName(); ?>
</td>
                <td><?php $this->assign('leader', $this->_tpl_vars['team']->getLeader()); ?><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
                <td>
                    <?php if ($this->_tpl_vars['it']->getType() == 1): ?>
                    <?php echo ((is_array($_tmp='Requested')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                    <?php elseif ($this->_tpl_vars['it']->getType() == 3): ?>
                    <?php echo ((is_array($_tmp='Request Rejected')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                    <?php endif; ?>
                </td>
                <td>
                    <button onclick="location='?action=acceptReq&tmId=<?php echo $this->_tpl_vars['it']->getTmId(); ?>
'">Accept</button>
                    <button onclick="location='?action=rejectReq&tmId=<?php echo $this->_tpl_vars['it']->getTmId(); ?>
'">Reject</button>
                    <button onclick="location='?action=deleteReq&tmId=<?php echo $this->_tpl_vars['it']->getTmId(); ?>
'">Delete</button>
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