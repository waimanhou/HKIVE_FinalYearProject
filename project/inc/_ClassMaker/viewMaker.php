<?php

ob_implicit_flush();
set_time_limit(1000);
include_once '../class.DB.php';

$db=new DB(false);
$db->connect(DBHOST, DBUSER, DBPW, 'fyp_with_fk', DBCHARSET, DBPCONNECT, DBTABLEPRE);
$db2=new DB(false);
$db2->connect(DBHOST, DBUSER, DBPW, 'fyp_without_six_col', DBCHARSET, DBPCONNECT, DBTABLEPRE);

echo 1;
$a=$db2->fetch_all("show tables");

while(count($a)!=0) {
    for($i=0;$i<count($a);$i++) {
        $table=$a[$i]['Tables_in_fyp_without_six_col'];
        $db2->query("drop table `$table`",'SILENT');
        $a=$db2->fetch_all("show tables");
        echo ".";
    }
    echo ".";
}
echo "<br>2";

$a=$db->fetch_all("show tables");

do{
	for($i=0;$i<count($a);$i++) {
		$table=$a[$i]['Tables_in_fyp_with_fk'];
		$sql=$db->fetch_first("show create table `$table`");
		$sql=$sql['Create Table'];
		$sql=str_replace("\n"," ",$sql);
		$sql=str_replace("\r"," ",$sql);
		$db2->query($sql,'SILENT');
		//print_r($sql);
                echo ".";
	}
	$b=$db2->fetch_all("show tables");
        echo ".";
}while(count($a)!=count($b));

echo "<br>3";

$a=$db2->fetch_all("show tables");
for($i=0;$i<count($a);$i++) {
	$table=$a[$i]['Tables_in_fyp_without_six_col'];
	$db2->query("alter table `$table`   DROP `UPDATED`,  DROP `UPDATEDBY`,  DROP `CREATED`,  DROP `CREATEDBY`,  DROP `DELETED`,  DROP `DELETEDBY`;");
        echo ".";
}

echo "<br>4";


$db3=new DB(false);
$db3->connect(DBHOST, DBUSER, DBPW, 'fyp', DBCHARSET, DBPCONNECT, DBTABLEPRE);
$a=$db3->fetch_all("show tables");

//while(count($a)!=0) {
    for($i=0;$i<count($a);$i++) {
        $table=$a[$i]['Tables_in_fyp'];
        $db3->query("drop table `$table`");
       // $a=$db2->fetch_all("show tables");
       //echo "drop table `$table`";
        echo ".";
    }
//}


echo "<br>5";
$a=$db->fetch_all("show tables");

for($i=0;$i<count($a);$i++) {
        $table=$a[$i]['Tables_in_fyp_with_fk'];
        $sql=$db->fetch_first("show create table `$table`");
        $sql=$sql['Create Table'];
        $sql=str_replace("\n"," ",$sql);
        $sql=str_replace("\r"," ",$sql);
        $sql=str_replace("ENGINE=InnoDB","ENGINE=MyISAM",$sql);
        $db3->query($sql,'SILENT');
        //print_r($sql);
        echo ".";
}
/*
echo "<br>now rename file:<br>";

//echo
$datafolder=realpath("./../../../../MySQL/data/");
//inc---------^  ^  ^  ^
//fyp------------+  |  |
//www---------------+  |
//apperv---------------+

$folder=array("/fyp/","/fyp_with_fk/","/fyp_without_six_col/");
$filelist=array('account.frm','activity.frm','activityType.frm','ads.frm','blackList.frm','comment.frm','friend.frm','friendList.frm','gift.frm','involveAccount.frm','member.frm','message.frm','msgFolder.frm','msgMap.frm','orgReq.frm','organization.frm','redeemGift.frm','team.frm','teamMember.frm','venue.frm','venueType.frm','emailActivation.frm','activityQA.frm');
for($i=0;$i<count($folder);$i++){
    $dir=$datafolder.$folder[$i];
    for($j=0;$j<count($filelist);$j++){
        $f=realpath($datafolder.$folder[$i].$filelist[$j]);
        if(file_exists($f."asfd")){
            rename($f."asfd",$f);
        }

        //rename($f,$f);
    //echo realpath($dir);//.$filelist[$j]);
        //rename($dir.$filelist[$j],$dir.$filelist[$j]);

    }
}

/*
for($i=0;$i<count($a);$i++) {

    $table=$a[$i]['Tables_in_fyp_with_fk'];
    print_r( $db->fetch_first("show create table $table"));

}*/