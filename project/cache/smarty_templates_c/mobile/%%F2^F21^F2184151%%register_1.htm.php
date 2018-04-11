<?php /* Smarty version 2.6.26, created on 2011-05-07 22:28:32
         compiled from register_1.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'register_1.htm', 2, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1><?php echo ((is_array($_tmp='register')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
<script type="text/javascript">
 var RecaptchaOptions = {
 <?php if ($_SESSION['lang'] == 'zh'): ?>

        custom_translations : {
            visual_challenge : "取得圖形驗證碼",
            audio_challenge : "取得音效驗證碼",
            refresh_btn : "重新整理圖形",
            instructions_visual : "輸入兩個英文單字:",
            instructions_audio : "輸入您聽到的聲音:",
            help_btn : "獲得協助",
            play_again : "重新播放音效",
            cant_hear_this : "將音效下載為 MP3",
            incorrect_try_again : "錯誤！ 請再試一次"
        },
                <?php endif; ?>
    theme : 'clean'
 };
 </script>
 <div data-role="page">
 	<div data-role="header" class="h">
		<h1><?php echo ((is_array($_tmp='register')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>
		<a href="index.php" data-icon="forward" class="ui-btn-left" rel=external><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
	</div><!-- /header -->
		<form action="register.php?action=email" method="post">
			<p><?php echo ((is_array($_tmp='register_desc')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</p>
			<?php echo ((is_array($_tmp='Email address')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<br>
			<input type="text" name="email"><br>
			<?php echo ((is_array($_tmp='Recaptcha')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<br>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recaptcha.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<input type="submit" value="<?php echo ((is_array($_tmp='Submit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
			<input type="hidden" name="ticket" value="<?php echo $this->_tpl_vars['ticket']; ?>
">
		</form>
</div>
</body>
</html>