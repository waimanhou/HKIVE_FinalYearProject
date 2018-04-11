<?php /* Smarty version 2.6.26, created on 2011-05-15 20:10:16
         compiled from it_details.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'it_details.htm', 45, false),array('modifier', 'escape', 'it_details.htm', 114, false),)), $this); ?>
<?php ob_start(); ?>
<script>
        <?php if ($_GET['type'] == 'iframe'): ?>
        if(top==self){
        location="?action=ITdetail&itId=<?php echo $_GET['itId']; ?>
"
    }
        <?php endif; ?>
</script>
<script language="JavaScript" src="./js/jquery.fcbkcomplete.js" type="text/javascript"></script>
<script>
    $(function(){
        $("#tabs").tabs();

        $(".btn").button();

        $("#teamlist").fcbkcomplete({
            json_url: "activity.php?action=getAccountFCBKList",
            addontab: true,
            maxitems: 99999,
            height: 10,
            cache: true,
            filter_case: false
        });
    })
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
<?php $this->_tpl_vars['cssFiles'][] = "./css/fcbkcomplete.css"; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('team', $this->_tpl_vars['it']->getTeam()); ?>
<div class="tabdiv">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1"><?php echo ((is_array($_tmp='Details')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php if ($this->_tpl_vars['team']->getLeaderId() == $_SESSION['userid']): ?>
            <li><a href="#tabs-2"><?php echo ((is_array($_tmp='List Management')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-3"><?php echo ((is_array($_tmp='send Invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php endif; ?>
        </ul>
        <div id="tabs-1">
            <table>
                <tr>
                    <td colspan="2"><b><?php echo ((is_array($_tmp='Attendee List Details')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b></td>
                </tr>
                <tr>
                    <td>List ID:</td>
                    <td><?php echo $this->_tpl_vars['it']->getItId(); ?>
</td>
                </tr>
                <tr>
                    <td>Team:</td>
                    <td><a href="javascript:showTeam(<?php echo $this->_tpl_vars['team']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['team']->getName(); ?>
</a></td>
                </tr>
                <tr>
                    <td>Leader:</td>
                    <?php $this->assign('leader', $this->_tpl_vars['team']->getLeader()); ?>
                    <td><a href="javascript:showAccount(<?php echo $this->_tpl_vars['leader']->getUserId(); ?>
)"><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</a></td>
                </tr>
                <tr>
                    <td>Activity:</td>
                    <?php $this->assign('act', $this->_tpl_vars['it']->getAct()); ?>
                    <td><a href="javascript:showActivity(<?php echo $this->_tpl_vars['act']->getActId(); ?>
)"><?php echo $this->_tpl_vars['act']->getName(); ?>
</a></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <?php if ($this->_tpl_vars['it']->getType() == 0): ?>
                        <?php echo ((is_array($_tmp='Home Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        <?php else: ?>
                        <?php echo ((is_array($_tmp='Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>List Type</td>
                    <td>
                        <?php if ($this->_tpl_vars['it']->getStatus() == 0): ?>
                        PUBLIC (Allow Foreign players)
                        <?php else: ?>
                        PRIVATE (Not Allow Foreign players)
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <?php if ($this->_tpl_vars['it']->getSelected()): ?>
                        SELECTED
                        <?php else: ?>
                        PENDING
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <br><br>

            <table>
                <tr><td colspan="2"><b>Accepted Attendee</b></td></tr>
                <?php $_from = $this->_tpl_vars['iaList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ia']):
?>
                <?php $this->assign('acc', $this->_tpl_vars['ia']->getUser()); ?>
                <?php if ($this->_tpl_vars['ia']->getStatus() == 255): ?>
                <tr>
                    <td>
                        <a href="javascript:showAccount('<?php echo ((is_array($_tmp=$this->_tpl_vars['acc']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')"><?php echo $this->_tpl_vars['acc']->getNickName(); ?>
(<?php echo $this->_tpl_vars['acc']->getLoginName(); ?>
)</a>
                    </td>
                    <td>
                        ACCEPTED
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </table>
        </div>

        <?php if ($this->_tpl_vars['team']->getLeaderId() == $_SESSION['userid']): ?>
        <div id="tabs-2">
            <script>
                function showStatus(status){
                    var s=[];
                    s[0]="<?php echo ((is_array($_tmp='Request Received')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
";
                    s[1]="<?php echo ((is_array($_tmp='Request Sent')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
";
                    s[2]="<?php echo ((is_array($_tmp='Request rejected by leader')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
";
                    s[3]="<?php echo ((is_array($_tmp='Request rejected by user')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
";
                    s[255]="<?php echo ((is_array($_tmp='Accepted')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
";
                    document.write(s[status]);
                }
            </script>
            <table>
                <tr><td colspan="3"><b>Accepted Attendee</b></td></tr>
                <?php $_from = $this->_tpl_vars['iaList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ia']):
?>
                <?php $this->assign('acc', $this->_tpl_vars['ia']->getUser()); ?>
                <?php if ($this->_tpl_vars['ia']->getStatus() == 255): ?>
                <tr>
                    <td>
                        <a href="javascript:showAccount('<?php echo ((is_array($_tmp=$this->_tpl_vars['acc']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')"><?php echo $this->_tpl_vars['acc']->getNickName(); ?>
(<?php echo $this->_tpl_vars['acc']->getLoginName(); ?>
)</a>
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        <input type="button" class="btn" onclick="showSendMsgDialog('<?php echo ((is_array($_tmp=$this->_tpl_vars['acc']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')" value="Send Message">
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <tr><td colspan="3"><hr /></td></tr>
                <tr><td colspan="3"><b>Request Received</b></td></tr>
                <?php $_from = $this->_tpl_vars['iaList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ia']):
?>
                <?php $this->assign('acc', $this->_tpl_vars['ia']->getUser()); ?>
                <?php if ($this->_tpl_vars['ia']->getStatus() == 0 || $this->_tpl_vars['ia']->getStatus() == 2): ?>
                <tr>
                    <td>
                        <a href="javascript:showAccount('<?php echo ((is_array($_tmp=$this->_tpl_vars['acc']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')"><?php echo $this->_tpl_vars['acc']->getNickName(); ?>
(<?php echo $this->_tpl_vars['acc']->getLoginName(); ?>
)</a>
                    </td>
                    <td>
                        <?php if ($this->_tpl_vars['ia']->getStatus() == 0): ?>Request Received<?php else: ?>Request Rejected<?php endif; ?>
                    </td>
                    <td>
                        <input type="button" class="btn" onclick="showSendMsgDialog('<?php echo ((is_array($_tmp=$this->_tpl_vars['acc']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')" value="Send Message">
                        <?php if ($this->_tpl_vars['ia']->getStatus() == 0): ?>
                        <input type="button" class="btn" onclick="location='?action=acceptIa&amp;iaId=<?php echo $this->_tpl_vars['ia']->getIaId(); ?>
'" value="Accept Request">
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>

                <tr><td colspan="3"><hr/></td></tr>
                <tr><td colspan="3"><b>Request Sent</b></td></tr>
                <?php $_from = $this->_tpl_vars['iaList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ia']):
?>
                <?php $this->assign('acc', $this->_tpl_vars['ia']->getUser()); ?>
                <?php if ($this->_tpl_vars['ia']->getStatus() == 1 || $this->_tpl_vars['ia']->getStatus() == 3): ?>
                <tr>
                    <td>
                        <a href="javascript:showAccount('<?php echo ((is_array($_tmp=$this->_tpl_vars['acc']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')"><?php echo $this->_tpl_vars['acc']->getNickName(); ?>
(<?php echo $this->_tpl_vars['acc']->getLoginName(); ?>
)</a>
                    </td>
                    <td>
                        <?php if ($this->_tpl_vars['ia']->getStatus() == 1): ?>Request Sent<?php else: ?>Rejected<?php endif; ?>
                    </td>
                    <td>
                        <input type="button" class="btn" onclick="showSendMsgDialog('<?php echo ((is_array($_tmp=$this->_tpl_vars['acc']->getLoginName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
')" value="Send Message">
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </table>


        </div>
        
        <div id="tabs-3">
            <b><?php echo ((is_array($_tmp='send invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b><br><br>
            <form action="?action=memberInvitation" method="POST">
                <input type="hidden" name="itId" value="<?php echo $this->_tpl_vars['it']->getitId(); ?>
">
                <div class="fcbk">
                    <?php echo ((is_array($_tmp='Member')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:
                    <select id="teamlist" name="memlist">
                    </select>
                </div>
                <br><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:
                <textarea style="width:100%;height:200px" name="msg"></textarea>
                <input type="submit" class="btn" value="<?php echo ((is_array($_tmp='send')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
            </form>
            <br><hr><br>
            <b><?php echo 'Invitations Sent'; ?>
</b><br>
            
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