<?
require_once './inc/common.inc.php';
if (empty($_GET["loginName"])) {
    die();
}
//$accountid = $_GET["loginName"];

$db = new DB();
$account = new Account($db);
$account = $account->searchMatch(array('loginName' => $_GET["loginName"]));
$v = new View();
$v->assign("account", $account);
$v->display("account_detail.htm");
?>