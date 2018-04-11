<?

/*
 * Join whole team version
 * remember change view filename if change version
 */

require_once './inc/common.inc.php';
if (empty($_GET["action"])) {
    $v = new View();
    $db = new DB();
    $a = new ActivityType($db);
    $v->assign("activityType", $a->getList());
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->display("activityList.htm");
    die();
} else if ($_GET["action"] == "getActivityList") {
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
} else if ($_GET["action"] == "viewDetail") {

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
} else if ($_GET['action'] == "ask") {
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
} else if ($_GET['action'] == "answer") {
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
} else if ($_GET['action'] == 'create') {
    requireLogin();
    $v = new View();
    $db = new DB();
    $a = new ActivityType($db);
    $v->assign("activityType", $a->getList());
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->assign("createActTicket", NewTicket("createActTicket"));
    $v->display("activity_create.htm");
} else if ($_GET['action'] == 'getVenueList') {
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
} else if ($_GET['action'] == 'getCreateTeamList') {
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
} else if ($_GET['action'] == "saveCreateActivity") {
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
} else if ($_GET['action'] == 'newteam') {

    $db = new DB();
    $activity = new Activity($db, $_GET['actId']);

    $v = new View();

    $v->assign("activity", $activity);
    $v->display("activity_newteam.htm");
} else if ($_GET['action'] == 'newteamsave') {
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
    redirect("?action=viewDetail&type=iframe&actId=" . $_POST['actId']);
} elseif ($_GET['action'] == 'acceptIt') {
    $db = new DB();
    $it = new InvolveTeam($db, $_GET['itId']);
    $it->setStatus(InvolveTeam::STATUS_SELECTED);
    $it->Save();
    $t=$it->getTeam();
    $member=$t->getMemberAccounts();
    foreach($member as $v){
        $ia=new InvolveAccount($db);
        $ia->setActId($it->getAct()->getActId());
        $ia->setUserId($v->getUserId());
        $ia->setItId($it->getItId());
        $ia->Save();
    }
    redirect("?action=viewDetail&type=iframe&activityid=".$it->getAct()->getActId());
}
?>