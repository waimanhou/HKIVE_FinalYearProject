<?php /* Smarty version 2.6.26, created on 2011-05-07 22:28:32
         compiled from recaptcha.htm */ ?>
<?php 
  require_once(ROOT.'/inc/recaptcha.lib.php');
  echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
 ?>