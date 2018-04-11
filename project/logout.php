<?
require_once './inc/common.inc.php';
session_destroy();
if(!empty($_SERVER['HTTP_REFERER'])){
    header("location: {$_SERVER['HTTP_REFERER']}");
}else{
    header("location: ./");
}
?>