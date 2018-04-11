<?php
require_once 'common.inc.php';
if($_GET['action']=="save")
{
    copy(ROOT."/views/langs/".$_GET['lang'].".php",ROOT."/views/langs/".$_GET['lang'].".bak.php");
    $fp=fopen(ROOT."/views/langs/".$_GET['lang'].".php",'w');
    fwrite($fp,$_POST['php']);
    fclose($fp);
    echo "Saved.";
}else if($_GET['action']=="restore"){
    copy(ROOT."/views/langs/".$_GET['lang'].".bak.php",ROOT."/views/langs/".$_GET['lang'].".php");
    echo "Restored.";
}else{
    echo "<form action='translate.php?lang=".$_GET['lang']."&action=save' method=post>";
    echo "<textarea name=php cols=160 rows=40>";
    echo htmlspecialchars(implode(file(ROOT."/views/langs/".$_GET['lang'].".php"),""));
    echo "</textarea><br>";
    echo "<input type=submit>";
    echo "<input type=button value='Restore to the last backup' onclick='location=\"translate.php?lang=".$_GET['lang']."&action=restore\"'>";
    echo "</form>";
}
?>

