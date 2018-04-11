<?php
require_once './inc/common.inc.php';
include './inc/pointconf.inc.php';
requireLogin();

if (empty($_GET["action"])){
	$db = new DB();
	//$selected=InvolveTeam::STATUS_SELECTED;
	
//    $SQLL = "CREATE or REPLACE VIEW V_COMMENT AS Select it.actid as actid, it.itid as itid, it.teamId as teamId, t.leaderid as leaderid from team t, involveteam it where it.selected=1 and t.teamid=it.teamid";

    $SQLL = "select * from V_COMMENT v, Activity a, Team t where v.actId=a.actId and t.teamId=v.teamId and t.leaderid={$_SESSION['userid']}";
    $result = $db->query($SQLL); 
    $leafnodes = array();
    while ($rw = $db->fetch_array($result)) {
		$leafnodes[] = array('actId'=>$rw[actId],'actName'=>$rw[name],'chiteamName'=>$rw[chiname],'engteamName'=>$rw[engname],'itId'=>$rw[itid]);
    }
  	$v = new View();
	$v->assign("lists", $leafnodes);
	$v->display("comment.htm");
}else if($_GET['action']=="listopponentTeam"){
		$db = new DB();
	//$SQLL = "select * from V_COMMENT v, Activity a, Team t where v.actId=a.actId and t.teamId=v.teamId and v.actId=".$_GET[actId]." and v.itId<>".$_GET[itId]." and t.leaderid<>{$_SESSION['userid']}";
	$SQLL = "select * from V_COMMENT v, Activity a, Team t where v.actId=a.actId and t.teamId=v.teamId and v.actId=".$_GET['actId']." and v.itId<>".$_GET['itId'];
    $result = $db->query($SQLL); 
    $leafnodes = array();
    while ($rw = $db->fetch_array($result)) {
		$leafnodes[] = array('actId'=>$rw[actId],'actName'=>$rw[name],'chiteamName'=>$rw[chiname],'engteamName'=>$rw[engname],'itId'=>$rw[itid]);
		$actName=$rw[name];
		$ownerId=$rw[ownerId];
	}
	$SQLL = "select * from Account where userId=".$ownerId;
	$result = $db->query($SQLL); 
	while ($rw = $db->fetch_array($result)) {
		$ownerNickName=$rw[nickName];
		$ownerLoginName=$rw[loginName];
		break;
	}
  	$v = new View();
	$v->assign("ownerId",$ownerId);
	$v->assign("ownerNickName",$ownerNickName);
	$v->assign("ownerLoginName",$ownerLoginName);
	$v->assign("actId",$_GET['actId']);
	$v->assign("actName",$actName);
	$v->assign("selfItId",$_GET['itId']);
	$v->assign("lists", $leafnodes);
	$v->assign("hiddenCount",count($leafnodes));
	$v->display("comment_oppTeamList.htm");
}else if($_GET['action']=="saveComment"){
	$db = new DB();

	$count=$_POST['hiddenCount'];
	$actId=$_POST['actId'];
	$fromId=$_SESSION['userid'];
	for($i = 1; $i <= $count; $i++){
		$giveCredit=$_POST['giveCredit'.$i];
		$comment=$_POST['comment'.$i];
		$itId=$_POST['hiddenItId'.$i];
		if(($giveCredit!="")&&($comment!="")){
			
			$SQLL = "select * from InvolveAccount where actId=".$actId." and itId=".$itId;
			$result = $db->query($SQLL); 
			while ($rw = $db->fetch_array($result)) {
				$toId=$rw[userId];
				
				$c = new Comment($db);
				$c->setFromId($fromId);
				$c->setToId($toId);
				$c->setComment($comment);
				$c->setValue($giveCredit);
				$c->setActId($actId);
				$c->save();
				
				switch($giveCredit){
					case 1;
						$changeCredit=$pointconf["pos_cm"]["c"];
						$changePoint=$pointconf["pos_cm"]["p"];
						break;
					case 0;
						$changeCredit=$pointconf["neu_cm"]["c"];
						$changePoint=$pointconf["neu_cm"]["p"];
						break;
					case -1;
						$changeCredit=$pointconf["neg_cm"]["c"];
						$changePoint=$pointconf["neg_cm"]["p"];
						break;
				}
				//echo 'itId='.$itId.' giveCredit='.$giveCredit.' comment='.$comment.' Credit+/-='.$changeCredit.' Point+/-='.$changePoint.'</br>';
				$acc = new Account($db,$toId);
				$acc->setCredit($acc->getCredit()+$changeCredit);
				$acc->setPoint($acc->getPoint()+$changePoint);
				$acc->save();
			}
		}
	}
	$SQLL = "select * from V_COMMENT v, Activity a, Team t where v.actId=a.actId and t.teamId=v.teamId and v.actId=".$actId." and v.itId<>".$itId;
    $result = $db->query($SQLL); 
    while ($rw = $db->fetch_array($result)) {
		$ownerId=$rw[ownerId];
		break;
	}
				$c = new Comment($db);
				$c->setFromId($fromId);
				$c->setToId($ownerId);
				$c->setComment($_POST['comment0']);
				$c->setValue($_POST['giveCredit0']);
				$c->setActId($actId);
				$c->save();
				
				switch($_POST['giveCredit0']){
					case 1;
						$changeCredit=$pointconf["pos_cm"]["c"];
						$changePoint=$pointconf["pos_cm"]["p"];
						break;
					case 0;
						$changeCredit=$pointconf["neu_cm"]["c"];
						$changePoint=$pointconf["neu_cm"]["p"];
						break;
					case -1;
						$changeCredit=$pointconf["neg_cm"]["c"];
						$changePoint=$pointconf["neg_cm"]["p"];
						break;
	}
	
				$acc = new Account($db,$ownerId);
				$acc->setCredit($acc->getCredit()+$changeCredit);
				$acc->setPoint($acc->getPoint()+$changePoint);
				$acc->save();
	
			$involveTeam=new InvolveTeam($db,$_POST['selfItId']);
			$involveTeam->setStatus(InvolveTeam::STATUS_COMMENTED);
			$involveTeam->save();
			header("location:comment.php");
}
?>
