<?php
require_once '../inc/common.inc.php';
require_once './class.Mgt.php';
if(!$_SESSION["adminLogined"]){
    header("location: ./");
    die();
}
