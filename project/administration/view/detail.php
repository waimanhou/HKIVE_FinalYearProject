<?
$r = $inst;
?>
<html>
    <head>

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
        <style>
            .ui-dialog{
                font-size:80%
            }
        </style>

        <script>
            function setData(name,val,ts)
            {
                $("#"+name).val(val);
                $("#"+name+"String").html(ts);
            }
        </script>
    </head>
    <body>
        <form action="?action=save" method="POST">
            <table border="0">
                <input type="hidden" name="pk" value="<?= intval($_GET['pk']) ?>">
                <?
                foreach ($mgtobj->getDisplayProps() as $k => $v) {
                    if (($v & Mgt::TYPE_DETAIL) != 0) {
                        echo "<tr><td>";
                        echo $mgtobj->getPropName($k);
                        echo "</td><td>";
                        $m = "get$k";
                        if ($mgtobj->fk[$k] instanceof ReflectionClass) {
                            try {
                                if ($r->$m() != "") {
                                    $inst = $this->fk[$k]->newInstance($db, $r->$m());
                                    echo "<input type='text' name='$k' id='$k' value='" . htmlspecialchars($r->$m()) . "'".
                                            "onChange='$(\"#\"+name+\"String\").load(\"getToString.php?class=".strtolower($this->fk[$k]->getName())."&id=\"+this.value)'". ($this->getDisableProp($mgtobj->getPropName($k)) ? " disabled" : "") . ">" .
                                            "<input type='button' value='Browse...' onclick='window.open(\"" . strtolower($this->fk[$k]->getName()) . ".php?action=lov&col=" . $k . "\",\"\",\"width=850,height=800\")'" . ($this->getDisableProp($mgtobj->getPropName($k)) ? " disabled" : "") . ">".
                                            "<span id='{$k}String'>" . $inst->__toString() . "</span>";
                                } else {
                                    echo "<input type='text' name='$k' id='$k'" .
                                            "onChange='$(\"#\"+name+\"String\").load(\"getToString.php?class=".strtolower($this->fk[$k]->getName())."&id=\"+this.value)'". ($this->getDisableProp($mgtobj->getPropName($k)) ? " disabled" : "") . ">".
                                        "<input type='button' value='Browse...' onclick='window.open(\"" . strtolower($this->fk[$k]->getName()) . ".php?action=lov&col=" . $k . "\",\"\",\"width=850,height=800\")'" . ($this->getDisableProp($mgtobj->getPropName($k)) ? " disabled" : "") . ">".
                                                "<span id='{$k}String'></span>";
                                }
                            } catch (RecordNotFoundException $rnfx) {
                                echo "<input type='text' name='$k' id='$k'" .
                                            "onChange='$(\"#\"+name+\"String\").load(\"getToString.php?class=".strtolower($this->fk[$k]->getName())."&id=\"+this.value)'". ($this->getDisableProp($mgtobj->getPropName($k)) ? " disabled" : "") . ">".
                                        "<input type='button' value='Browse...' onclick='window.open(\"" . strtolower($this->fk[$k]->getName()) . ".php?action=lov&col=" . $k . "\",\"\",\"width=850,height=800\")'" . ($this->getDisableProp($mgtobj->getPropName($k)) ? " disabled" : "") . ">".
                                                "<span id='{$k}String'></span>";
                            }
                        } else {
                            echo "<input type='text' name='$k' value='" . htmlspecialchars($r->$m()) . "'" . ($this->getDisableProp($mgtobj->getPropName($k)) ? " disabled" : "") . ">";
                        }
                        echo "</td></tr>\n";
                    }
                }
                ?>
                <tr>
                    <td>DELETED?</td>
                    <td><input type=checkbox name="_delete" <?= $r->getDELETED() ? "checked" : "" ?>></td>
                </tr>
            </table>
            <input type="submit" value="Submit"> <input type="button" value="Cancel" onclick="history.go(-1)">
        </form>
    </body>
</html>