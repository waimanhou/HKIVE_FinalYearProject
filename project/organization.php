<?

//TODO: permission check
require_once './inc/common.inc.php';
if (empty($_GET["action"])) {
    $v = new View();
    //$v->debugging=1;
    $db = new DB();
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->display("organization_list.htm");
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
    //$limit = ($page - 1) * 30 . ",30";
    //$venue = new Venue($db);
    $org = new Organization($db);
    /* $list = $venue->vsearch(
      array(
      //'limit' => $limit,
      'each' => $limit,
      'page' => $page,
      'orderby' => $sidx,
      'order' => $sord
      )
      ); */
    $sf = array();
    if ($sidx && $org->isColExists($sidx)) {
        $sf['order'] = array($sidx => $sord);
    }
    $sf['field_list'] = array();
//    if(isset($_GET['type']) && $_GET['type']!='all'){
//        $sf['field_list']['typeId']=$_GET['type'];
//    }
    if (isset($_GET['district']) && $_GET['district'] != 'all') {
        $sf['field_list']['distCode'] = $_GET['district'];
        if ($_GET['district'] == 'na') {
            $sf['field_list']['distCode'] = null;
        }
    }
    $sf['page'] = array($page, $limit);
    $list = $org->searchf($sf);
    $v = new View();
    $v->assign('list', $list);
    $v->assign('totalrecord', $org->getLastCount());
    $v->assign("totalpage", ceil($org->getLastCount() / $limit));
    $v->assign('page', $page);
    $v->assign('orderby', $_GET['orderby']);
    $v->display("organization_xml.htm");
//    var_dump($list);
} else if ($_GET['action'] == 'viewDetail') {


    if (empty($_GET["orgId"])) {
        die();
    }

    //$activityid = intval($_GET["activityid"]);
    $orgId = intval($_GET['orgId']);

    $db = new DB();
    //$activity = new Activity($db);
    //$activity = $activity->searchMatch(array('actId' => $activityid));

    $org = new Organization($db);
    $org = $org->searchMatch(array('orgId' => $orgId));
    if ($org === false) {
        die();
    }
    $v = new View();
    //$v->assign("activity", $activity);
    $v->assign("org", $org);

    $v->assign("ORList", $org->getOrgReqs());
    $v->assign("cTicket2", newTicket("cTicket2"));
    $v->assign("teamAct", $org->getTeamActivitiesAry());
    //$v->debugging=1;
	$dist = new District($db);
    $v->assign("allDistrict", $dist->getList());
    $v->display("organization_detail.htm");
	
} else if($_GET['action']=='updateDetail'){
	$db = new DB();
	$org = new Organization($db,$_POST['orgId']);
	$org->setChiName($_POST['chiName']);
	$org->setEngName($_POST['engName']);
	$org->setDistCode($_POST['district']);
	$org->setUrl($_POST['url']);
	$org->setSlogan($_POST['slogan']);
	$org->setType($_POST['orgtype']);
	$org->setDescription($_POST['description']);
	$org->save();
        if ($_FILES["logo"]["error"] == 0){
            $_POST['orgId']=intval($_POST['orgId']);
            $h = new SingleImageUploadHandler("logo");
            $h->saveAs(ROOT."/images/userfile/orgs/{$_POST['orgId']}/logo128.jpg", 128, 128);
            $h->saveAs(ROOT."/images/userfile/orgs/{$_POST['orgId']}/logo64.jpg", 64, 64);
            $h->saveAs(ROOT."/images/userfile/orgs/{$_POST['orgId']}/logo32.jpg", 32, 32);
        }
	header("location:organization.php?action=viewDetail&type=iframe&orgId=".$_POST['orgId']);
	
	
} else if ($_GET['action'] == 'acceptReq' || $_GET['action'] == 'rejectReq' || $_GET['action'] == 'deleteReq') {
    checkTicket("cTicket2", "ticket", "GET");
    if (empty($_GET['invId'])) {
        die();
    }
    $invId = intval($_GET['invId']);
    $db = new DB();
    $inv = new OrgReq($db);
    $inv = $inv->searchMatch(array("invId" => $invId));
    if ($invId === false) {
        die();
    }
    if ($_GET["action"] == "deleteReq") {
        $inv->delete();
    } else {
        //$tm->setType($_GET['action'] == 'acceptReq' ? TeamMember::TYPE_JOINED : TeamMember::TYPE_TEAM_REJ_USER);
        $inv->setStatus($_GET['action'] == 'acceptReq' ? OrgReq::TYPE_JOINED : OrgReq::TYPE_ORG_REJ_TEAM);
    }
    $inv->Save();

    $inv->getOrg()->updateNoOfTeamAndPlayer(true);
    redirect("?type=iframe&action=viewDetail&orgId=" . $inv->getOrgId() . "#tabs-4");
    //TODO: Message notification
} else if ($_GET['action'] == 'join') {
    $db = new DB();


    $t = new Team($db);
    $t = $t->searchf(
                    array(
                        'field_list' => array(
                            'leaderId' => $_SESSION['userId']
                        )
                    )
    );


    $v = new View();
    $v->assign("org", new Organization($db, $_GET['orgId']));
    $v->assign("teams", $t);
    $v->display("organization_join.htm");
} else if ($_GET['action'] == 'savejoin') {
    echo "asdf";
    $db = new DB();
    $orq = new OrgReq($db);
    $orq->setOrgId($_POST['orgId']);
    $orq->setTeamId($_POST['teamId']);
    $orq->setStatus(OrgReq::TYPE_TEAM_REQ_ORG);
    $orq->setReqMsg($_POST["reqMsg"]);
    $orq->Save();
    showMsg("Request sent");
} else if ($_GET['action'] == 'delTeam') {
    $db = new DB();
    $orgreq = new OrgReq($db);
    $orgreq = $orgreq->searchMatch(array('orgId' => $_GET['orgId'], 'teamId' => $_GET['teamId']));
    if ($orgreq) {
        $orgreq->delete();
    }
    $orgreq->Save();
    $orgreq->getOrg()->updateNoOfTeamAndPlayer(true);
    redirect("?type=iframe&action=viewDetail&orgId=" . $_GET['orgId']);
} else if ($_GET['action'] == 'create') {
    $v = new View();
    $db = new DB();
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->display("organization_create.htm");
}else if($_GET['action']=='saveCreateNewOrganization'){
    $db=new DB();
    $t=new Organization($db);
    $t->setChiName($_POST['chiName']);
    $t->setEngName($_POST['engName']);
    $t->setUrl($_POST['url']);
    $t->setDistCode($_POST['district']=="na"?null:$_POST['district']);
    $t->setType($_POST["type"]=="PUBLIC" ? Organization::TYPE_PUBLIC : Organization::TYPE_INVITE );
    $t->setSlogan($_POST["Slogan"]);
    $t->setDescription($_POST["description"]);
    $t->setCreatorId($_SESSION['userId']);
    $t->Save();
    redirect("?");
}else if($_GET['action']=='invitation'){
    $db=new DB();
    $org=new Organization($db,$_POST['orgId']);
    $teamlist = $_POST["teamlist"];

    foreach ($teamlist as $teamId) {
        $t = new Team($db, $teamId);
        /*$it = new InvolveTeam($db);
        $it->setActId($_POST["actId"]);
        $it->setTeamId($t->getTeamId());
        $it->setStatus(InvolveTeam::STATUS_INVITED);
        $it->save();
*/

        $or=new OrgReq($db);
        $or->setOrgId($org->getOrgId());
        $or->setTeamId($t->getTeamId());
        $or->setStatus(OrgReq::TYPE_ORG_REQ_TEAM);
        $or->setReqMsg($_POST['msg']);
        $or->Save();
        $msg = new Message($db);
        $msg->setSenderId($_SESSION["userId"]);
        $msg->setSubject("Join Organization Invitation: {$org->getEngName()} ({$org->getChiName()})");
        $body = <<<EOD
        You team (<a href="javascript:showTeam({$t->getTeamId()})">{$t->getChiName()}({$t->getEngName()})</a>)
        has received an invitation from the organization <a href="javascript:showOrg({$org->getOrgId()})">{$org->getEngName()} ({$org->getChiName()})</a>
        with the following message:
        <br><br>
            <div style="border:solid 1px #000000">{$_POST["msg"]}</div>
        <br><br>
        Please click <a href="team.php?action=viewDetail&type=iframe&teamId={$t->getTeamId()}#tabs-5">here</a> to response this invitation.

EOD;
//http://fyp/team.php?action=viewDetail&type=iframe&teamId=1
        $msg->setBody($body);
        $msg->Save();
        $msg->send($t->getLeader()->getLoginName());
    }
    goBack();

}
?>