<?php /* Smarty version 2.6.26, created on 2011-05-15 12:00:40
         compiled from activity_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'activity_detail.htm', 53, false),array('modifier', 'date_format', 'activity_detail.htm', 151, false),array('modifier', 'mbtruncate', 'activity_detail.htm', 175, false),array('modifier', 'escape', 'activity_detail.htm', 175, false),)), $this); ?>
<?php $this->assign('venue', $this->_tpl_vars['activity']->getVenue()); ?>
<?php ob_start(); ?>
<script>
        <?php if ($_GET['type'] == 'iframe'): ?>
        if(top==self){
        location="?action=viewDetail&activityid=<?php echo $this->_tpl_vars['activity']->getActId(); ?>
"
    }
        <?php endif; ?>
</script>
<script language="JavaScript" src="./js/jquery.fcbkcomplete.js" type="text/javascript"></script>
<script>

    var venuePosition=eval("<?php echo $this->_tpl_vars['venue']->getMap(); ?>
")

    if(venuePosition){
        try{
            venuePosition=new google.maps.LatLng(venuePosition[0],venuePosition[1]);
        }catch(e){}
    }
    var map;
    var maker;
    var infowindows;
    $(function() {
        $( "#tabs" ).tabs({
            show: function(u, ui) {
                if (ui.panel.id == "tabs-2") {

                    if(venuePosition){
                        google.maps.event.trigger(map, 'resize');
                        map.setCenter(venuePosition);

                        infowindows.open(map,maker);
                    }
                }
            }
        });

        if(venuePosition){

            map=new google.maps.Map($("#GoogleMap").get(0),{
                zoom: 17,
                center: venuePosition,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            maker=new google.maps.Marker({
                position:venuePosition,
                map: map,
                title:""
            });
    
            infowindows=new google.maps.InfoWindow();
            infowindows.setContent("<div class='infoWin'>"
                +"<?php echo ((is_array($_tmp='Venue name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: <?php echo $this->_tpl_vars['venue']->getFullName(); ?>
<br>"
                +"<?php echo ((is_array($_tmp='Venue abbr')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: <?php echo $this->_tpl_vars['venue']->getAbbrName(); ?>
<br>"
            // +"<?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: "+data.type+"<br>"
                +"<?php echo ((is_array($_tmp='tel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: <?php echo $this->_tpl_vars['venue']->getTel(); ?>
<br>"
                +"<?php echo ((is_array($_tmp='address')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: <?php echo $this->_tpl_vars['venue']->getAddress(); ?>
<br>"
                +"</div>");
            infowindows.open(map,maker);
            $("#GoogleMapResizer").resizable(
            {
                helper: "ui-resizable-helper",
                stop: function(e,u){
                    google.maps.event.trigger(map, 'resize');
                }

            });
        }
        $( "#nonaccordion" ).togglePanel()/*.accordion({
            autoHeight: false,
            navigation: true
        });*/

        $("#submit_btn").button();

        $(".btn").button();

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
    #GoogleMap{
        width:100%;
        height:100%;
    }
    #GoogleMapResizer{
        width: 100%; height: 380px; padding: 0.5em;
    }

    .r0{
        background:#cff;
    }
    .r1{
        background:#fcf;
    }

    .ui-resizable-helper { border: 2px dotted gray; }

    <?php if ($_GET['type'] == 'iframe'): ?>
    .header{display:none}
    body{
        background-color:transparent !important;
    }
    <?php endif; ?>
</style>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $this->_tpl_vars['cssFiles'][] = "./css/fcbkcomplete.css"; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('owner', $this->_tpl_vars['activity']->getOwner()); ?>
<h2 class="header"><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 #<?php echo $this->_tpl_vars['activity']->getActId(); ?>
</h2>

