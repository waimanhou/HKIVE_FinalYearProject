
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>FindSport</title>
         <script language="JavaScript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false&language=zh-tw" type="text/javascript"></script>

    </head>
    <body>
<? $r = $inst; 
?>
<form action="?action=savenew" method="POST">
<table><tr><td>
    <table border="0">
    <input type="hidden" name="pk" value="<?=intval($_GET['pk'])?>">
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
                        echo "<input type='text' id='$k' name='$k' value='".htmlspecialchars($r->$m())."'><input type='button' value='v'><span>".$inst->__toString()."</span>";
                    } else {
                        echo "<input type='text' id='$k' name='$k'><input type='button' value='v'><span></span>";
                       // $response['rows'][$i]['cell'][] = "";
                    }
                } catch (RecordNotFoundException $rnfx) {
//                    $response['rows'][$i]['cell'][] = $r->$m() . ":(no record)";
                       echo "<input type='text' id='$k' name='$k'><input type='button' value='v'><span></span>";
                }
            }else{
             //   echo "<input type='text' id='$k' name='$k' value='".  htmlspecialchars($r->$m())."'>";
                //echo $r->$m();

				if($k==$this->pk)
				{
					echo "<input type='text' name='$k' id='$k' value='".  htmlspecialchars($r->$m())."' disabled>";
				}else{
					echo "<input type='text' name='$k' id='$k' value='".  htmlspecialchars($r->$m())."'>";
				}
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
</td><td><div id="GoogleMap" style="width:300px;height:300px;float:right"></div></td></tr>
<script>
    var venuePosition=eval("<?=$r->getMap()?>")

    if(venuePosition){
        venuePosition=new google.maps.LatLng(venuePosition[0],venuePosition[1]);
    }else{
        venuePosition=new google.maps.LatLng(22.202663,114.614868);
    }

            map=new google.maps.Map(document.getElementById('GoogleMap'),{
                zoom: 17,
                center: venuePosition,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            marker = new google.maps.Marker({
                position: map.getCenter(),
                map: map,
                title: "New Venue"
            });

             google.maps.event.addListener(map, 'drag', function() {
    //alert(map.getCenter());
            marker.setPosition(map.getCenter())
            document.getElementById("map").value="["+map.getCenter().lat()+","+map.getCenter().lng()+"]";
            
  });
</script>
    </body>
</html>
