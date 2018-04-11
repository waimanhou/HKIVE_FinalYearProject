<?

/*
 * Join whole team version
 * remember change view filename if change version
 */

require_once './inc/common.inc.php';
if (empty($_GET["action"])) {
    listActivity();
} else if ($_GET["action"] == "getActivityList") {
    getActivityList();
} else if ($_GET["action"] == "viewDetail") {
    viewDetail();
} else if ($_GET['action'] == "ask") {
    ask();
} else if ($_GET['action'] == "answer") {
    ans();
} else if ($_GET['action'] == 'create') {
    create();
} else if ($_GET['action'] == 'getVenueList') {
    getVenueList();
} else if ($_GET['action'] == 'getCreateTeamList') {
    getCreateTeamList();
} else if ($_GET['action'] == "saveCreateActivity") {
    saveCreateActivity();
} else if ($_GET['action'] == 'newteam') {
    newteam();
} else if ($_GET['action'] == 'newteamsave') {
    newteamsave();
} elseif ($_GET['action'] == 'acceptIt') {
    acceptIt();
} else if ($_GET['action'] == 'ITdetail') {
    viewIT();
} else if ($_GET['action'] == 'acceptIa') {
    acceptIA();
} else if ($_GET['action'] == 'inviteTeam') {
    inviteTeam();
} else if ($_GET['action'] == 'joinIT') {
    joinIT();
} else if ($_GET['action'] == 'invitation') {//Convener send invit to team
    sendInv();
} else if ($_GET['action'] == 'cancel') {
    cancelActivity();
} else if ($_GET['action'] == 'teamAcceptInvitation') {
    teamAcceptInvitation();
} else if ($_GET['action'] == 'teamRejectInvitation') {
    teamRejectInvitation();
} else if ($_GET['action'] == 'memberInvitation') {
    sendMemberInv();
} else if ($_GET['action'] == 'memberAcceptInvitation') {
    memberAcceptInvitation();
} else if ($_GET['action'] == 'memberRejectInvitation') {
    memberRejectInvitation();
} else if ($_GET['action'] == 'getAccountFCBKList'){
    getAccountFCBKList();
}

function listActivity() {
    $v = new View();
    $db = new DB();
    $a = new ActivityType($db);
    $v->assign("activityType", $a->getList());
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->display("activityList.htm");
    die();
}

function getActivityList() {
    /*
     * TODO: Filter
     */
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    $page = intval($_GET['page']); // get the requested page
    $limit = intval($_GET['rows']); // get how many rows we want to have into the grid
    $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
    $sord = $_GET['sord']; // get the direction
    // if (!$sidx)
    //    $sidx = 1;
    if ($page == 0)
        $page = 1;
    if ($limit == 0)
        $limit = 30;

    $page = $page == 0 ? 1 : $page;
    $db = new DB();
    $activity = new ActivityView($db);
    /* $list = $activity->vsearch(
      array(
      'each' => $limit,
      'page' => $page,
      'orderby' => $sidx,
      'order' => $sord
      )
      ); */
    $sf = array();
    /* if($sidx && $activity->isColExists($sidx)){
      $sf['order']=array($sidx=>$sord);
      } */
    $sf['field_list'] = array();

    $sf['field_list']['status'] = 1; //1=OPEN,0=CLOSED
    $sf['field_list']['type'] = 0; //0=PUBLIC , 1=By Inv, 2=Team, 3=Org
    $sf['field_list']['name'] = array("like", "%" . $_GET['keyword'] . "%");
    if (isset($_GET['type']) && $_GET['type'] != 'all') {
        $sf['field_list']['activityTypeId'] = $_GET['type'];
    }
    if (isset($_GET['district']) && $_GET['district'] != 'all') {
        $sf['field_list']['distCode'] = $_GET['district'];
    }

    $sf['page'] = array($page, $limit);
    $sf['order'] = array('actId' => 'desc');
    $list = $activity->searchf($sf);
    $v = new View();
    $v->assign('list', $list);
    $v->assign('totalrecord', $activity->getLastCount());
    $v->assign('totalpage', ceil($activity->getLastCount() / $limit));
    $v->assign('page', $page);
    $v->assign('orderby', $_GET['orderby']);
    $v->display("activityList_xml.htm");
    //print_r($list);
}

