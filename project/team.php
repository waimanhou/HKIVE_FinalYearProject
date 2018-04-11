<?
//TODO: permission check
require_once './inc/common.inc.php';
if (empty($_GET["action"])) {
    $v = new View();
    $db = new DB();
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->display("team_list.htm");
    die();
} else if ($_GET['action'] == 'getList') {
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    $db = new DB();
    $page = intval($_GET['page']); // get the requested page
    $limit = intval($_GET['rows']); // get how many rows we want to have into the grid
    $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
    $sord = $_GET['sord']; // get the direction

    if ($page == 0)
        $page = 1;
    if ($limit == 0)
        $limit = 30;

    $page = $page == 0 ? 1 : $page;
    $team = new Team($db);
    $sf = array();
    if ($sidx && $team->isColExists($sidx)) {
        $sf['order'] = array($sidx => $sord);
    }
    $sf['field_list'] = array();
    if (isset($_GET['type']) && $_GET['type'] != 'all') {
        $sf['field_list']['type'] = $_GET['type'];
    }
    if (isset($_GET['district']) && $_GET['district'] != 'all') {
        $sf['field_list']['distCode'] = $_GET['district'];
        if ($_GET['district'] == 'na') {
            $sf['field_list']['distCode'] = null;
        }
    }
    $sf['page'] = array($page, $limit);
    $list = $team->searchf($sf);
    $v = new View();
    $v->assign('list', $list);
    $v->assign('totalrecord', $team->getLastCount());
    $v->assign("totalpage", ceil($team->getLastCount() / $limit));
    $v->assign('page', $page);
    $v->assign('orderby', $_GET['orderby']);
    $v->display("team_xml.htm");
//    var_dump($list);
} else if ($_GET['action'] == 'viewDetail') {


    if (empty($_GET["teamId"])) {
        die();
    }

    $teamId = intval($_GET['teamId']);

    $db = new DB();
    $team = new Team($db);
    $team = $team->searchMatch(array('teamId' => $teamId));
    if ($team === false) {
        die();
    }

    $v = new View();
    $v->assign("team", $team);
    $memberAccounts = $team->getMemberAccounts();
    $v->assign("memberlist", $memberAccounts);
    $v->assign("isMember", 0);
    $v->assign("activities", $team->getActivities());
    if ($_SESSION['userId']) {
        foreach ($memberAccounts as $value) {
            if ($value->getUserId() == $_SESSION['userId']) {
                $v->assign("isMember", 1);
                break;
            }
        }
    }
    $v->assign("joinTicket", NewTicket("joinTicket_$teamId"));

    if ($team->getLeader()->getUserId() == $_SESSION['userId']) {
        $or = new OrgReq($db);
        $or = $or->searchf(array(field_list => array('teamId' => $team->getTeamId(), 'status' => array('=', array(OrgReq::
                                TYPE_ORG_REQ_TEAM, OrgReq::TYPE_TEAM_REJ_ORG)))));
        $v->assign("ors", $or);
        $v->assign("TMList", $team->getTeamMembers());

        $v->assign("leaderTicket", NewTicket("leaderTicket_$teamId"));
        $v->assign("leaderTicket2", NewTicket("leaderTicket2"));
        $v->assign("invitationTicket", NewTicket("invitationTicket"));
    }
    $b = new District($db);
    $v->assign("allDistrict", $b->getList());
    $v->display("team_detail.htm");
} else if ($_GET['action'] == "updateDetail") {
    $db = new DB();
    $team = new Team($db, $_POST['teamId']);
    $team->setChiName($_POST['chiName']);
    $team->setEngName($_POST['engName']);
    $team->setDistCode($_POST['district']);
    $team->setUrl($_POST['url']);
    $team->setSlogan($_POST['slogan']);
    $team->setType($_POST['teamtype']);
    $team->setDescription($_POST['description']);
    $team->save();
    if ($_FILES["logo"]["error"] == 0) {
        $h = new SingleImageUploadHandler("logo");
        $h->saveAs(ROOT . "/images/userfile/teams/{$_POST['teamId']}/logo128.jpg", 128, 128);
        $h->saveAs(ROOT . "/images/userfile/teams/{$_POST['teamId']}/logo64.jpg", 64, 64);
        $h->saveAs(ROOT . "/images/userfile/teams/{$_POST['teamId']}/logo32.jpg", 32, 32);
    }


    header("location:team.php?action=viewDetail&type=iframe&teamId=" . $_POST['teamId']);
} else if ($_GET['action'] == "joinrequest") {
    if (empty($_GET["teamId"])) {
        die();
    }
    $teamId = intval($_GET['teamId']);
    checkTicket("joinTicket_$teamId", "ticket", "GET");
    $db = new DB();
    $team = new Team($db);
    $team = $team->searchMatch(array('teamId' => $teamId));
    if ($team === false) {
        die();
    }
    $tm = new TeamMember($db);
    $a = $tm->searchf(array('field_list' => array('teamId' => $teamId, 'userId' => $_SESSION['userId'])));
    if ($tm->getLastCount() == 0) {
        $tm->setTeamId($teamId);
        $tm->setUserId($_SESSION['userId']);
        $tm->setType(TeamMember::TYPE_USER_REQ_TEAM);
        $tm->Save();
        $m = new Message($db);
        $a = new Account($db, $_SESSION['userId']);
        $m->setSenderId($_SESSION['userId']);
        $m->setSubject("Your team [" . $team->getChiName() . "] received a join request from the member [" . $a->getLoginName() . "]");
        $m->setBody("Your team [" . $team->getChiName() . ", " . $team->getEngName() . "] received a join request from the member [" . $a->getLoginName() . "] (nickname: " . $a->getNickName() . ", Chinese Name: " . $a->getChiName() . ", English Name: " . $a->getEngName() . ")");
        $m->Save();
        $m->send($team->getLeader()->getLoginName());
        showMsg("Join request sent.");
    } else {

        $tm = $tm->searchMatch(array('teamId' => $teamId, 'userId' => $_SESSION['userId'], 'type' => TeamMember::TYPE_TEAM_REQ_USER));
        if ($tm === FALSE) {
            showErrMsg("Cannot send join request.");
        }
        $tm->setType(TeamMember::TYPE_JOINED);
        $tm->Save();
        showMsg("Joined.");
    }
} else if ($_GET['action'] == 'acceptReq' || $_GET['action'] == 'rejectReq' || $_GET['action'] == 'deleteReq') {
    checkTicket("leaderTicket2", "ticket", "GET");
    if (empty($_GET['tmId'])) {
        die();
    }
    $tmId = intval($_GET['tmId']);
    $db = new DB();
    $tm = new TeamMember($db);
    $tm = $tm->searchMatch(array("tmId" => $tmId));
    if ($tmId === false) {
        die();
    }
    if ($_GET["action"] == "deleteReq") {
        $tm->delete();
    } else {
        $tm->setType($_GET['action'] == 'acceptReq' ? TeamMember::TYPE_JOINED : TeamMember::TYPE_TEAM_REJ_USER);
    }
    $tm->Save();

    $tm->getTeam()->updateNoOfPlayer(true);

    redirect("?type=iframe&action=viewDetail&teamId=" . $tm->getTeamId() . "#tabs-4");
    //TODO: Message notification
} else if ($_GET["action"] == "sendInv") {
    checkTicket("invitationTicket", "ticket", "GET");
    if (empty($_GET["loginname"]) || empty($_GET["teamId"])) {
        die();
    }

    $db = new DB();
    $a = new Account($db);
    $a = $a->searchMatch(array("loginName" => $_GET["loginname"]));
    if ($a === false) {
        showErrMsg("Login name not fount");
    }

    $tm = new TeamMember($db);
    if ($tm->searchMatch(array("teamId" => $_GET["teamId"], "UserId" => $a->getUserId()))) {
        showErrMsg("Error Occured"); //TODO:change it
    }

    $tm->setTeamId($_GET["teamId"]);
    $tm->setUserId($a->getUserId());
    $tm->setType(TeamMember::TYPE_TEAM_REQ_USER);
    $tm->Save();
    $t = $tm->getTeam();

    $msg = new Message($db);
    $msg->setSenderId($_SESSION["userId"]);
 //   var_export($t);
    //echo $t->getEngName();
    //echo $t->getChiName();die();
    $msg->setSubject("Join Team Invitation: {$t->getEngName()} ({$t->getChiName()})");
    $body = <<<EOD
        The team <a href="javascript:showTeam({$t->getTeamId()})">{$t->getChiName()}. {$t->getEngName()}</a>
        (lead by <a href="javascript:showAccount('{$t->getLeader()->getUserId()}')">{$t->getLeader()->getNickName()}</a>)
        sent you a join team invitation. Please click <a href="account.php#tabs-6">here</a> to response this invitation
EOD;
    $msg->setBody($body);
    $msg->Save();
    $msg->send($a->getLoginName());

//    redirect("?type=iframe&action=viewDetail&teamId=" . $tm->getTeamId() . "#tabs-4");
    goBack();
} else if ($_GET['action'] == 'delTM') {
    $db = new DB();
    $tm = new TeamMember($db);
    $tm = $tm->searchMatch(array('teamId' => $_GET['teamId'], 'userId' => $_GET['userId']));
    if ($tm) {
        $tm->delete();
        $tm->Save();
        $tm->getTeam()->updateNoOfPlayer(true);
    }
    redirect("?type=iframe&action=viewDetail&teamId=" . $tm->getTeamId() . "#tabs-4");
} else if ($_GET['action'] == 'createteam') {
    $v = new View();
    $db = new DB();
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->display('team_create_form.htm');
} else if ($_GET['action'] == 'saveCreateNewTeam') {
    $db = new DB();
    $t = new Team($db);
    $t->setChiName($_POST['chiName']);
    $t->setEngName($_POST['engName']);
    $t->setUrl($_POST['url']);
    $t->setDistCode($_POST['district'] == "na" ? null : $_POST['district']);
    $t->setType($_POST["type"] == "PUBLIC" ? Team::TYPE_PUBLIC : Team::TYPE_PRIVATE);
    $t->setSlogan($_POST["Slogan"]);
    $t->setDescription($_POST["description"]);
    $t->setLeaderId($_SESSION['userId']);
    $t->Save();
    redirect("?");
} else if ($_GET["action"] == "acceptReqOR" || $_GET['action'] == 'rejectReqOR' || $_GET['action'] == 'deleteReqOR') {

    if (empty($_GET['orId'])) {
        die();
    }
    $orId = intval($_GET['orId']);
    $db = new DB();
    $or = new OrgReq($db);
    $or = $or->searchMatch(array("InvId" => $orId));
    if ($or === false) {
        die('Error');
    }
    if ($_GET["action"] == "deleteReqOR") {
        $or->delete();
    } else {
        $or->setStatus($_GET['action'] == 'acceptReqOR' ? OrgReq::TYPE_JOINED : OrgReq::TYPE_TEAM_REJ_ORG);
    }
    if($_GET["action"]=="acceptReqOR"){
        $team=$or->getTeam();
        $team->setOrgId($or->getOrgId());
        $team->Save();
    }
    $or->Save();
    $or->getOrg()->updateNoOfTeamAndPlayer(true);


    redirect("team.php?action=viewDetail&type=iframe&teamId={$or->getTeam()->getTeamId()}#tabs-5");
} else if ($_GET["action"] == "getFCBKList") {
    /* echo <<<EOD
      [{"key": "movies", "value": "movies"}, {"key": "ski", "value": "ski"}, {"key": "snowbord", "value": "snowbord"}, {"key": "computer", "value": "computer"}, {"key": "apple", "value": "apple"}, {"key": "pc", "value": "pc"}, {"key": "ipod", "value": "ipod"}, {"key": "ipad", "value": "ipad"}, {"key": "iphone", "value": "iphone"}, {"key": "iphon4", "value": "iphone4"}, {"key": "iphone5", "value": "iphone5"}, {"key": "samsung", "value": "samsung"}, {"key": "blackberry", "value": "blackberry"}]
      EOD; */
    $db = new DB();
    $t = new Team($db);
    $tag = $_GET['tag'];
    $t = $t->searchf(array(
                'field_list' => array(
                    'chiName' => array('like', "%$tag%"),
                    'engName' => array('like', "%$tag%")
                ),
                'glue' => 'or',
                'range' => array(0, 10)
            ));
    $result = array();
    foreach ($t as $v) {
        $result[] = array("key" => $v->getTeamId(), "value" => $v->getChiName() . ", " . $v->getEngName());
    }
    echo json_encode($result);
}
?>