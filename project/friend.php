<?php

/*
 * TODO: security check, prevent user add/change/remove friend from the list that not belongs to them!!!
 *
 */
require_once './inc/common.inc.php';
requireLogin();
if (empty($_GET["action"])) {
  $v = new View();
  //$v->debugging=1;
  $db = new DB();
  $userId=$_SESSION['userid'];
  //$userId = 1;
  $account = new Account($db, $userId);
  $friendlists = $account->getFriendLists();

  $fdlist = array();

  for ($i = 0; $i < count($friendlists); $i++) {
    $a = $friendlists[$i]->getFriendAccounts();
    $fd = array();
    for ($j = 0; $j < count($a); $j++) {
      $fd[$j] = array("name" => $a[$j]->getNickName(),"userId"=>$a[$j]->getUserId());
    }
    $fdlist[] = array("name" => $friendlists[$i]->getName(), "listId" => $friendlists[$i]->getListId(), "friend" => $fd);
  }

  $v->assign("friendlist", $fdlist);
  $v->display("friendList.htm");
  die();
} else if ($_GET["action"] == "add") {
  $listId = $_GET["listId"];

  $emailAddress = $_GET["emailAddress"];

  $db = new DB();

  $acc = new Account($db);
  $foundAcc = $acc->searchMatch(array("email" => $emailAddress), true);

  if ($foundAcc == true) {
    $userId = $foundAcc->getUserId();

    $friend = new Friend($db);
    $result = $friend->searchMatch(array("listId" => $listId, "userId" => $userId), true);
    if ($result === false) {
      $friend->setListId($listId);
      $friend->setUserId($userId);
      $friend->setStatus(1);
      $friend->Save();
    } else {
      $friend = $result;
      if ($friend->getDELETED() != null) {
        $friend->setDELETED(null);
        $friend->Save();
      }
    }
    header("location:friend.php");
  }else{
    showMsg("Cannot found the user.");
  }
} else if ($_GET["action"] == "remove") {
  $userId = $_GET["userId"];
  $listId = $_GET["listId"];

  $db = new DB();
  $friend = new Friend($db, array("listId" => $listId, "userId" => $userId));
  $friend->delete();
  $friend->Save();
  header("location:friend.php");
}else if($_GET["action"]=="createFriendList"){
  $listName=$_GET["listName"];
  //$userId = 1;
  $userId=$_SESSION['userid'];
  $db = new DB();
  $friendlist=new FriendList($db);
  $friendlist->setName($listName);
  $friendlist->setUserId($userId);
  $friendlist->Save();
  header("location:friend.php");
}else if($_GET["action"]=="removeFriendList"){
  $listId=$_GET["listId"];
  
  $db=new DB();
  $friendlist=new FriendList($db,$listId);
  $friendlist->delete();
  $friendlist->Save();
  
  header("location:friend.php");
}else if($_GET["action"]=="renameFriendList"){
  $listName=$_GET["listName"];
  $listId=$_GET["listId"];

  $db=new DB();
  $friendlist=new FriendList($db, $listId);
  $friendlist->setName($listName);
  $friendlist->Save();
  header("location:friend.php");
}
?>
