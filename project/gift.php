<?php
/* 
 * TODO: Security Check!!!! prevent CSRF Hacking
 */
require_once './inc/common.inc.php';
if (empty($_GET["action"])) {
    $v = new View();
    //$v->debugging=1;
    $db = new DB();
    $gift = new Gift($db);
    $v->assign("gifts", $gift->searchf(array()));
    $v->display("giftList.htm");
    die();
}else if($_GET["action"]=="redeem"){
    requireLogin();
    $giftId=$_GET["giftId"];
    $db = new DB();
    $gift = new Gift($db,$giftId);
    if($gift->getRemain()>0){
        $userId=$_SESSION['userid'];
        //debug2file($userId);
        //$userId=1;
        $user = new Account($db,$userId);

        if($user->getPoint()>=$gift->getPoint()){
          $gift->setRemain($gift->getRemain()-1);
          $gift->Save();

          $redeemgift = new RedeemGift($db);
          $redeemgift->setUserId($userId);
          $redeemgift->setGid($giftId);
          $redeemgift->setStatus(1);
          $redeemgift->Save();

          $user->setPoint($user->getPoint()-$gift->getPoint());
          $user->Save();

          showMsg("You have redeem ".$gift->getEngName()." successfully. Your account have ".$user->getPoint()." point now.");
        }else{
          showErrMsg("Error");
        }
    }
}
?>
