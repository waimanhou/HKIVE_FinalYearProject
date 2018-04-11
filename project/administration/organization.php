<?php

require_once 'common.inc.php';

//$displayProps = array("userId", "loginName", "chiName", "engName", "point", "credit", "email", "tel1", "tel2", "lastLogin", "lastIp", "HKID", "nickName");
$m = new Mgt("Organization");
$m->addFK("DELETEDBY",new ReflectionClass("Account"));
$m->addFK("CREATEDBY",new ReflectionClass("Account"));
$m->addFK("UPDATEDBY",new ReflectionClass("Account"));

$m->addFK("creatorId",new ReflectionClass("Account"));
//$m->setDisplayProps($displayProps);
$m->run();
