<?

            /*******************************************************************
             *TODO: Check the username case!!!!!                                  
             *******************************************************************/

require_once './inc/common.inc.php';
require_once './inc/recaptcha.lib.php';

if (isset($_SESSION['userId'])) {
    redirect("./");
}

if (empty($_GET['action'])) {
    $v = new View();
    $_SESSION['reg_email_ticket'] = mt_rand();
    $v->assign('ticket', $_SESSION['reg_email_ticket']);
    $v->display("register_1.htm");
} else if ($_GET['action'] == 'email') {
    if ($_POST['ticket'] != $_SESSION['reg_email_ticket']) {
        unset($_SESSION['reg_email_ticket']);
        showErrMsg("Error occured.");
    }
    unset($_SESSION['reg_email_ticket']);
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", strtolower($_POST['email']))) {
        showErrMsg("invalid email address");
    }
    if (
            !(
            recaptcha_check_answer(
                    RECAPTCHA_PRIVATE_KEY,
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["recaptcha_challenge_field"],
                    $_POST["recaptcha_response_field"])->is_valid
            )
    ) {
        showErrMsg("invalid reCAPTCHA");
    }


    $db = new DB();
    $code = md5(md5(mt_rand()) . md5(mt_rand()));
    $ea = new EmailActivation($db);
    $existsRecord = $ea->searchMatch(array('email' => $_POST['email']), true);
    if ($existsRecord) {
        $last = $existsRecord->getUPDATED() ? $existsRecord->getUPDATED() : $existsRecord->getCREATED();
        /*
          2 weeks = 1 209 600 seconds
          http://www.google.com/search?q=2weeks=?sec

         */
        if ($existsRecord->getDELETED()) {
            showErrMsg('email address have been registered');
        }
        if (time() - strtotime($last) > ACTIVATION_LINK_EXPIRE_TIME) {
            $existsRecord->setCode($code);
            $existsRecord->Save(); //Save = change the `UPDATED` field
        } else {
            showErrMsg('registration email already sent');
        }

        $ac = new Account($db);
        $existsRecord = $ac->searchMatch(array('email' => $_POST['email']), true);
        if ($existsRecord) {
            showErrMsg('email address have been registered');
        }
    } else {
        $ea->setEmail($_POST['email']);
        $ea->setCode($code);
        $ea->Save();
    }
    $activationLink = "http://" . $_SERVER["HTTP_HOST"] . "/register.php?action=activate&eaId=" . $ea->getEaId() . "&email={$_POST['email']}&code={$code}";

        $emailbody=<<<EOD

<p>Please DO NOT REPLY to this message - it is an automated email and your reply<br>
will not be received.</p>
<p align=center>------------------------------------------------------------------------------</p>
You have received this email because this email address<br>
was used during registration for our website.<br>
If you did not register at our website, please disregard this email. <br>
You do not need to unsubscribe or take any further action.<br>

