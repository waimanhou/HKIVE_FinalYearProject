<?php

require_once 'common.inc.php';

$object = "Account";
//$displayProps = array("userId", "loginName", "chiName", "engName", "point", "credit", "email", "tel1", "tel2", "lastLogin", "lastIp", "HKID", "nickName");
$m = new Mgt("Account");
$m->addFK("DELETEDBY",new ReflectionClass("Account"));
$m->addFK("CREATEDBY",new ReflectionClass("Account"));
$m->addFK("UPDATEDBY",new ReflectionClass("Account"));
//$m->setDisplayProps($displayProps);
//$a=$m->
$m->hideProp("sessionId",Mgt::TYPE_LIST | Mgt::TYPE_DETAIL);
$m->hideProp("defaultMsgFolderId",Mgt::TYPE_LIST | Mgt::TYPE_DETAIL);
$m->hideProp("defaultFriendListId",Mgt::TYPE_LIST | Mgt::TYPE_DETAIL);


$m->run();


//print_r($m->getDisplayProps());