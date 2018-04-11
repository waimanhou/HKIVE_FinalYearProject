<?php /* Smarty version 2.6.26, created on 2011-04-13 02:54:35
         compiled from header.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'showAd', 'header.htm', 279, false),array('function', 'getTicket', 'header.htm', 302, false),array('modifier', 'lang', 'header.htm', 290, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title><?php if (isset ( $this->_tpl_vars['title'] )): ?><?php echo $this->_tpl_vars['title']; ?>
<?php else: ?>FindSport<?php endif; ?></title>
        <?php $this->_tpl_vars['cssFiles'][] = "./css/cupertino/jquery-ui-1.8.9.custom.css"; ?>
        <?php $this->_tpl_vars['cssFiles'][] = "./css/ui.jqgrid.css"; ?>
        <?php $this->_tpl_vars['cssFiles'][] = "./css/common.css"; ?>

        <?php $this->_tpl_vars['jsFiles'][] = "./js/jquery.js"; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "./js/jquery-ui-1.8.9.custom.min.js"; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "./js/i18n/grid.locale-".($_SESSION['lang']).".js"; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "./js/jquery.jqGrid.min.js"; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "./js/jquery.togglePanel.js"; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "./ckeditor/ckeditor.js"; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "./ckeditor/adapters/jquery.js"; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "./js/ckeditor_patch.js"; ?>
		<?php $this->_tpl_vars['jsFiles'][] = "./js/jquery.tipsy.js"; ?>

        <?php if ($_SESSION['lang'] == 'en'): ?><?php $this->assign('lang', 'en'); ?><?php else: ?><?php $this->assign('lang', "zh-tw"); ?><?php endif; ?>
        <?php $this->_tpl_vars['jsFiles'][] = "http://maps.google.com/maps/api/js?v=3&amp;sensor=false&language=".($this->_tpl_vars['lang']); ?>

        <?php $this->_tpl_vars['jsFiles'][] = "./common_js.php"; ?>

        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cssFiles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['cssFiles'][$this->_sections['i']['index']]; ?>
" />
        <?php endfor; endif; ?>

        <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['jsFiles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
        <script language="JavaScript" src="<?php echo $this->_tpl_vars['jsFiles'][$this->_sections['j']['index']]; ?>
" type="text/javascript"></script>
        <?php endfor; endif; ?>

        <style>		
            body{
                height:100%;
                margin:0;
                background:#e2e2e2;
            }
            html, body
            {
                margin: 0; padding: 0; height: 100%; border:none;
            }
            *{
                -webkit-text-size-adjust:none; /* disable Google chrome min font size */
            }

    .ui-dialog{
        font-size:80%
    }
  fieldset { padding:0; border:0; }
  input.text {  width:100%; padding: .4em; }
#container {
	width:880px;
	margin:0 auto;
	position: relative;
}

#content {
	width:520px;
	min-height:500px;
}
a:link, a:visited {
	color:#27b;
	text-decoration:none;
}
a:hover {
	text-decoration:underline;
}
a img {
	border-width:0;
}
#topnav,#top {
	padding:10px 0px 12px;
	font-size:11px;
	line-height:3px;
	text-align:right;
}
#topnav a.signin,#top a {
	background:#88bbd4;
	padding:4px 6px 6px;
	text-decoration:none;
	font-weight:bold;
	color:#fff;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	border-radius:4px;
	*background:transparent url("./images/signin-nav-bg-ie.png") no-repeat 0 0;
	*padding:4px 12px 6px;
}
#topnav a.signin:hover,#top a:hover{
	background:#59B;
	*background:transparent url("./images/signin-nav-bg-hover-ie.png") no-repeat 0 0;
	*padding:4px 12px 6px;
}
#topnav a.signin, #topnav a.signin:hover ,#top a,#top a:hover{
	*background-position:0 3px!important;
}