<p align=center>------------------------------------------------------------------------------</p>
<p>Thank you for registering with us ({$_SERVER["HTTP_HOST"]})<br>
To continue the registration, please click the link below to confirm your email <br>
address:<br>
<a href="{$activationLink}">{$activationLink}</a><br>
if you cannot see the link above or the link is not work, <br>
please copy and paste this entire URL into the address bar of your browser:<br>
{$activationLink}</p>
<p align=center>------------------------------------------------------------------------------</p>
<p>請勿回覆此電郵，這是系統自動寄出的電郵，你的回郵並不會被收到。</p>
<p align=center>------------------------------------------------------------------------------</p>
<p>你收到此電郵是因為此電郵被人用作註冊本網站之用。<br>
如你並沒有註冊本網站，請忽略此電郵，你並不需要採取任何進一步的行動。</p>
<p align=center>------------------------------------------------------------------------------</p>
<p>感謝你申請為本網站({$_SERVER["HTTP_HOST"]})之會員，請點擊以下連結以繼續註冊程序。<br>
<a href="{$activationLink}">{$activationLink}</a><br>
如你未能看到上述連結，或連結無效，請複製以下網址並貼上至你的瀏覽器網址列：<br>
{$activationLink}</p>
EOD;

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From: NoReply@{$_SERVER["HTTP_HOST"]}";
    mail($_POST['email'], "Registration at {$_SERVER["HTTP_HOST"]}", $emailbody, $headers);
    showMsg("confirm email have been sent");
} else if ($_GET['action'] == 'activate') {
    if (empty($_GET['eaId']) || empty($_GET['email']) || empty($_GET['code'])) {
        showErrMsg('Invaild request');
    }
    $db = new DB();
    $ea = new EmailActivation($db);
    $record = $ea->searchMatch(array('eaId' => $_GET['eaId'], 'email' => $_GET['email'], 'code' => $_GET['code']));
    if ($record === false) {
        showErrMsg('Sorry, record not found or registration link expired.');
    }
    $last = $record->getUPDATED() ? $record->getUPDATED() : $record->getCREATED();

    if (time() - strtotime($last) > ACTIVATION_LINK_EXPIRE_TIME) {
        $record->delete();
        $record->save();
        showErrMsg('registration link expired.');
    }


    $v = new View();
    $_SESSION['reg_email_form_ticket'] = mt_rand();
    $v->assign('ticket', $_SESSION['reg_email_form_ticket']);
    $v->assign('eaId', $_GET['eaId']);
    $v->assign('email', $_GET['email']);
    $v->assign('code', $_GET['code']);
    $v->display('register_2.htm');
} else if ($_GET['action'] == 'submitReg') {
    if ($_POST['ticket'] != $_SESSION['reg_email_form_ticket']) {
        unset($_SESSION['reg_email_form_ticket']);
        showErrMsg('Error occured.');
    }
    unset($_SESSION['reg_email_form_ticket']);
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", strtolower($_POST['email']))) {
        showErrMsg("invalid email address");
    }

    $fields = array(
        //  "hkid","chiName","engName","nickName","password","password2","tel1","accept"
        "HKID", "chiName", "engName", "nickName", "password", "password2", "tel1", "accept", "loginName"
    );


    //var_dump($_POST);

    foreach ($fields as $key => $value) {
        if (empty($_POST[$value])) {
            showErrMsg('Please fill in all necessary field(s)');
        }
    }


    if ($_POST['password'] != $_POST['password2']) {
        showErrMsg('Please confirm your password');
    }

    if (!ctype_digit($_POST['tel1'])) {
        showErrMsg('Wrong tel format.');
    }

    if (strlen($_POST['tel2']) > 0 && !ctype_digit($_POST['tel2'])) {
        showErrMsg('Wrong tel format.');
    }

    if (!checkHKID($_POST['HKID'])) {
        showErrMsg('Invalid HKID');
    }

    $db = new DB();
    $ea = new EmailActivation($db);
    $EARecord = $ea->searchMatch(array('eaId' => $_POST['eaId'], 'email' => $_POST['email'], 'code' => $_POST['code']));
    if ($EARecord === false) {
        showErrMsg('Sorry, record not found');
    }


    $acc = new Account($db);

    $AccRecord = $acc->searchMatch(array('loginName' => $_POST['loginName']), true);
    if ($AccRecord !== false) {
        showErrMsg('login name already in use.');
    }

    $acc = new Account($db);
    $acc->setEmail($_POST['email']);
    $acc->setHKID(strtoupper($_POST['HKID']));
    $acc->setLoginName($_POST['loginName']);
    $acc->setChiName($_POST['chiName']);
    $acc->setEngName($_POST['engName']);
    $acc->setNickName($_POST['nickName']);
    $acc->setPassword($_POST['password']);
    $acc->setTel1($_POST['tel1']);
    if (strlen($_POST['tel2']) > 0) {
        $acc->setTel2($_POST['tel2']);
    }
    $acc->Save();
    $EARecord->delete();
    $EARecord->save();
    $mf = new MsgFolder($db);
    $mf->setName("Inbox");
    $mf->setUserId($acc->getUserId());
    $mf->Save();
    showMsg('Finish reg.');
} else {
    redirect('./');
}