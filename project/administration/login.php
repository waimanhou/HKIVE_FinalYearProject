<?php

require_once '../inc/common.inc.php';

require_once ROOT . '/inc/recaptcha.lib.php';
$db = new DB();

    $_SESSION["adminLogined"] = false;

/* Please comment out the follwing lines... 
    if($_POST["loginName"]=="admin" && $_POST["password"]=="abcd1234" && $_POST["adminpassword"]=="abcd1234"){
        $_SESSION["adminLogined"] = true;
        $acc=new Account(new DB(),7);
        $_SESSION['userid'] = $acc->getUserId();
        $_SESSION['userId'] = $acc->getUserId();
        $_SESSION['loginName'] = $acc->getLoginName();
        echo "<script>alert(\"security disabled, please comment out the code in login.php later\")</script>";
        redirect("main.php",1);
        die();
    }
/**/
if (
        empty($_POST["loginName"]) ||
        empty($_POST["password"]) ||
        empty($_POST["adminpassword"]) ||
        empty($_POST["ticket"])/* ||
        !(
        recaptcha_check_answer(
                RECAPTCHA_PRIVATE_KEY,
                $_SERVER["REMOTE_ADDR"],
                $_POST["recaptcha_challenge_field"],
                $_POST["recaptcha_response_field"])->is_valid
        )*/
) {
    loginfailed();
} else {
    $db = new DB();
    $acc = new Account($db);
    $acc = $acc->searchMatch(array('loginName' => $_POST['loginName']));
    if ($acc === false || !$acc->chkPassword($_POST['password'])) {
        loginfailed();
    }
    $admin = new Administrator($db);
    $admin = $admin->searchMatch(array('userid' => $acc->getUserId()));
    if (!$admin->chkPassword($_POST["adminpassword"])) {
        loginfailed();
    }
    $acc = $admin->getAccount();
    $_SESSION['userid'] = $acc->getUserId();
    $_SESSION['userId'] = $acc->getUserId();
    $_SESSION['loginName'] = $acc->getLoginName();
    $acc->setLastLogin(date("Y-m-d H:i:s"));
    $acc->setLastIp($_SERVER['REMOTE_ADDR']);
    $acc->Save();
    $al = new AdminLog($db);
    $al->setAdminId($admin->getAdminId());
    $al->setType("LOGIN");
    $al->setData($_SERVER["REMOTE_ADDR"]);
    $al->Save();

    $_SESSION["adminLogined"] = true;
    redirect("main.php");
}

loginfailed();
function loginfailed() {
    session_destroy();
    redirect("./");
}


/*
  function checkPassword($username, $password) {
  global $db;
  $acc = new Account($db);
  $acc = $acc->searchMatch(array('loginName' => $_POST['loginName']));
  if ($acc === false) {
  return false;
  }

  $admin = new Administrator($db);
  $admin = $admin->searchMatch(array('loginName' => $username));
  if ($admin == false) {
  return false;
  }
  if ($admin->chkPassword($password)) {
  $acc = $admin->getAccount();
  $_SESSION['userid'] = $acc->getUserId();
  $_SESSION['userId'] = $acc->getUserId();
  $_SESSION['loginName'] = $acc->getLoginName();
  $acc->setLastLogin(date("Y-m-d H:i:s"));
  $acc->setLastIp($_SERVER['REMOTE_ADDR']);
  $acc->Save();
  $_SESSION['adminid'] = $admin->getAdminId();
  } else {
  return false;
  }
  }

  if ($_GET["q"] == "logout") {
  session_destroy();
  header("location: ./");
  die();
  }

  if (checkPassword($_POST["username"], $_POST["password"])) {
  $al = new AdminLog($db);
  $al->setAdminId($_SESSION['adminid']);
  $al->setData($_SERVER['REMOTE_ADDR']);
  $al->setType("LOGIN");
  $al->Save();
  header("location: main.php");
  die();
  } else {
  session_destroy();
  $al = new AdminLog($db);
  $al->setAdminId($_SESSION['adminid']);
  $al->setData($_SERVER['REMOTE_ADDR']);
  $al->setType("LOGIN_FAIL");
  $al->Save();
  $_SESSION["adminLogined"] = false;
  header("location: ./?wrongpw=1");
  die();
  }

  session_destroy();
  header("location: ./?wrongpw=1");

 */
