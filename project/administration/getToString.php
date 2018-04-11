<?php
require_once 'common.inc.php';
$s=$_GET['class'];
try{
    $c=new $s(new DB(),$_GET['id']);
    echo $c->__toString();
}catch(RecordNotFoundException $e)
{
    echo "<font color=#ff0000>Record Not Found!</font>";
}
?>
