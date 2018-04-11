<?php /* Smarty version 2.6.26, created on 2011-05-07 22:26:06
         compiled from index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'index.htm', 12, false),)), $this); ?>
<?php ob_start(); ?>
  	<style type="text/css">
		.t{
		display:table; width: 100%; vertical-align: middle;text-align: center;
		}
	</style>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div data-role="page" id="menu">
	<div data-role="header" data-nobackbtn="true">	
		<?php if ($_SESSION['userid']): ?>
			<a href="account.php" rel=external><?php echo ((is_array($_tmp='Account')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 : <?php echo $_SESSION['loginName']; ?>
</a>
			<h1><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
			<a href="logout.php" rel=external class="ui-btn-right"><?php echo ((is_array($_tmp='logout')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
		<?php else: ?>
			<a href="register.php" onclick="top.location='register.php'"><?php echo ((is_array($_tmp='register')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
			<h1><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
			<a href="login.php" data-rel="dialog"><?php echo ((is_array($_tmp='login')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
		<?php endif; ?>
	</div><!-- /header -->
	<div data-role="content" align="center">
		<table width="100%" height="100%" align="center" class="t">
			<tr height="100">
				<td><a href="news.php" rel=external><img src="./images/news_icon.jpg"/><br><?php echo ((is_array($_tmp='News')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
				<td><a href="venueList.php" rel=external><img src="./images/venue_icon.png"/><br><?php echo ((is_array($_tmp='Venues')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
				<td><a href="activity.php" rel=external><img src="./images/activity_icon.png"/><br><?php echo ((is_array($_tmp='activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
			</tr>
			<tr height="100">
				<td><a href="team.php" rel=external><img src="./images/team_icon.png"/><br><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
				<td><a href="organization.php" rel=external><img src="./images/organization_icon.jpg"/><br><?php echo ((is_array($_tmp='Organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
				<td><a href="gift.php" rel=external><img src="./images/gift_icon.png"/><br><?php echo ((is_array($_tmp='gift')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
			</tr>
			<?php if ($_SESSION['userid']): ?>
			<tr height="100">
				<td><a href="message.php" rel=external><img src="./images/message_icon.png"/><br><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
				<td><a href="friend.php" rel=external><img src="./images/friend_icon.png"/><br><?php echo ((is_array($_tmp='Friends')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
				<td><a href="changeLang.php" rel=external><img src="./images/lang_icon.png"/><br><?php echo ((is_array($_tmp='change language')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
			</tr>
			<?php endif; ?>
		</table>
	</div>
	<div data-role="footer" style="position:absolute;bottom:0;">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>