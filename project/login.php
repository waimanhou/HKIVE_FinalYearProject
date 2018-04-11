<?

require_once './inc/common.inc.php';

if (isset($_SESSION['userid'])) {
    redirect('./');
}

if (empty($_GET['action'])) {

    $v = new View();
    $v->assign('ticket', NewTicket('login_ticket'));
    $v->display('login.htm');
} else if ($_GET['action'] == 'login') {
//NOTE: DISABLED LOGIN TICKET CHECK
   // checkTicket('login_ticket');

    if (strlen($_POST['loginName']) == 0 || strlen($_POST['password']) == 0) {
        showErrMsg('Please fill in both username and password');
        die();
    }

    $db = new DB();
    $acc = new Account($db);
    $acc = $acc->searchMatch(array('loginName' => $_POST['loginName']));

    if ($acc === false) {
        showErrMsg('Wrong loginName/password');
    }


    if ($acc->chkPassword($_POST['password'])) {
        $_SESSION['userid'] = $acc->getUserId();
        $_SESSION['userId'] = $acc->getUserId();
        $_SESSION['loginName'] = $acc->getLoginName();
        $acc->setLastLogin(date("Y-m-d H:i:s"));
        $acc->setLastIp($_SERVER['REMOTE_ADDR']);
        $acc->Save();
        //showMsg('Logged in');
        goBack();
    } else {
        showErrMsg('Wrong loginName/password');
    }
} else {
    redirect('./');
}