<div class="tabdiv">

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1"><?php echo ((is_array($_tmp='Details')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-2"><?php echo ((is_array($_tmp='Map')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-3"><?php echo ((is_array($_tmp="Q&amp;A")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-4"><?php echo ((is_array($_tmp='Apply Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php if ($this->_tpl_vars['owner']->getUserId() == $_SESSION['userId']): ?>
            <li><a href="#tabs-5"><?php echo ((is_array($_tmp='Select Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-6"> <?php echo ((is_array($_tmp='Send Invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <li><a href="#tabs-7"> <?php echo ((is_array($_tmp='Cancel Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></li>
            <?php endif; ?>
        </ul>
        <div id="tabs-1"> <!--Activity Details-->
            <table>
                <tr>
                    <td colspan="2"><b><?php echo ((is_array($_tmp='Activity Creator Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                <tr>
                    <td valign="top"><?php echo ((is_array($_tmp='Activity Creator')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><a href="javascript:showAccount('<?php echo $this->_tpl_vars['owner']->getLoginName(); ?>
')"><?php echo $this->_tpl_vars['owner']->getNickName(); ?>
 (<?php echo $this->_tpl_vars['owner']->getLoginName(); ?>
)</a></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Credit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</td><td><a href="#"><?php echo $this->_tpl_vars['owner']->getCredit(); ?>
<!--(正面評價百分比:100%)--></a></td></tr>
            </table>
            <br/>
            <table>
                <tr><td valign="top"><b><?php echo ((is_array($_tmp='Activity Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='activityname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['activity']->getName(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['venue']->getTypeStr(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Date')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getEndTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Venue')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><a href="#" onclick="$('#tabs').tabs('select',1)"><?php echo $this->_tpl_vars['venue']->getFullName(); ?>
</a></td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='player per team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='X Players')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getPlayerPerTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getPlayerPerTeam())); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='requiredTeam')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='X Teams')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getRequiredTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getRequiredTeam())); ?>
</td></tr>
                <!--tr><td valign="top"><?php echo ((is_array($_tmp='requestedTeam')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='X Teams')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getRequestedTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getRequestedTeam())); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='acceptedTeam')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='X Teams')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getAcceptedTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getAcceptedTeam())); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='Permit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><a href="" ><img src="images/icon_doc.jpg"></a></td></tr-->
                <tr><td valign="top"><?php echo ((is_array($_tmp='other info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['activity']->getOtherInfo(); ?>
</td></tr>
                <tr><td valign="top"><?php echo ((is_array($_tmp='status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php if ($this->_tpl_vars['activity']->getStatus() == 1): ?><?php echo ((is_array($_tmp='OPEN')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php elseif ($this->_tpl_vars['activity']->getStatus() == 0): ?><?php echo ((is_array($_tmp='CLOSED')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php else: ?><font color="red" size="5">CANCELLED</font><?php endif; ?></td></tr>
            </table>
        </div>
        <div id="tabs-2"> <!--Google Map-->
            <div id="GoogleMapResizer" class="ui-widget-content">
                <div id="GoogleMap"><?php echo ((is_array($_tmp='Map is temporary unavailable')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</div>
            </div>
        </div>
        <div id="tabs-3">


            <div id="nonaccordion">
                <?php $this->assign('qa', $this->_tpl_vars['activity']->getQA()); ?>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['qa']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <?php $this->assign('asker', $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getUser()); ?>
                <h3><a href="#section<?php echo $this->_sections['i']['index']; ?>
"><?php echo $this->_sections['i']['index']+1; ?>
. <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQuestion())) ? $this->_run_mod_handler('mbtruncate', true, $_tmp, 40) : smarty_modifier_mbtruncate($_tmp, 40)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQTime(); ?>
)</a></h3>
                <div>
                    <b><?php echo ((is_array($_tmp='Question')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQuestion())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br>
                    <?php echo ((is_array($_tmp='Asker')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<?php echo $this->_tpl_vars['asker']->getNickName(); ?>
 (<?php echo ((is_array($_tmp='LoginName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<a href="javascript:showAccount('<?php echo $this->_tpl_vars['asker']->getLoginName(); ?>
')"><?php echo $this->_tpl_vars['asker']->getLoginName(); ?>
</a>, <?php echo ((is_array($_tmp='Credit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<?php echo $this->_tpl_vars['asker']->getCredit(); ?>
)<br>
                    (<?php echo $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQTime(); ?>
)
                    <br><br><b><?php echo ((is_array($_tmp='Reply')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b><br>
                    <?php if ($this->_tpl_vars['qa'][$this->_sections['i']['index']]->getAnswer()): ?>
                    <?php echo $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getAnswer(); ?>
<br>(<?php echo $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getATime(); ?>
)
                    <?php else: ?>
                    <?php if ($this->_tpl_vars['owner']->getUserId() == $_SESSION['userId']): ?>
                    <form action="?action=answer" method="post">
                        <input type="hidden" name="qaId" value="<?php echo $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQaId(); ?>
">
                        <textarea name="answer" style="width: 90%" rows="3"></textarea><br>
                        <input type="submit" class="btn" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" />
                    </form>
                    <?php else: ?>
                    <?php echo ((is_array($_tmp='not replied')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php endfor; else: ?>
                <h3><a href="#"><?php echo ((is_array($_tmp="No questions or answers have been posted about this activity.")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div><?php echo ((is_array($_tmp="No questions or answers have been posted about this activity.")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</div>
                <?php endif; ?>
                <?php if ($_SESSION['userid'] && $this->_tpl_vars['activity']->getStatus() == 1): ?>
                <h3><a href="#sectionx"><?php echo ((is_array($_tmp='Post Question')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
                <div>
                    <form action="?action=ask" method="post">
                        <input type="hidden" name="actId" value="<?php echo $this->_tpl_vars['activity']->getActId(); ?>
">
                        <input type="hidden" name="askTicket" value="<?php echo $this->_tpl_vars['askTicket']; ?>
">
                        <textarea style="width:90%" rows="5" name="question"></textarea><br />
                        <input type="submit" id="submit_btn" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" />
                    </form>
                </div>
                <?php endif; ?>
            </div>


            <!--
            <br><br>
                <?php echo ((is_array($_tmp='Post Question')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                <textarea style="width:100%" rows="5"></textarea>
            -->
        </div>
        <div id="tabs-4">
            <center>
                <form action="">
                    <!--召集人團隊-->
                    <b><u><?php echo ((is_array($_tmp='Home Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</u></b>
                    <table border="0" cellpadding="10" align="center">
                        <tr><th>&nbsp;</th><th><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='No of Player')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th>&nbsp;</th></tr>
                        <!--tr><td><a href="#">TeamX</a></td><td><a href="#">Peter1010(23)</a></td><td>7/9</td><td>需要召集人邀請</td></tr-->
                        <?php $_from = $this->_tpl_vars['hometeamary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n']):
?>
                        <?php $this->assign('it', $this->_tpl_vars['n']['0']); ?>
                        <?php $this->assign('t', $this->_tpl_vars['it']->getTeam()); ?>
                        <?php $this->assign('count', $this->_tpl_vars['n']['1']); ?>
                        <?php $this->assign('leader', $this->_tpl_vars['t']->getLeader()); ?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['t']->showLogoHTML(32); ?>
</td>
                            <td><a href="javascript:showTeam(<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['t']->getName(); ?>
</a></td>
                            <td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
                            <!--td><?php echo $this->_tpl_vars['count']; ?>
/<?php echo $this->_tpl_vars['activity']->getPlayerPerTeam(); ?>
</td-->
                            <!---->
                            <td><?php echo $this->_tpl_vars['it']->getNoOfPlayer(); ?>
</td>
                            <td>
                                <input type="button" class="btn" value='<?php echo ((is_array($_tmp='Attendee List')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
' onclick="showAttendeeList(<?php echo $this->_tpl_vars['it']->getItId(); ?>
)">
                                <input type="button" class="btn" value='<?php echo ((is_array($_tmp='join')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
' onClick='location="?action=joinIT&ItId=<?php echo $this->_tpl_vars['it']->getItId(); ?>
"' <?php if ($this->_tpl_vars['it']->getSelected()): ?>disabled<?php endif; ?>>
                            </td>
                            <!--td>
                                <?php if ($this->_tpl_vars['t']->getType() == 0): ?>
                                <input type="button" value="Join" onclick="showTeam(<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
)">
                                <?php elseif ($this->_tpl_vars['it']->getStatus() == 1): ?>
                                (Join by invitation only)
                                <?php else: ?>
                                (SELECTED)
                                <?php endif; ?>
                            </td-->
                        </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </table>
                    <?php if ($this->_tpl_vars['owner']->getUserId() == $_SESSION['userId']): ?>
                    <input type="button" class="btn" value="<?php echo ((is_array($_tmp='Add Your Home Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="location='?action=newteam&type=home&actId=<?php echo $this->_tpl_vars['activity']->getActId(); ?>
'">
                    <?php endif; ?>
                    <br><br>
                    <!--已報名團隊-->
                    <b><u><?php echo ((is_array($_tmp='Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</u></b>
                    <table border="0" cellpadding="10" align="center">
                        <tr><th>&nbsp;</th><th><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='No of Player')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th>&nbsp;</th><th>&nbsp;</th></tr>
                        <!--tr><td><a href="ViewAppliedTeam.html">TeamA</a></td><td><a href="#">JohnLee(2)</a></td><td>1/5</td><td><input type="button" value="申請加入" onclick=join('TeamA');></td></tr-->
                        <?php $_from = $this->_tpl_vars['guestteamary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n']):
?>
                        <?php $this->assign('it', $this->_tpl_vars['n']['0']); ?>
                        <?php if ($this->_tpl_vars['it']->getStatus() < 2): ?>
                        <?php $this->assign('t', $this->_tpl_vars['it']->getTeam()); ?>
                        <?php $this->assign('count', $this->_tpl_vars['n']['1']); ?>
                        <?php $this->assign('leader', $this->_tpl_vars['t']->getLeader()); ?>
                        <tr>

                            <td><?php echo $this->_tpl_vars['t']->showLogoHTML(32); ?>
</td>
                            <td><a href="javascript:showTeam(<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['t']->getName(); ?>
</a></td>
                            <td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
                            <td><?php echo $this->_tpl_vars['t']->getNoOfPlayer(); ?>
/<?php echo $this->_tpl_vars['activity']->getPlayerPerTeam(); ?>
</td>
                            <td>
                                <input type="button" class="btn" value='<?php echo ((is_array($_tmp='Attendee List')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
' onclick="showAttendeeList(<?php echo $this->_tpl_vars['it']->getItId(); ?>
)">
                            </td>
                            <td>
                                <input type="button" class="btn" onClick='location="?action=joinIT&ItId=<?php echo $this->_tpl_vars['it']->getItId(); ?>
"'  <?php if ($this->_tpl_vars['it']->getSelected()): ?>disabled  value='<?php echo ((is_array($_tmp='SELECTED')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
'<?php else: ?> value='<?php echo ((is_array($_tmp='join')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
'<?php endif; ?>>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </table>
                    <?php if ($_SESSION['userid']): ?>
                    <input type="button" class="btn" value="<?php echo ((is_array($_tmp='Become Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="location='?action=newteam&type=away&actId=<?php echo $this->_tpl_vars['activity']->getActId(); ?>
'">
                    <?php endif; ?>
                </form>

            </center>

        </div>

        <?php if ($this->_tpl_vars['owner']->getUserId() == $_SESSION['userId']): ?>
        <div id="tabs-5">
            <center>
                <b><u><?php echo ((is_array($_tmp='Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</u></b>
                <table border="0" cellpadding="10" align="center">
                    <tr><th>&nbsp;</th><th><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='No of Player')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th></th></tr>
                    <!--tr><td><a href="ViewAppliedTeam.html">TeamA</a></td><td><a href="#">JohnLee(2)</a></td><td>1/5</td><td><input type="button" value="申請加入" onclick=join('TeamA');></td></tr-->
                    <?php $_from = $this->_tpl_vars['guestteamary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n']):
?>
                    <?php $this->assign('it', $this->_tpl_vars['n']['0']); ?>
                    <?php if ($this->_tpl_vars['it']->getStatus() < 2): ?>
                    <?php $this->assign('t', $this->_tpl_vars['it']->getTeam()); ?>
                    <?php $this->assign('count', $this->_tpl_vars['n']['1']); ?>
                    <?php $this->assign('leader', $this->_tpl_vars['t']->getLeader()); ?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['t']->showLogoHTML(); ?>
</td>
                        <td><a href="javascript:showTeam(<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['t']->getName(); ?>
</a></td>
                        <td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
                        <td><?php echo $this->_tpl_vars['t']->getNoOfPlayer(); ?>
/<?php echo $this->_tpl_vars['activity']->getPlayerPerTeam(); ?>
</td>
                        <td>
                            <?php if ($this->_tpl_vars['it']->getSelected()): ?>
                            SELECTED
                            <?php else: ?>
                            <a href="?action=acceptIt&itId=<?php echo $this->_tpl_vars['it']->getItId(); ?>
">Accept</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </table>

            </center>
        </div>
        <div id="tabs-6">
            <b><?php echo ((is_array($_tmp='send invitation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b><br><br>
            <form action="?action=invitation" method="POST">
                <input type="hidden" name="actId" value="<?php echo $this->_tpl_vars['activity']->getActId(); ?>
">
                <div class="fcbk">
                    <?php echo ((is_array($_tmp='Teams')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:
                    <select id="teamlist" name="teamlist">
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
            <table border="0" cellpadding="10">
                <tr><th>&nbsp;</th><th><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='No of Player')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th></th></tr>
                <!--tr><td><a href="ViewAppliedTeam.html">TeamA</a></td><td><a href="#">JohnLee(2)</a></td><td>1/5</td><td><input type="button" value="申請加入" onclick=join('TeamA');></td></tr-->
                <?php $_from = $this->_tpl_vars['guestteamary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n']):
?>
                <?php $this->assign('it', $this->_tpl_vars['n']['0']); ?>
                <?php if ($this->_tpl_vars['it']->getStatus() >= 2): ?>
                <?php $this->assign('t', $this->_tpl_vars['it']->getTeam()); ?>
                <?php $this->assign('count', $this->_tpl_vars['n']['1']); ?>
                <?php $this->assign('leader', $this->_tpl_vars['t']->getLeader()); ?>
                <tr>
                    <td><?php echo $this->_tpl_vars['t']->showLogoHTML(); ?>
</td>
                    <td><a href="javascript:showTeam(<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['t']->getName(); ?>
</a></td>
                    <td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
                    <td>
                        <?php if ($this->_tpl_vars['it']->getStatus() == 2): ?>
                        <?php echo ((is_array($_tmp='INVITED')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        <?php else: ?>
                        <?php echo ((is_array($_tmp='REJECTED')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </table>
        </div>
        <div id="tabs-7">
            <form method="POST" action="?action=cancel">
                <input type="hidden" name="actId" value="<?php echo $this->_tpl_vars['activity']->getActId(); ?>
">
                <b><?php echo ((is_array($_tmp='Cancel this activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b><br>
                <br><?php echo ((is_array($_tmp="This operation cannot be undone. Would you like to proceed?")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

                <br><br>
                <input type="submit" class="btn" value="Yes">
                <input type="button" class="btn" value="No" onclick="location='activity.php?action=viewDetail&type=iframe&activityid=<?php echo $this->_tpl_vars['activity']->getActId(); ?>
'">
            </form>
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