function viewDetail() {

    if (empty($_GET["activityid"])) {
        die();
    }

    $activityid = intval($_GET["activityid"]);

    $db = new DB();
    $activity = new Activity($db);
    $activity = $activity->searchMatch(array('actId' => $activityid));


    $it = new InvolveTeam($db);
    $ownerteam = $it->searchf(
                    array(
                        'field_list' => array(
                            'actId' => $activityid,
                            //'status'=> InvolveTeam::STATUS_OWNER_TEAM
                            'type' => InvolveTeam::TYPE_OWNER_TEAM
                        )
                    )
    );
    //$ownerteam = $ownerteam[0];

    $hometeamary = array();
    $ia = new InvolveAccount($db);
    foreach ($ownerteam as $v) {
        $ia->searchf(
                array(
                    'field_list' => array(
                        'itId' => $v->getItId(),
                        'status' => InvolveAccount::STATUS_ACCEPTED
                    )
                )
        );
        //$ot_accepted[] = $ia->getLastCount();
        $hometeamary[] = array($v, $ia->getLastCount());
    }
    $guestteam = $it->searchf(
                    array(
                        'field_list' => array(
                            'actId' => $activityid,
                            //'status'=> InvolveTeam::STATUS_OWNER_TEAM
                            'type' => InvolveTeam::TYPE_GUEST_TEAM
                        )
                    )
    );
    $guestteamary = array();
    foreach ($guestteam as $c) {
        $ia->searchf(
                array(
                    'field_list' => array(
                        'iaId' => $c->getItId(),
                        'status' => InvolveAccount::STATUS_ACCEPTED
                    )
                )
        );
        $guestteamary[] = array($c, $ia->getLastCount());
        //IT Obj, count
    }



    $v = new View();
    $v->assign("activity", $activity);
    $v->assign("askTicket", NewTicket("AskTicket_{$activity->getActId()}"));
    //$v->assign("hometeam", $ownerteam);
    $v->assign("guestteamary", $guestteamary);
    $v->assign("hometeamary", $hometeamary);
    //$v->assign("otAccepted", $ot_accepted);
    $v->display("activity_detail.htm");
}

function ask() {

    /*
     *
     * TODO: Data type check, security check, Permission Check
     *
     */
    requireLogin();
    if (empty($_POST['actId'])) {
        showErrMsg("Error occured.");
    }
    if (!checkTicket("AskTicket_{$_POST['actId']}", "askTicket")) {
        showErrMsg("Error occured.");
    }
    if (empty($_POST['question'])) {
        showErrMsg("please fill in all the blank");
    }
    $actId = intval($_POST['actId']);


    $db = new DB();
    $aqa = new ActivityQA($db);
    $aqa->setActId($actId);
    $aqa->setUserId($_SESSION["userId"]);
    $aqa->setQuestion($_POST["question"]);
    $aqa->save();
    redirect($_SERVER['HTTP_REFERER'] . "#tabs-3");
}

function ans() {
    /*
     *
     * TODO: Data type check, security check, Permission Check
     *
     */
    requireLogin();
    if (empty($_POST['qaId'])) {
        showErrMsg("Error occured.");
    }
    if (empty($_POST['answer'])) {
        showErrMsg("please fill in all the blank");
    }
    $qa = intval($_POST['qaId']);


    $db = new DB();
    $aqa = new ActivityQA($db, $_POST[qaId]);
    $aqa->setAnswer($_POST["answer"]);
    $aqa->setATime(date("Y-m-d H:i:s"));
    // $aqa->setQTime($aqa->getQTime());
    $aqa->save();
    redirect($_SERVER['HTTP_REFERER'] . "#tabs-3");
}

