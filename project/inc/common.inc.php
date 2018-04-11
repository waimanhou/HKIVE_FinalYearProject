<?
require_once "config.inc.php";
require_once ROOT.'/inc/misc.func.php';
/*require_once ROOT.'/lib/global.php';
require_once ROOT.'/model/base.php';
require_once ROOT.'/smarty_inc.php';
require_once ROOT.'/lib/global.function.php';
require_once ROOT.'/model/class.DBObj.php';
require_once ROOT.'/lib/class.DB.php';
*/

session_start();

function __autoload($classname){
    $classname{0}=strtoupper($classname{0});
    if(file_exists(ROOT."/inc/ORM/class.{$classname}.php")){
        require_once ROOT."/inc/ORM/class.{$classname}.php";
    }else if(file_exists(ROOT."/inc/class.{$classname}.php")){
        require_once ROOT."/inc/class.{$classname}.php";
    }else{
        trigger_error("$classname not found.");
    }
}

if(!isset($_SESSION['lang'])){
    $_SESSION['lang']="zh";
}

date_default_timezone_set("Asia/Hong_Kong");
header("Content-Type: text/html; charset=utf-8");

//for CSRF check
//$_SESSION['old_ticket']=$_SESSION['ticket'];
//$_SESSION['ticket']=mt_rand();