<?
session_start();
$_SESSION['lang']=$_SESSION['lang']=='en'?'zh':'en';

header("location: ".(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : './'));