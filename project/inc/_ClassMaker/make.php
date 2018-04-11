<?php
include_once '../class.DB.php';


$db=new DB(false);
$db->connect(DBHOST, DBUSER, DBPW, 'fyp_with_fk', DBCHARSET, DBPCONNECT, DBTABLEPRE);
$a=$db->fetch_all("show tables");
if(file_exists("./TEST"))
    rename("./TEST","./TEST_BACKUP_".date('Y-m-d_His')."_".rand());
mkdir("./TEST");
mkdir("./TEST/ORM");
//copy("../config.inc.php","./TEST/config.inc.php");
copy("../class.DB.php","./TEST/class.DB.php");
copy("../class.DataBoundObject.php","./TEST/class.DataBoundObject.php");
//copy("../common.inc.php","./TEST/common.inc.php");
$aaa=array('UPDATED','UPDATEDBY','CREATED','CREATEDBY','DELETED','DELETEDBY');
$tableNameWithCase=array();

for($i=0;$i<count($a);$i++) {
    $table=$a[$i]['Tables_in_fyp_with_fk'];
    $tableNameWithCase[strtolower($table)]=$table;
}
//var_dump($tableNameWithCase);
for($i=0;$i<count($a);$i++) {

    $table=$a[$i]['Tables_in_fyp_with_fk'];
    $table2=$table;
    $table2{0}=strtoupper($table2{0});
    $cols=$db->fetch_all("desc `$table`");

    for($j=0;$j<count($cols);$j++) {
        $cols[$j]=$cols[$j]['Field'];
    }
    //print_r($cols);
    $fp=fopen("./TEST/ORM/class.$table2.php","w+");
    $head=<<<EOD
<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";

EOD;
    $body=<<<EOD
   
class $table2 extends DataBoundObject {
    

EOD;
    if(file_exists("./code/{$table}__Map.php")) {
        include "./code/{$table}__Map.php";

    }else {
        $m=array();
    }
    foreach($cols as $value) {
        if(in_array($value,$aaa))continue;
        if(array_key_exists($value,$m)) {
            $body.="    protected \${$m[$value]};\n";
        }else {
            $body.="    protected \${$value};\n";
        }
    }

    $body.=<<<EOD

   
    protected function DefineTableName() {
        return '$table';
    }

    protected function DefineRelationMap() {
        return array(

EOD;
    
    foreach($cols as $value) {
        if(in_array($value,$aaa))continue;
        if(array_key_exists($value,$m)) {
            $body.="            '{$value}'=>'{$m[$value]}',\n";
        }else {
            $body.="            '{$value}'=>'{$value}',\n";
        }
    }
    $body=substr($body,0,strlen($body)-2);

    $body.=<<<EOD
   
        );
    }

EOD;

    $body.="\n    protected function DefinePrimaryKey() {\n";
    $body.="        return ";


    $cols=$db->fetch_all("desc `$table");
    $cols2=array();
    for($j=0;$j<count($cols);$j++) {
        if($cols[$j]['Key']=="PRI") {
            $cols2[]=$cols[$j]['Field'];
        }
    }
    if(count($cols2)==1) {
        $body.="'{$cols2[0]}';\n    }\n\n";
    }else {
        $body.="array('";
        $body.=implode("','", $cols2);
        $body.="');\n    }\n\n";
    }

    $data=$db->fetch_first("show create table $table");
    $data=$data["Create Table"];
    $incList=array();
    $data=explode("\n",$data);
    foreach($data as $value) {
        $d=explode("`",$value);
        //$d=$d[0];
        if($d[0]=="  CONSTRAINT ") {
            //echo $value;print_r( $d);
            
            $d[5]=$tableNameWithCase[strtolower($d[5])];
            $d[3]{0}=strtoupper($d[3]{0});
            $asdf=$d[3];
            $d[5]{0}=strtoupper($d[5]{0});
            /*if($d[3]{strlen($d[3])-1}!="d") {
                echo "<h1>$table.{$d[3]}</h1>";
                $d[3].="Obj";
            }else {
                $d[3]=substr($d[3],0,-2);
            }*/
            if(strtolower($d[3]{strlen($d[3])-2}.$d[3]{strlen($d[3])-1})=="id"){
                $d[3]=substr($d[3],0,-2);
            }else if($d[3]{strlen($d[3])-4}.$d[3]{strlen($d[3])-3}.$d[3]{strlen($d[3])-2}.$d[3]{strlen($d[3])-1}=="Code"){
                $d[3]=substr($d[3],0,-4);
            }else{
                echo "<h1>$table.{$d[3]}</h1>";
                $d[3].="Obj";
            }
            if(strlen($d[3])==1) {
                $d[3]=$d[5];
                //echo "$table";
            }
            $body.="    public function get{$d[3]}(){\n";
            $body.="        return new {$d[5]}(\$this->_DB,\$this->get{$asdf}());\n";
            $body.="    }\n\n";
            if(!in_array($d[5], $incList)) {
                $incList[]=   $d[5];
            }
        }
    }


    if(file_exists("./code/$table.php")) {
        $f=file("./code/$table.php");
        /*foreach ($f as $value) {
           $body.=$value;
       }
        */
        for ($k=1;$k<count($f)-1;$k++) {//don't include first and last line
            $body.=$f[$k];
        }
    }


    $body.="\n\n}";/*
   foreach ($incList as $value) {
       $head.="require_once ROOT.\"/inc/ORM/class.{$value}.php\";\n";
   }*/
    fwrite($fp,$head.$body);
    fclose($fp);
}
?>
