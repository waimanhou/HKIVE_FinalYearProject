<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ob_implicit_flush();
set_time_limit(1000);
include_once '../class.DB.php';
$db = new DB(false);
$db->connect(DBHOST, DBUSER, DBPW, 'fyp', DBCHARSET, DBPCONNECT, DBTABLEPRE);
$db2 = new DB();

$a = $db->fetch_all("show tables");
$b = $db2->fetch_all("show tables");
$tables = array();
foreach ($a as $k => $v) {
    $tables[strtolower($v['Tables_in_fyp'])] = array(1, 0);
}
foreach ($b as $k => $v) {
    if (array_key_exists(strtolower($v['Tables_in_centrall_fyp01']), $tables)) {
        $tables[strtolower($v['Tables_in_centrall_fyp01'])] = array(1, 1);
    } else {
        $tables[strtolower($v['Tables_in_centrall_fyp01'])] = array(0, 1);
    }
}
?><pre>
<table style="width:100%" border="1">
    <tr>
        <td>fyp</td>
        <td>centrall_fyp01</td>
    </tr>
        <?
        foreach ($tables as $k => $v) {

            $left = "";
            $right = "";

            if ($v[0]) {
                $txt = $db->fetch_first("show create table `$k`");
                $left = $txt['Create Table'];
            }

            if ($v[1]) {
                $txt = $db2->fetch_first("show create table `$k`");
                $right = $txt['Create Table'];
            }
            $css = "";
            if (substr($left, 0, strrpos($left, "\n", -1)) != substr($right, 0, strrpos($right, "\n", -1))) {
                $css = "style='background-color:orange'";

                $ary1 = explode("\n", $left);
                $ary2 = explode("\n", $right);

                for ($i = 0;; $i++) {
                    if ($ary1[$i] != $ary2[$i]) {
                        for ($j = 0;; $j++) {
                            if ($ary1[$i]{$j} != $ary2[$i]{$j}) {
                                $ary1[$i]=substr($ary1[$i],0,$j)."<u><b><span style='background:yellow'>".$ary1[$i]{$j}."</span></b></u>".substr($ary1[$i],$j+1);
                                $ary2[$i]=substr($ary2[$i],0,$j)."<u><b><span style='background:yellow'>".$ary2[$i]{$j}."</span></b></u>".substr($ary2[$i],$j+1);
                                break;
                            }
                        }
                        $ary1[$i] = "<span style='background:red'>{$ary1[$i]}</span>";
                        $ary2[$i] = "<span style='background:red'>{$ary2[$i]}</span>";
                        break;
                    }
                }
                $left = implode("\n", $ary1);
                $right = implode("\n", $ary2);
            }
            echo "<tr $css><td valign=top><pre>$left";
            echo " </td><td valign=top><pre>$right";
            echo "</td></tr>";
        }
        ?>
</table>