a.signin{
	position:relative;
	margin-left:3px;
}
a.signin span{
	background-image:url("./images/toggle_down_light.png");
	background-repeat:no-repeat;
	background-position:100% 50%;
	padding:4px 16px 6px 0;
}
#topnav a.menu-open {
	background:#ddeef6!important;
	color:#666!important;
	outline:none;
}
#small_signup {
	display:inline;
	float:none;
	line-height:23px;
	margin:25px 0 0;
	width:170px;
}
a.signin.menu-open span {
	background-image:url("./images/toggle_up_dark.png");
	color:#789;
}

#signin_menu {
	-moz-border-radius-topleft:5px;
	-moz-border-radius-bottomleft:5px;
	-moz-border-radius-bottomright:5px;
	-webkit-border-top-left-radius:5px;
	-webkit-border-bottom-left-radius:5px;
	-webkit-border-bottom-right-radius:5px;
	display:none;
	background-color:#ddeef6;
	position:absolute;
	width:210px;
	z-index:100;
	border:1px transparent;
	text-align:left;
	padding:12px;
	top: 24.5px; 
	right: 0px; 
	margin-top:5px;
	margin-right: 0px;
	*margin-right: -1px;
	color:#789;
	font-size:11px;
}

#signin_menu input[type=text], #signin_menu input[type=password] {
	display:block;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border:1px solid #ACE;
	font-size:13px;
	margin:0 0 5px;
	padding:5px;
	width:203px;
}
#signin_menu p {
	margin:0;
}
#signin_menu a {
	color:#6AC;
}
#signin_menu label {
	font-weight:normal;
}
#signin_menu p.remember {
	padding:10px 0px 00px 85px;
}
#signin_menu p.forgot, #signin_menu p.complete {
	clear:both;
	margin:5px 0;
}
#signin_menu p a {
	color:#27B!important;
}
#signin_submit {
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	background:#39d url('./images/bg-btn-blue.png') repeat-x scroll 0 0;
	border:1px solid #39D;
	color:#fff;
	text-shadow:0 -1px 0 #39d;
	padding:4px 10px 5px;
	font-size:11px;
	margin:0 5px 0 0;
	font-weight:bold;
}
#signin_submit::-moz-focus-inner {
padding:0;
border:0;
}
#signin_submit:hover, #signin_submit:focus {
	background-position:0 -5px;
	cursor:pointer;
}

.tipsy-inner {
	padding:10px 15px;
	line-height:1.5em;
	font-weight:bold;
}
.tipsy {
	opacity:.8;
	filter:alpha(opacity=80);
	background-repeat:no-repeat;
	padding:5px;
}
.tipsy-inner {
	padding:8px 8px;
	max-width:200px;
	font:11px 'Lucida Grande', sans-serif;
	font-weight:bold;
	-moz-border-radius:4px;
	-khtml-border-radius:4px;
	-webkit-border-radius:4px;
	border-radius:4px;
	background-color:#000;
	color:white;
	text-align:left;
}
.tipsy-north {
	background-image:url(./images/tipsy-north.gif);
	background-position:top center;
}
.tipsy-south {
	background-image:url(./images/tipsy-south.gif);
	background-position:bottom center;
}
.tipsy-east {
	background-image:url(./images/tipsy-east.gif);
	background-position:right center;
}
.tipsy-west {
	background-image:url(./images/tipsy-west.gif);
	background-position:left center;
}
#header_menu{
font-size:11px;
margin-top:-7px;
margin-bottom:-7px;
margin-left:20px;
}
        </style>
        <?php echo $this->_tpl_vars['otherCode']; ?>

<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {          
				e.preventDefault();
                $("fieldset#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
            });
			
			$("fieldset#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("fieldset#signin_menu").hide();
				}
			});			
			
        });