function create() {
    requireLogin();
    $v = new View();
    $db = new DB();
    $a = new ActivityType($db);
    $v->assign("activityType", $a->getList());
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->assign("createActTicket", NewTicket("createActTicket"));
    $v->display("activity_create.htm");
}

function getVenueList() {

    if (!$_SESSION['userId']

        )die();
    if (empty($_GET['typeId']) || empty($_GET['distCode'])) {
        die();
    }
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    $db = new DB();
    $venue = new Venue($db);
    $list = $venue->searchf(array('field_list' => array('typeId' => $_GET['typeId'], 'distCode' => $_GET['distCode'])));
    $v = new View();
    $v->assign("list", $list);
    $v->display("activity_create_venuelist.htm");
}

function getCreateTeamList() {

    if (!$_SESSION['userId']

        )die();
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    $db = new DB();
    $teams = new Team($db);
    $list = $teams->searchf(array('field_list' => array('leaderId' => $_SESSION['userId'])));
    $v = new View();
    $v->assign("list", $list);
    $v->display("activity_create_teamlist.htm");
}

function saveCreateActivity() {
    /* echo "<pre>";
      print_r($_POST);
      die(); */
    //TODO: Data type check, blank field check
    $db = new DB();
    $a = new Activity($db);
    $a->setOwnerId($_SESSION['userid']);
    $a->setVenueId($_POST['venue']);
    $a->setStartTime(date("Y-m-d H:i:s", strtotime($_POST['date'] . ' ' . $_POST['start'])));
    $a->setEndTime(date("Y-m-d H:i:s", strtotime($_POST['date'] . ' ' . $_POST['end'])));
    $a->setOtherInfo($_POST['otherInfo']);
    $a->setName($_POST['actName']);
    $a->setRequiredTeam($_POST['reqteam']);
    $a->setPlayerPerTeam($_POST['reqPlayer']);
    $a->Save();
    /*
      if ($_POST['createrTeam'] != -1) {
      $t = new InvolveTeam($db);
      $t->setActId($a->getActId());
      $t->setTeamId($_POST['createrTeam']);
      //$t->setstatus(InvolveTeam::STATUS_OWNER_TEAM);
      $t->setType(InvolveTeam::TYPE_OWNER_TEAM);
      $t->save();
      } else {
      //New a Temp Team
      $nt = new Team($db);
      $nt->setChiName("臨時隊伍");
      $nt->setEngName("TempTeam");
      $nt->setLeaderId($_SESSION['userid']);
      $nt->setTemporary(1);
      $nt->setNoOfPlayer(1);
      $nt->setType(Team::TYPE_PUBLIC);
      $nt->save();

      $t = new InvolveTeam($db);
      $t->setActId($a->getActId());
      $t->setTeamId($nt->getTeamId());
      //$t->setStatus(InvolveTeam::STATUS_OWNER_TEAM);
      $t->setType(InvolveTeam::TYPE_OWNER_TEAM);
      $t->save();

      $ia = new InvolveAccount($db);
      $ia->setActId($a->getActId());
      $ia->setUserId($_SESSION['userid']);
      $ia->setItId($t->getItId());
      $ia->setTeamId($nt->getTeamId());
      $ia->setStatus(InvolveAccount::STATUS_ACCEPTED);
      $ia->save();
      } */
    redirect('?');
}

function newteam() {

    $db = new DB();
    $activity = new Activity($db, $_GET['actId']);

    $v = new View();

    $v->assign("activity", $activity);
    $v->display("activity_newteam.htm");
}

