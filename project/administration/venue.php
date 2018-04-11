<?php

require_once 'common.inc.php';

//$displayProps = array("userId", "loginName", "chiName", "engName", "point", "credit", "email", "tel1", "tel2", "lastLogin", "lastIp", "HKID", "nickName");
$m = new Mgt("venue");
//$m->
/*$m->addFK("DELETEDBY",new ReflectionClass("Account"));
$m->addFK("CREATEDBY",new ReflectionClass("Account"));
$m->addFK("UPDATEDBY",new ReflectionClass("Account"));*/
//$m->setDisplayProps($displayProps);
//$a=$m->

$m->setDetailViewTemplate("./view/VenueDetail.php");
$m->setNewViewTemplate("./view/VenueNew.php");
$m->run();


//print_r($m->getDisplayProps());