</script>
<script type='text/javascript'>
    $(function() {
	  $('#forgot_username_link').tipsy({gravity: 'w'});   
    });
  </script>
    </head>
    <body>
        <table align=center style="background:#ffffff;height:100%" cellspacing=0 cellpadding=0 border=0 height="100%">
            <tr class="header">
                <td rowspan=3 style="width:20px;background:#e2e2e2 url('images/ls.gif') right repeat-y;width:18px">&nbsp;</td>
                <td width=980 height=120 background="images/banner.png" onclick="location='./'" style="cursor:pointer;text-align:right" valign=top>
                    <?php echo smarty_function_showAd(array('type' => 'top'), $this);?>

                </td>
                <td rowspan=3 style="width:20px;background:#e2e2e2 url('images/rs.gif') right repeat-y;width:18px">&nbsp;</td>
            </tr>
            <tr>
                <td width=970 style="padding:5px;height:100%" valign=top>
                    <!--h1 class="header">FindSport</h1>
                    <h3 class="header">[<a href='./'>BACK HOME</a>]</h3-->
                    <span class="header">	
						<div id="container">
						  <?php if ($_SESSION['userid']): ?>
						  <div id="topnav" class="topnav"><?php echo ((is_array($_tmp='you are logged in as')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 : <?php echo $_SESSION['loginName']; ?>
. 
						  <span id="top" class="top"><a href="logout.php"><span><?php echo ((is_array($_tmp='logout')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</span></a></span>
						  <span id="top" class="top"><a href="message.php"><span><?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</span></a></span>
						  <span id="top" class="top"><a href="account.php"><span><?php echo ((is_array($_tmp='Account')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</span></a></span>
						  <span id="top" class="top"><a href="gift.php"><span><?php echo ((is_array($_tmp='Gift')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</span></a></span>
						  <span id="top" class="top"><a href="friend.php"><span><?php echo ((is_array($_tmp='Friends')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</span></a></span>
						  </div>
						  <?php else: ?>
						  <div id="topnav" class="topnav"><?php echo ((is_array($_tmp="you are not logged in.")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
<a href="login.php" class="signin"><span><?php echo ((is_array($_tmp='login')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</span></a> <span id="top" class="top"><a href="register.php"><span><?php echo ((is_array($_tmp='register')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</span></a> </span></div>
						  <?php endif; ?>
						  <fieldset id="signin_menu">
							<form method="post" id="signin" action="login.php?action=login">
							  <input type=hidden name=ticket value="<?php echo smarty_function_getTicket(array('ticketname' => 'login_ticket'), $this);?>
">
							  <label for="loginName"><?php echo ((is_array($_tmp='loginName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</label>
							  <input id="loginName" name="loginName" tabindex="4" type="text">
							  </p>
							  <p>
								<label for="password"><?php echo ((is_array($_tmp='password')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</label>
								<input id="password" name="password" tabindex="5" type="password">
							  </p>
							  <p class="remember">
								<input id="signin_submit" value="<?php echo ((is_array($_tmp='login')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" tabindex="6" type="submit">
							  </p>
							</form>
						  </fieldset>
						</div>
                    </span>
					<hr class="header">
					<span class="header">
					<table id="header_menu">
						<tr>
                            <td align="center"><a href="./"><img src="./images/home_icon.png"/><br><?php echo ((is_array($_tmp='Home')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
                            <td align="center"><a href="news.php"><img src="./images/news_icon.jpg"/><br><?php echo ((is_array($_tmp='News')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
							<td align="center"><a href="venueList.php"><img src="./images/venue_icon.png"/><br><?php echo ((is_array($_tmp='Venues')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
                            <td align="center"><a href="activity.php"><img src="./images/activity_icon.png"/><br><?php echo ((is_array($_tmp='activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
                            <td align="center"><a href="team.php"><img src="./images/team_icon.png"/><br><?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
							<td align="center"><a href="organization.php"><img src="./images/organization_icon.jpg"/><br><?php echo ((is_array($_tmp='Organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
							<td align="center"><a href="changeLang.php"><img src="./images/lang_icon.png"/><br><?php echo ((is_array($_tmp='change language')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a></td>
						</tr>
						</table>
						</span>
                    <hr class="header">