function newteamsave() {
    $db = new DB();
    $a = new Activity($db, $_POST['actId']);
    if ($_POST['teamId'] == -1) {
        $nt = new Team($db);
        $nt->setChiName("臨時隊伍");
        $nt->setEngName("TempTeam");
        $nt->setLeaderId($_SESSION['userid']);
        $nt->setTemporary(1);
        $nt->setNoOfPlayer(1);
        $nt->setType(Team::TYPE_PUBLIC);
        $nt->save();
    } else {
        $nt = new Team($db, $_POST['teamId']);
    }

    $t = new InvolveTeam($db);
    $t->setActId($a->getActId());
    $t->setTeamId($nt->getTeamId());
    //$t->setStatus(InvolveTeam::STATUS_OWNER_TEAM);
    $t->setStatus($_POST['foreign'] ? InvolveTeam::STATUS_PUBLIC : InvolveTeam::STATUS_PRIVATE);
    $t->setType($_POST['type'] == 'home' ? InvolveTeam::TYPE_OWNER_TEAM : InvolveTeam::TYPE_GUEST_TEAM);
    $t->save();

    if ($_POST['ijoin']) {
        $ia = new InvolveAccount($db);
        $ia->setActId($a->getActId());
        $ia->setUserId($_SESSION['userid']);
        $ia->setItId($t->getItId());
        $ia->setTeamId($nt->getTeamId());
        $ia->setStatus(InvolveAccount::STATUS_ACCEPTED);
        $ia->save();
    }
    redirect("?action=viewDetail&type=iframe&activityid=" . $_POST['actId']);
}

function acceptIt() {

    $db = new DB();
    $it = new InvolveTeam($db, $_GET['itId']);
    //$it->setStatus(InvolveTeam::STATUS_SELECTED);
    $it->setSelected(1);
    $it->Save();
    $t = $it->getTeam();
    $member = $t->getMemberAccounts();
    foreach ($member as $v) {
        $ia = new InvolveAccount($db);
        $ia->setActId($it->getAct()->getActId());
        $ia->setUserId($v->getUserId());
        $ia->setItId($it->getItId());
        $ia->Save();
    }
    redirect("?action=viewDetail&type=iframe&activityid=" . $it->getAct()->getActId());
}

function viewIT() {

    $db = new DB();
    $it = new InvolveTeam($db, $_GET['itId']);
    $ia = new InvolveAccount($db);
    $ialist = $ia->searchf(array("field_list" => array("itId" => $_GET['itId'])));
    $v = new View();
    $v->assign("it", $it);
    $v->assign("iaList", $ialist);
    $v->display("it_details.htm");
}

function acceptIA() {
    $db = new DB();
    $ia = new InvolveAccount($db, $_GET['iaId']);
    $ia->setStatus(InvolveAccount::STATUS_ACCEPTED);
    $ia->Save();
    redirect("?action=ITdetail&type=iframe&itId=" . ($ia->getIt()->getItId()));
}

function inviteTeam() {
    $db = new DB();
    $it = new InvolveTeam($db);
    $it->setActId($_GET['actId']);
    $it->setTeamId($_GET['teamId']);
    $it->setStatus(InvolveTeam::STATUS_INVITED);
    $it->setType(InvolveTeam::TYPE_GUEST_TEAM);
    $it->setSelected(false);
    $it->Save();
    $act = new Activity($db, $_GET['actId']);
    $team = new Team($db, $_GET['teamId']);
    $msg = new Message($db);
    $msg->setSenderId($_SESSION['userId']);
    $msg->setSubject("Inviting of activite: " . $act . "");
    $msg->setBody("Your team: " . $team . " got a new inviting of the activity: " . $act);
    $msg->save();
    $msg->send($team->getLeader()->getLoginName());
}

function joinIT() {

    $db = new DB();
    $ia = new InvolveAccount($db);
    $ia->searchMatch(array('userId' => $_SESSION['userid'], 'itId' => $_GET['ItId']));
    if ($ia === false) {
        showErrMsg('Error');
    } else {
        if ($ia->getStatus() == InvolveAccount::STATUS_IT_REQ_USER) {
            $ia->setStatus(InvolveAccount::STATUS_ACCEPTED);
            $ia->save();
            return;
        }
    }

    $ia = new InvolveAccount($db);
    $ia->setUserId($_SESSION['userid']);
    $ia->setTeamId(0); //(to be deleted)
    $ia->setTime(0); //(to be deleted)
    $ia->setStatus(InvolveAccount::STATUS_USER_REQ_IT);
    $ia->setitId($_GET['ItId']);
    $ia->setCredit(0); //(to be deleted)
    $ia->setInfo(""); //not send
    $ia->save();
    goBack();
}

