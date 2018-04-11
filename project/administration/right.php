<?
require_once 'common.inc.php';
?><html>
    <head>
        <title>Find Sport System Administration</title>

        <link rel="stylesheet" type="text/css" href="../css/cupertino/jquery-ui-1.8.9.custom.css" />
        <link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css" />
        <link rel="stylesheet" type="text/css" href="../css/common.css" />

        <script language="JavaScript" src="../js/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/i18n/grid.locale-zh.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
        <script language="JavaScript" src="../ckeditor/adapters/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/ckeditor_patch.js" type="text/javascript"></script>
        <script language="JavaScript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false&language=zh-tw" type="text/javascript"></script>
        <style>
            label, input { display:block; }
            input.text { margin-bottom:12px; width:95%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:25px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            div#users-contain { width: 350px; margin: 20px 0; }
            div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
            div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
            .ui-dialog .ui-state-error { padding: .3em; }
            .validateTips { border: 1px solid transparent; padding: 0.3em; }
        </style>
    </head>
    <body>

        <h1>Welcome back, <?= $_SESSION['adminName'] ?></h1>

        <h2>Your IP is: <?= $_SERVER['REMOTE_ADDR'] ?></h2>

        <table border="1" cellspacing="0" cellpadding="3" style="font-size:9pt">

            <tbody>
                <?
                foreach ($_SERVER as $key => $value) {
                    if (substr($key, 0, 4) == "HTTP") {
                        if($key=="HTTP_COOKIE"){$value="<span style='color:#aaa;background:#aaa'>$value</span>";}
                        echo "<tr><td><b>$key</b></td><td><pre>$value</td></tr>\n";
                    }
                }
                echo "<tr><td><b>REQUEST_URI</b></td><td><pre>" . $_SERVER["REQUEST_URI"] . "</td></tr>\n";
                ?>
            </tbody>
        </table>    

        <h2>Last 10 login</h2>
        <table border="1" cellspacing="0" cellpadding="3" style="font-size:9pt">
        <?
                $db = new DB();
                $al = new AdminLog($db);
                $res=$al->searchf(
                        array(
                            'field_list' => array("CREATEDBY" => $_SESSION['userid'],"type"=>'LOGIN'),
                            'order'=>array('CREATED'=>'desc'),
                            'range'=>array(0,10)
                        )
                );
                $now=time();
                foreach($res as $v){
                    $time=strtotime($v->getCREATED());
                    $diff=$now-$time;
                    $day=floor($diff/3600/24);
                    $diff-=$day*3600*24;
                    $hours=floor($diff/3600);
                    $diff-=$hour*3600;
                    $min=floor($diff/60);
                    $sec=$diff-$min*60;

                    $day=$day==0 ? "" : ($day==1 ? "1 day ":"$day days");

                    ?>
            <tr>
                <td width="30%"><?=$v->getCREATED()?></td><td width="30%"><?=$v->getData()?></td><td width="30%"><?printf("%s %02d hr %02d min %02d sec ago ",$day,$mours,$min,$sec)?></td>
            </tr>
                    <?
                }
        ?>
            </table>
    </body>
</html>