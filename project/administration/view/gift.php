<? $r = $inst; 
?>
<form action="?action=savenew" method="POST">
<table border="0">
    <input type="hidden" name="pk" value="">
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
                //        echo $r->$m() . ":" . $inst->__toString();
                        echo "<input type='text' name='$k' value='".htmlspecialchars($r->$m())."'><input type='button' value='v'><span>".$inst->__toString()."</span>";
                    } else {
                        echo "<input type='text' name='$k'><input type='button' value='v'><span></span>";
                       // $response['rows'][$i]['cell'][] = "";
                    }
                } catch (RecordNotFoundException $rnfx) {
//                    $response['rows'][$i]['cell'][] = $r->$m() . ":(no record)";
                       echo "<input type='text' name='$k'><input type='button' value='v'><span></span>";
                }
            }else{
				if($k==$this->pk)
				{
					echo "<input type='text' name='$k' value='".  htmlspecialchars($r->$m())."' disabled>";
				}else if($k==""){
				
				}else{
					echo "<input type='text' name='$k' value='".  htmlspecialchars($r->$m())."'>";
				}
                //echo $r->$m();

            }

            echo "</td></tr>";
        }
    }
    ?>
<tr>
<td>DELETED?</td>
<td><input type=checkbox name="_delete" <?=$r->getDELETED()?"checked":""?>></td>
</tr>
</table>
<input type="submit" value="Submit"> <input type="button" value="Cancel" onclick="history.go(-1)">
</form>
