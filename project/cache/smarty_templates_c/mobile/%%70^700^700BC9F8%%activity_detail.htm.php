<?php /* Smarty version 2.6.26, created on 2011-05-07 22:30:50
         compiled from activity_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'activity_detail.htm', 20, false),array('modifier', 'date_format', 'activity_detail.htm', 53, false),array('modifier', 'replace', 'activity_detail.htm', 61, false),array('modifier', 'mbtruncate', 'activity_detail.htm', 98, false),array('modifier', 'escape', 'activity_detail.htm', 98, false),)), $this); ?>
<?php ob_start(); ?>
<script>
	function ansQuestion(){
		$.post("activity?action=answer", $("#answer_form").serialize());
		location.reload();
	}
	function askQuestion(){
		$.post("activity.php?action=ask", $("#question_form").serialize());
		location.reload();
	}
	function showTeam(teamid){
		window.location='team.php?action=viewDetail&teamId='+teamid;
	}
</script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('owner', $this->_tpl_vars['activity']->getOwner()); ?>
<div data-role="page" id="activity_info">
	<div data-role="header" class="h">
		<h1><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="activity.php" data-icon="forward" rel=external>Back</a>
	</div><!-- /header -->
			
	<div data-role="content" align="center">
		<div id="header_1"></div>
		<table>
			<tr><td width="15%" colspan="2"><h3><b><?php echo ((is_array($_tmp='Activity Creator Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></h3></td></tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='Activity Creator')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b></td>
				<td><a href="javascript:showAccount('<?php echo $this->_tpl_vars['owner']->getLoginName(); ?>
')"><?php echo $this->_tpl_vars['owner']->getNickName(); ?>
 (<?php echo $this->_tpl_vars['owner']->getLoginName(); ?>
)</a></td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='Credit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:</b></td>
				<td><a href="#"><?php echo $this->_tpl_vars['owner']->getCredit(); ?>
<!--(正面評價百分比:100%)--></a></td>
			</tr>
		</table>
		
		<table>
			<?php $this->assign('venue', $this->_tpl_vars['activity']->getVenue()); ?>
			<tr>
				<td width="15%" colspan="4"><h3><b><?php echo ((is_array($_tmp='Activity Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></h3>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='activityname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php echo $this->_tpl_vars['activity']->getName(); ?>
</td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php echo $this->_tpl_vars['venue']->getTypeStr(); ?>
</td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='Date')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='Time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getStartTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getEndTime())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='Venue')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><a href="http://maps.google.com.hk/maps?q=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['venue']->getMap())) ? $this->_run_mod_handler('replace', true, $_tmp, "[", "(") : smarty_modifier_replace($_tmp, "[", "(")))) ? $this->_run_mod_handler('replace', true, $_tmp, "]", ")") : smarty_modifier_replace($_tmp, "]", ")")); ?>
" onclick="$('#tabs').tabs('select',1)"><?php echo $this->_tpl_vars['venue']->getFullName(); ?>
</a></td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='player per team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php echo ((is_array($_tmp='X Players')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getPlayerPerTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getPlayerPerTeam())); ?>
</td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='requiredTeam')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php echo ((is_array($_tmp='X Teams')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getRequiredTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getRequiredTeam())); ?>
</td>
			</tr>
			<!--tr><td><?php echo ((is_array($_tmp='requestedTeam')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='X Teams')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getRequestedTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getRequestedTeam())); ?>
</td></tr>
			<tr><td><?php echo ((is_array($_tmp='acceptedTeam')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><?php echo ((is_array($_tmp='X Teams')) ? $this->_run_mod_handler('lang', true, $_tmp, $this->_tpl_vars['activity']->getAcceptedTeam()) : smarty_modifier_lang($_tmp, $this->_tpl_vars['activity']->getAcceptedTeam())); ?>
</td></tr>
			<tr><td><?php echo ((is_array($_tmp='Permit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</td><td><a href="" ><img src="images/icon_doc.jpg"></a></td></tr-->
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='other info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php echo $this->_tpl_vars['activity']->getOtherInfo(); ?>
</td>
			</tr>
			<tr align="left">
				<td><b><?php echo ((is_array($_tmp='status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></td>
				<td><?php if ($this->_tpl_vars['activity']->getStatus()): ?><?php echo ((is_array($_tmp='OPEN')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='CLOSED')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<?php endif; ?></td>
			</tr>
        </table>
		<div><button type="submit" data-theme="c" onclick="location='./'" rel=external data-inline="true"><?php echo ((is_array($_tmp='Apply')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</button></div>
	</div>
</div>
<div data-role="page" id="activity_QA">
	<div data-role="header" class="h">
		<h1><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="activity.php" data-icon="forward" rel=external>Back</a>
	</div><!-- /header -->
	<div data-role="content">
		<div id="header_2"></div>
		<?php $this->assign('qa', $this->_tpl_vars['activity']->getQA()); ?>
		<div data-role="collapsible-set" class="ui-collapsible-set">
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
				<div data-role="collapsible" data-state="collapsed" data-collapsed="true">
					<?php $this->assign('asker', $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getUser()); ?>
					<h3 style="font-size:13px;"><a href="#section<?php echo $this->_sections['i']['index']; ?>
"><?php echo $this->_sections['i']['index']+1; ?>
. <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQuestion())) ? $this->_run_mod_handler('mbtruncate', true, $_tmp, 40) : smarty_modifier_mbtruncate($_tmp, 40)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a><span class="ui-li-aside" style="font-size:10px;">(<?php echo $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQTime(); ?>
)</span></h3>
					<p>
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
								<form action="" method="post" id="answer_form">
									<input type="hidden" name="qaId" value="<?php echo $this->_tpl_vars['qa'][$this->_sections['i']['index']]->getQaId(); ?>
">
									<textarea name="answer"></textarea><br>
									<input type="submit" class="btn" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="ansQuestion();"/>
								</form>
							<?php else: ?>
								<?php echo ((is_array($_tmp='not replied')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

							<?php endif; ?>
						<?php endif; ?>
					</p>
				</div>
				<?php endfor; else: ?>
				<div data-role="collapsible" data-state="collapsed" data-collapsed="true">
					<h3 style="font-size:13px;"><a href="#"><?php echo ((is_array($_tmp="No questions or answers have been posted about this activity.")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
					<p><?php echo ((is_array($_tmp="No questions or answers have been posted about this activity.")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</p>
				</div>
			<?php endif; ?>	
		</div>

		<?php if ($_SESSION['userid'] && $this->_tpl_vars['activity']->getStatus() == 1): ?>
			<div data-role="collapsible-set" class="ui-collapsible-set">
				<div data-role="collapsible" data-state="collapsed" data-collapsed="true">
					<h3 style="font-size:13px;"><a href="#sectionx"><?php echo ((is_array($_tmp='Post Question')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></h3>
					<p>
						<div align="center">
							<form action="#" method="post" id="question_form">
								<input type="hidden" name="actId" value="<?php echo $this->_tpl_vars['activity']->getActId(); ?>
">
								<input type="hidden" name="askTicket" value="<?php echo $this->_tpl_vars['askTicket']; ?>
">
								<textarea name="question" width="100%"></textarea><br />
								<input type="submit" id="submit_btn" value="<?php echo ((is_array($_tmp='submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="askQuestion();"/>
							</form>
						</div>
					</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<div data-role="page" id="apply_status">
	<div data-role="header" class="h">
		<h1><?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="activity.php" data-icon="forward" rel=external>Back</a>
	</div><!-- /header -->
	<div data-role="content" align="center">
		<div id="header_3"></div>
		<form action="">
			<!--召集人團隊-->
			<b><u><?php echo ((is_array($_tmp='Home Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</u></b>
			<table border="0" cellpadding="10" align="center">
				<tr><th><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='No of Player')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th></th></tr>
				<!--tr><td><a href="#">TeamX</a></td><td><a href="#">Peter1010(23)</a></td><td>7/9</td><td>需要召集人邀請</td></tr-->
				<?php $_from = $this->_tpl_vars['hometeamary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n']):
?>
				<?php $this->assign('it', $this->_tpl_vars['n']['0']); ?>
				<?php $this->assign('t', $this->_tpl_vars['it']->getTeam()); ?>
				<?php $this->assign('count', $this->_tpl_vars['n']['1']); ?>
				<?php $this->assign('leader', $this->_tpl_vars['t']->getLeader()); ?>
				<tr>
					<td><a href="javascript:showTeam(<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['t']->getName(); ?>
</a></td>
					<td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
					<!--td><?php echo $this->_tpl_vars['count']; ?>
/<?php echo $this->_tpl_vars['activity']->getPlayerPerTeam(); ?>
</td-->
					<td><?php echo $this->_tpl_vars['t']->getNoOfPlayer(); ?>
/<?php echo $this->_tpl_vars['activity']->getPlayerPerTeam(); ?>
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
			<input type="button" data-inline="true" class="btn" value="<?php echo ((is_array($_tmp='Add Your Home Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="location='?action=newteam&type=home&actId=<?php echo $this->_tpl_vars['activity']->getActId(); ?>
'">
			<?php endif; ?>
			<br><br>
			<!--已報名團隊-->
			<b><u><?php echo ((is_array($_tmp='Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</u></b>
			<table border="0" cellpadding="10" align="center">
				<tr><th><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th><?php echo ((is_array($_tmp='No of Player')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</th><th></th></tr>
				<!--tr><td><a href="ViewAppliedTeam.html">TeamA</a></td><td><a href="#">JohnLee(2)</a></td><td>1/5</td><td><input type="button" value="申請加入" onclick=join('TeamA');></td></tr-->
				<?php $_from = $this->_tpl_vars['guestteamary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n']):
?>
				<?php $this->assign('it', $this->_tpl_vars['n']['0']); ?>
				<?php $this->assign('t', $this->_tpl_vars['it']->getTeam()); ?>
				<?php $this->assign('count', $this->_tpl_vars['n']['1']); ?>
				<?php $this->assign('leader', $this->_tpl_vars['t']->getLeader()); ?>
				<tr>
					<td><a href="javascript:showTeam(<?php echo $this->_tpl_vars['t']->getTeamId(); ?>
)"><?php echo $this->_tpl_vars['t']->getName(); ?>
</a></td>
					<td><?php echo $this->_tpl_vars['leader']->getNickName(); ?>
</td>
					<td><?php echo $this->_tpl_vars['t']->getNoOfPlayer(); ?>
/<?php echo $this->_tpl_vars['activity']->getPlayerPerTeam(); ?>
</td>
					<td>
						<?php if ($this->_tpl_vars['it']->getStatus() == 2): ?>
						SELECTED
						<?php endif; ?>
					</td-->
				</tr>
				<?php endforeach; endif; unset($_from); ?>
			</table>
			<input type="button" data-inline="true" class="btn" value="<?php echo ((is_array($_tmp='Become Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="location='?action=newteam&type=away&actId=<?php echo $this->_tpl_vars['activity']->getActId(); ?>
'">
		</form>
	</div>
</div>
</body>
<script>

var header_s="";
header_s+='<div data-role="header" data-theme="d" data-backbtn="false">';
header_s+='<div data-role="controlgroup" data-type="horizontal" align="center">';
header_s+='<a href="#activity_info" rel=external data-role="button"><?php echo ((is_array($_tmp='Activity Info')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
header_s+='<a href="#activity_QA" rel=external data-role="button"><?php echo ((is_array($_tmp="Q&amp;A")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
header_s+='<a href="#apply_status" rel=external data-role="button"><?php echo ((is_array($_tmp='Apply Status')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
<?php if ($this->_tpl_vars['owner']->getUserId() == $_SESSION['userId']): ?>
	header_s+='<a href="#accEditDetails" rel=external data-role="button"><?php echo ((is_array($_tmp='Select Away Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>';
<?php endif; ?>
header_s+='</div>';
header_s+='</div>';
$("#header_1").html(header_s);
$("#header_2").html(header_s);
$("#header_3").html(header_s);
</script>
</html>