function sendInv() {
    //var_dump($_REQUEST);
    $db = new DB();
    $act = new Activity($db, $_POST["actId"]);


    $teamlist = $_POST["teamlist"];
    foreach ($teamlist as $teamId) {
        $t = new Team($db, $teamId);
        $it = new InvolveTeam($db);
        $it->setActId($_POST["actId"]);
        $it->setTeamId($t->getTeamId());
        $it->setStatus(InvolveTeam::STATUS_INVITED);
        $it->save();

        $msg = new Message($db);
        $msg->setSenderId($_SESSION["userId"]);
        $msg->setSubject("Activity Invitation: " . $act->getName());
        $body = <<<EOD
        You team (<a href="javascript:showTeam({$t->getTeamId()})">{$t->getChiName()}({$t->getEngName()})</a>)
        were invitated to join the activity <a href="javascript:showActivity({$act->getActId()})">{$act->getName()}</a>
        created by <a href="javascript:showAccount('{$act->getOwner()->getLoginName()}')">{$act->getOwner()->getNickName()}</a>
        <br><br>
        <a href="javascript:showAccount('{$act->getOwner()->getLoginName()}')">{$act->getOwner()->getNickName()}</a> said:<br>
            <div style="border:solid 1px #000000">{$_POST["msg"]}</div>
        <br><br>
        Please click <a href="activity.php?action=teamAcceptInvitation&amp;itId={$it->getItId()}">here</a> to accept this invitation.
        <br>or<br>
        Please click <a href="activity.php?action=teamRejectInvitation&amp;itId={$it->getItId()}">here</a> to reject this invitation.
EOD;
        $msg->setBody($body);
        $msg->Save();
        $msg->send($t->getLeader()->getLoginName());
    }
    showMsg("message sent.");
}

function cancelActivity() {
    $db = new DB();
    $act = new Activity($db, $_POST['actId']);
    $act->setStatus(Activity::STATUS_CANCELLED);
    $act->Save();
    $sendingList = $act->getAllInvolveAccountAccount();

    $it = new InvolveTeam($db);
    $it = $it->searchf(array(
                'field_list' => array(
                    'actId' => $_POST['actId'],
                    'status' => array("<>", InvolveTeam::STATUS_REJECTED)
                )
            ));
    foreach ($it as $v) {
        $sendingList[] = $v->getTeam()->getLeader();
    }
    foreach ($sendingList as &$v) {
        $v = $v->getLoginName();
    }
    $sendingList = array_unique($sendingList);
    $msg = new Message($db);
    $msg->setSenderId($_SESSION["userId"]);
    $msg->setSubject("Activity Cancelled: " . $act->getName());
    $body = <<<EOD
        The activity <a href="javascript:showActivity({$act->getActId()})">{$act->getName()}</a>
        (created by <a href="javascript:showAccount('{$act->getOwner()->getLoginName()}')">{$act->getOwner()->getNickName()}</a>)
        is cancelled.
EOD;
    $msg->setBody($body);
    $msg->Save();
    $msg->send($sendingList);
    showMsg("Activity cancelled, and notificated related member.");
}

