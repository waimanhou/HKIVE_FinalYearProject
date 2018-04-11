<?php
if(empty($_GET['q'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html><head>

<link rel="stylesheet" type="text/css" media="screen" href="css/redmond/jquery-ui-1.8.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.multiselect.css" />

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.2.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.layout.js" type="text/javascript"></script>
<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="js/jquery.tablednd.js" type="text/javascript"></script>
<script src="js/jquery.contextmenu.js" type="text/javascript"></script>
<script src="js/ui.multiselect.js" type="text/javascript"></script>
</head><body>

<table id="treegrid"></table>
<div id="ptreegrid"></div>

<script>

jQuery("#treegrid").jqGrid({
    treeGrid: true,
    treeGridModel: 'adjacency',
    ExpandColumn : 'name',
    url: 'test2.php?q=foldertree',
    datatype: "xml",
    mtype: "POST",
    colNames:["id","Folder"],
    colModel:[
         {name:'id',index:'id', width:1,hidden:true,key:true},
         {name:'name',index:'name', width:180} 
    ],
    height:'auto',
    pager : "#ptreegrid",
    caption: "Treegrid example",
    onSelectRow:function(id){
        alert(id);
    }
});


function asdf(x){
    jQuery("#treegrid").jqGrid().setGridParam({url : 'test2.php?q=foldertree&a=123'}).trigger("reloadGrid")


}
</script>
<a href="javascript:asdf(1)">1</a><br>
<a href="javascript:asdf(2)">2</a><br>
<a href="javascript:asdf(3)">3</a><br>
<a href="javascript:asdf(4)">4</a><br>

</body></html>
<?php
die();

}else if($_GET['q']=="foldertree"){

mysql_connect("127.0.0.1","fyp01","ive2010");
mysql_selectdb("centrall_fyp01");
// First we need to determine the leaf nodes
$SQLL = "SELECT t1.folderId FROM msgfolder AS t1 LEFT JOIN msgfolder as t2 ON t1.folderId = t2.parentfolderId WHERE t2.folderId IS NULL and t1.userId=8";
$result = mysql_query( $SQLL ) or die("Couldn t execute query.".mysql_error());
$leafnodes = array();
while($rw = mysql_fetch_array($result,MYSQL_ASSOC)) {
   $leafnodes[$rw[folderId]] = $rw[folderId];
}
// Recursive function that do the job
function display_node($parent, $level) {
   global $leafnodes;
   if($parent >0) {
      $wh = 'parentfolderid='.$parent;
   } else {
      $wh = 'ISNULL(parentfolderid)';
   }
   $SQL = "SELECT * FROM msgfolder WHERE userid=8 and ".$wh;
   $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
   while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
      echo "<row>";         
      echo "<cell>". $row[folderId]."</cell>";
      //echo "<cell><![CDATA[<span onclick='alert(\"".addslashes($row[name])."\")' style=\"cursor:pointer\">". $row[name]."</span>]]></cell>";
      echo  "<cell><![CDATA[{$row[name]}{$_GET['a']}]]></cell>";
      echo "<cell>". $level."</cell>";
      if(!$row[parentFolderId]) $valp = 'NULL'; else $valp = $row[parentFolderId];  // parent field
      echo "<cell><![CDATA[".$valp."]]></cell>";
      if($row[folderId] == $leafnodes[$row[folderId]]) $leaf='true'; else $leaf = 'false';  // isLeaf comparation
      echo "<cell>".$leaf."</cell>"; // isLeaf field
      echo "<cell>false</cell>"; // expanded field
      echo "</row>";
        // recursion
      display_node((integer)$row[folderId],$level+1);
   }
}
 
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
   header("Content-type: application/xhtml+xml;charset=utf-8");
} else {
   header("Content-type: text/xml;charset=utf-8");
}
$et = ">";
echo "<?xml version='1.0' encoding='utf-8'?$et\n";
echo "<rows>";
echo "<page>1</page>";
echo "<total>1</total>";
echo "<records>1</records>";
// Here we call the function at root level
display_node('',0);
echo "</rows>";
}else if($_GET["q"]="dir"){

}
?>