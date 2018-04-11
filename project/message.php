<?

/*
  TODO: send check, move msg, security, create/rename/delete/move folder
  _________ _______  ______   _______
  \__   __/(  ___  )(  __  \ (  ___  )
  .  ) (   | (   ) || (  \  )| (   ) |
  .  | |   | |   | || |   ) || |   | |   O
  .  | |   | |   | || |   | || |   | |
  .  | |   | |   | || |   ) || |   | |   O
  .  | |   | (___) || (__/  )| (___) |
  .  )_(   (_______)(______/ (_______)

  _______  _______  _        ______     _______           _______  _______  _
  (  ____ \(  ____ \( (    /|(  __  \   (  ____ \|\     /|(  ____ \(  ____ \| \    /\
  | (    \/| (    \/|  \  ( || (  \  )  | (    \/| )   ( || (    \/| (    \/|  \  / /
  | (_____ | (__    |   \ | || |   ) |  | |      | (___) || (__    | |      |  (_/ /
  (_____  )|  __)   | (\ \) || |   | |  | |      |  ___  ||  __)   | |      |   _ (
  .     ) || (      | | \   || |   ) |  | |      | (   ) || (      | |      |  ( \ \
  /\____) || (____/\| )  \  || (__/  )  | (____/\| )   ( || (____/\| (____/\|  /  \ \
  \_______)(_______/|/    )_)(______/   (_______/|/     \|(_______/(_______/|_/    \/
  _______  _______           _______    _______  _______  _______
  (       )(  ___  )|\     /|(  ____ \  (       )(  ____ \(  ____ \
  | () () || (   ) || )   ( || (    \/  | () () || (    \/| (    \/
  | || || || |   | || |   | || (__      | || || || (_____ | |
  | |(_)| || |   | |( (   ) )|  __)     | |(_)| |(_____  )| | ____
  | |   | || |   | | \ \_/ / | (        | |   | |      ) || | \_  )
  | )   ( || (___) |  \   /  | (____/\  | )   ( |/\____) || (___) |
  |/     \|(_______)   \_/   (_______/  |/     \|\_______)(_______)
  _______  _______  _______           _______ __________________
  (  ____ \(  ____ \(  ____ \|\     /|(  ____ )\__   __/\__   __/|\     /|
  | (    \/| (    \/| (    \/| )   ( || (    )|   ) (      ) (   ( \   / )
  | (_____ | (__    | |      | |   | || (____)|   | |      | |    \ (_) /
  (_____  )|  __)   | |      | |   | ||     __)   | |      | |     \   /
  .     ) || (      | |      | |   | || (\ (      | |      | |      ) (
  /\____) || (____/\| (____/\| (___) || ) \ \_____) (___   | |      | |
  \_______)(_______/(_______/(_______)|/   \__/\_______/   )_(      \_/

 */
require_once './inc/common.inc.php';

//NewTicket("asdf");
//checkTicket($ticket_name);