function teamAcceptInvitation() {
    $db = new DB();
    $it = new InvolveTeam($db);
    $it=$it->searchMatch(array('itId' => $_GET['itId']));
    if ($it=== false) {
        showErrMsg('Error');
    } else {
        if ($it->getStatus() == InvolveTeam::STATUS_INVITED) {
            $it->setStatus(InvolveTeam::STATUS_PRIVATE);
            $it->save();
        }
    }
    goBack();
}
function teamRejectInvitation() {
    $db = new DB();
    $it = new InvolveTeam($db);
    $it=$it->searchMatch(array('itId' => $_GET['itId']));
    if ($it === false) {
        showErrMsg('Error');
    } else {
        if ($it->getStatus() == InvolveTeam::STATUS_INVITED) {
            $it->setStatus(InvolveTeam::STATUS_REJECTED);
            $it->save();
        }
    }
    goBack();
}

function sendMemberInv() {
    //var_dump($_REQUEST);
    $db = new DB();
    $it = new InvolveTeam($db, $_POST["itId"]);
    $act = $it ->getAct();
    $t = $it ->getTeam();
    $memlist = $_POST["memlist"];
    foreach ($memlist as $acId) {
        $ac = new Account($db, $acId);
        $ia = new InvolveAccount($db);
        $ia->setitId($_POST["itId"]);
        $ia->setactId($it->getActId());
        $ia->setUserId($acId);
        $ia->setTeamId($it->getTeamId());
        $ia->setTime(0);
        $ia->setCredit(0);
        $ia->setinfo("");
        $ia->setStatus(InvolveAccount::STATUS_IT_REQ_USER);
        $ia->save();

        $msg = new Message($db);
        $msg->setSenderId($_SESSION["userId"]);
        $msg->setSubject("Activity Invitation: " . $act->getName());
        $body = <<<EOD

        The team leader of the team <a href="javascript:showTeam({$t->getTeamId()})">{$t->getChiName()}({$t->getEngName()})</a>
        invited you to join the one of the <a href="javascript:showAttendeeList({$it -> getItId()})">attendee list</a> of the activity(<a href="javascript:showActivity({$act -> getActId()})">{$act->getName()}</a>).

        <br><br>
        you team leader said:<br>
            <div style="border:solid 1px #000000">{$_POST["msg"]}</div>
        <br><br>
        Please click <a href="activity.php?action=memberAcceptInvitation&amp;iaId={$it->getItId()}">here</a> to accept this invitation.
        <br>or<br>
        Please click <a href="activity.php?action=memberRejectInvitation&amp;iaId={$it->getItId()}">here</a> to reject this invitation.
EOD;
        //TODO:The above letter to be complete
        $msg->setBody($body);
        $msg->Save();
        $msg->send($t->getLeader()->getLoginName());
    }
    showMsg("message sent.");
}
function memberAcceptInvitation() {
    $db = new DB();
    $ia = new InvolveAccount($db);
    $ia=$ia->searchMatch(array('iaId' => $_GET['iaId']));
    if ($ia === false) {
        showErrMsg('Error');
    } else {
        if ($ia->getStatus() == InvolveAccount::STATUS_IT_REQ_USER) {
            $ia->setStatus(InvolveAccount::STATUS_ACCEPTED);
            $ia->save();
        }
    }
    goBack();
}

function memberRejectInvitation() {
    $db = new DB();
    $ia = new InvolveAccount($db);
    $ia=$ia->searchMatch(array('iaId' => $_GET['iaId']));
    if ($ia === false) {
        showErrMsg('Error');
    } else {
        if ($ia->getStatus() == InvolveAccount::STATUS_IT_REQ_USER) {
            $ia->setStatus(InvolveAccount::STATUS_USER_REJ_IT);
            $ia->save();
        }
    }
    goBack();
}

function getAccountFCBKList(){
    $db = new DB();
    $a = new Account($db);
    $tag = $_GET['tag'];
    $a = $a->searchf(array(
                'field_list' => array(
                    'loginName' => array('like',"%$tag%"),
                    'nickName' => array('like', "%$tag%"),
                ),
                'glue' => 'or',
                'range' => array(0, 10)
            ));
    $result = array();
    foreach ($a as $v) {
        $result[] = array("key" => $v->getUserId(), "value" => $v->getLoginName() . ", " . $v->getNickName());
    }
    echo json_encode($result);
}
