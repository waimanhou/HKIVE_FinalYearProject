<?

require_once './inc/common.inc.php';

if (!DEBUG_MODE) {
    Header("HTTP/1.1 404 Not Found");
    die();
}
if ($_GET['action'] == "clearsqllog") {

    if (file_exists("inc/_logs/.ht.SQL log from class.DB.php.htm")) {
        unlink("inc/_logs/.ht.SQL log from class.DB.php.htm");
    }
    header("location:?action=displaylog");
    die();
}
if ($_GET['action'] == "displaylog") {

    echo '<a href=?>BACK</a> <a href="?action=clearsqllog">clear SQL log</a><br>';
    if (file_exists("inc/_logs/.ht.SQL log from class.DB.php.htm")) {
        echo(join(file("inc/_logs/.ht.SQL log from class.DB.php.htm")));
    }
    die();
}
if ($_GET['action'] == "displayErrLog") {
    echo "<a href=?>BACK</a> ";
    echo "<a href=?action=clearErrLog>clear error log</a><hr>";

    if (!file_exists("inc/_logs/MySQL_Error_log.php")) die();
    
    $log = array();
    include "inc/_logs/MySQL_Error_log.php";
    //var_dump($log);
    foreach ($log as $k => $v) {
        //echo $v;
        echo "<b>{$v[0]} {$v[1]} {$v[2]}</b><br>";

        foreach ($v[3] as $kk => $vv) {
            foreach ($vv as $kkk => $vvv) {
                $$kkk = $vvv;
            }
            $code = file($file);
            $code = addslashes(trim($code[$line - 1]));
            echo "<div title=\"Source Code: $code\"><a href='$file'>$file</a>:$line<br>&nbsp;&nbsp;&nbsp;&nbsp;";
            echo htmlspecialchars("    $class$type$function(\"" . join(",", $args) . "\")");
            echo "</div>";
        }
        echo "<hr>";
    }
    die();
}
if ($_GET['action'] == "clearErrLog") {
    if (file_exists("inc/_logs/MySQL_Error_log.php")) {
        unlink("inc/_logs/MySQL_Error_log.php");
    }
    header("location:?action=displayErrLog");
    die();
}
?>
<title>FindSport Debug Panel</title>
<h1><?=$_SERVER['SERVER_NAME']?></h1>
<a href="./">HOME</a>
<a href="?action=displaylog">SQL Log</a>
<a href="?action=clearsqllog">(clear)</a>
<a href="?action=displayErrLog">Error Log</a>
<a href="?action=clearErrLog">(clear)</a>
<?

$ea = new EmailActivation(new DB());
$result = $ea->search("", false, "", "OR", true, -1);
echo "<h1>Activation Link:</h1><pre>";
for ($i = 0; $i < count($result); $i++) {
    printf("%10s %d <a href='/register.php?action=activate&eaId=%d&email=%s&code=%s'>%s,\t/register.php?action=activate&eaId=%d&email=%s&code=%s</a><br>",
            
            $result[$i]->getDELETED()?"(DELETED)":"",
            $result[$i]->getEaId(), $result[$i]->getEaId(),
            $result[$i]->getEmail(), $result[$i]->getCode(),
            $result[$i]->getEmail(), $result[$i]->getEaId(),
            $result[$i]->getEmail(), $result[$i]->getCode()
    );
}

?>
<h1>SESSION:</h1>
<?
var_dump($_SESSION);