requireLogin();
if (empty($_GET["q"])) {

    $f = array();
    getFolders($f, null, 0);

    $tree = array();
    foreach ($f as $k => $v) {
        $tree[] = array("id" => $v[0]->getFolderId(), "level" => $v[1], "name" => $v[0]->getName(), "prefix" => str_repeat("&nbsp; ", $v[1]));
    }


    $v = new View();
    $v->assign("tree", $tree);
    $v->display("message.htm");
} else if ($_GET['q'] == "getfoldertree") {
    $db = new DB();

    // First we need to determine the leaf nodes
    $SQLL = "SELECT t1.folderId FROM msgfolder AS t1 LEFT JOIN msgfolder as t2 ON t1.folderId = t2.parentfolderId WHERE t2.folderId IS NULL and t1.userId={$_SESSION['userid']}";
    $result = $db->query($SQLL); // or die("Couldn t execute query.".mysql_error());
    $leafnodes = array();
    while ($rw = $db->fetch_array($result)) {
        $leafnodes[$rw['folderId']] = $rw['folderId'];
    }

    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    $folders = array();
    getFolders($folders, null, 0);
    $v = new View();
    $v->assign("list", $folders);
    $v->display("message_foldertree_xml.htm");
} else if ($_GET['q'] == "getFolderMessage") {
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    if (empty($_GET['folderid'])

        )die();
    //echo 123;
    $db = new DB();
    $msgFolder = new MsgFolder($db, $_GET['folderid']);
    $messages = $msgFolder->getMsg();

    $page = intval($_GET['page']); // get the requested page
    $limit = intval($_GET['rows']); // get how many rows we want to have into the grid
    $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
    $sord = $_GET['sord']; // get the direction

    if (count($messages) > 0) {
        $total_pages = ceil(count($messages) / $limit);
    } else {
        $total_pages = 0;
    }
    if ($page > $total_pages)
        $page = $total_pages;
    $start = $limit * $page - $limit; // do not put $limit*($page - 1)

    $messages = array_chunk($messages, $limit);
    $messages = $messages[$page - 1];
    $read = array();
    foreach ($messages as $k => $v) {
        $r = new MsgMap($db, array('folderId' => $msgFolder->getFolderId(), 'msgId' => $v->getMsgId()));
        $read[$k] = $r->getState();
    }

    $v = new View();
    $v->assign("page", $page);
    $v->assign("total", $total_pages);
    $v->assign("records", count($messages));
    $v->assign("list", $messages);
    $v->assign("read", $read);
    //$v->assign("folder", $msgfolder->getFolderId());
    $v->display("message_folderMsg_xml.htm");
} else if ($_GET['q'] == "getMessage") {
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    if (empty($_GET['messageId'])

        )die();
    $db = new DB();

    $msg = new Message($db, $_GET['messageId']);
    if (!$msg->isReceiver($_SESSION['userid'])

        )die();
    $msgmap = $msg->getMsgMap($_SESSION["userid"]);
    $msgmap->setState(1);
    $msgmap->save();

    $v = new View();
    $v->assign("msg", $msg);
    $v->display("message_message_xml.htm");
}else if ($_GET['q'] == "delMessage") {
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    if (empty($_GET['messageId'])

        )die();
    $db = new DB();
    $msg = new Message($db, $_GET['messageId']);
    if (!$msg->isReceiver($_SESSION['userid'])

        )die();
    $msgmap = $msg->getMsgMap($_SESSION["userid"]);
    $msgmap->delete();
    $msgmap->save();
}else if ($_GET['q'] == "makeAsUnreadMessage") {
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    if (empty($_GET['messageId'])

        )die();
    $db = new DB();

    $msg = new Message($db, $_GET['messageId']);
    if (!$msg->isReceiver($_SESSION['userid'])

        )die();
    $msgmap = $msg->getMsgMap($_SESSION["userid"]);
    $msgmap->setState(0);
    $msgmap->save();
}else if ($_GET['q'] == "addMessage") {
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    if (empty($_POST['receiver']) || empty($_POST['title'])

        )die();
    $db = new DB();

    $msg = new Message($db);
    $msg->setSenderId($_SESSION['userid']);
    $msg->setSubject($_POST['title']);
    $msg->setBody($_POST['bodyeditor']);
    $msg->save();
    $msg->send($_POST["receiver"]);
}else if ($_GET['q'] == "getJSONFolderTree") {
    /*$f = array();
    getFolders($f, null, 0);

    $tree = array();
    foreach ($f as $k => $v) {
        $tree[] = array("id" => $v[0]->getFolderId(), "level" => $v[1], "name" => $v[0]->getName(), "prefix" => str_repeat("&nbsp; ", $v[1]));
    }
    echo json_encode($tree);
    //print_r($tree);
    /* foreach($tree as $v){
      echo $v['prefix'].$v['name'].'('.$v['id'].')<br>';
      } */
    //$root = array($mf->searchMatch(array("parentFolderId" => null, "userId" => $_SESSION['userid'])));
}else if($_GET['q']=="moveMessage"){
    $db=new DB();
    $msg=new Message($db, $_GET['msgId']);
    $mm=$msg->getMsgMap($_SESSION['userid']);
    $mm->setFolderId($_GET['folderId']);
    $mm->Save();
    
}else if($_GET['q']=="createfolder"){
    $db=new DB();
    $mf=new MsgFolder($db);
    $mf->setName($_POST['foldername']);
    $mf->setUserId($_SESSION['userid']);
    $mf->setParentFolderId($_POST['toFolder']);
    $mf->Save();
}else if($_GET['q']=="movefolder"){
    $db=new DB();
    $mf=new MsgFolder($db, $_POST['fromFolder']);
    $mf->setParentFolderId($_POST['toFolder']);
    $mf->save();
}else if($_GET['q']=="renamefolder"){
    $db=new DB();
    $mf=new MsgFolder($db,$_POST['fromFolder']);
    $mf->setName($_POST['newname']);
    $mf->save();
}else if($_GET['q']=="deletefolder"){
    $db=new DB();
    $mf=new MsgFolder($db, $_POST['fromFolder']);
    $mf->delete();
    $mf->save();
}

function getFolders(&$folders, $parent, $level) {
    global $leafnodes;
    global $db;
    global $_SESSION;
    $root = false;
    if ($parent == null) {
        $db = new DB();
        $mf = new MsgFolder($db);
        $subfolders = array($mf->searchMatch(array("parentFolderId" => null, "userId" => $_SESSION['userid'])));
    } else {
        $subfolders = $parent->getSubFolder();
    }
    foreach ($subfolders as $k => $v) {

        if (($v->getFolderId()) == $leafnodes[$v->getFolderId()]) {
            $leaf = 'true';
        } else {
            $leaf = 'false';
        }

        if ($parent == null) {
            $valp = 'NULL';
        } else {
            $valp = $parent->getFolderId();
        }
        $folders[] = array($v, $level, $leaf, $valp);
        getFolders($folders, $v, $level + 1);
    }
}

?>
