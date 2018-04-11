<?
require_once './inc/common.inc.php';
$v=new View();
//$v->caching=1;
$v->display("common_js.js",$_SESSION['lang']);
?>