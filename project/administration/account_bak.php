<?php
require_once 'common.inc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
        <script language="JavaScript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false&language=zh-tw" type="text/javascript"></script>
        <script>
            $(function(){
                var lastsel;
                jQuery("#rowed3").jqGrid({
                  //  url:'server.php?q=2',
                    datatype: "json",
                    width:'1000',
                    height:'800',
                    colName:["userId","loginName","chiname","engname","password","salt","sessionid","point","credit","email","tel1","tel2","lastlogin","lastip","HKID","nickName","UPDATED","UPDATEDBY","CREATED","CREATEDBY","DELETED","DELETEDBY"],
                    colModel:[
                        {name:"userId" , index:1, width:60,editable:true},
                        {name:"loginName" , index:1, width:60,editable:true},
                        {name:"chiname" , index:1, width:60,editable:true},
                        {name:"engname" , index:1, width:60,editable:true},
                        {name:"password" , index:1, width:60, hidden:true,editable:true},
                        {name:"salt" , index:1, width:60, hidden:true},
                        {name:"sessionid" , index:1, width:60,hidden:true,editable:true},
                        {name:"point" , index:1, width:60,editable:true},
                        {name:"credit" , index:1, width:60,editable:true},
                        {name:"email" , index:1, width:60,editable:true},
                        {name:"tel1" , index:1, width:60,editable:true},
                        {name:"tel2" , index:1, width:60,editable:true},
                        {name:"lastlogin" , index:1, width:60,editable:true},
                        {name:"lastip" , index:1, width:60,editable:true},
                        {name:"HKID" , index:1, width:60,editable:true},
                        {name:"nickName" , index:1, width:60,editable:true},
                        {name:"UPDATED" , index:1, width:60,editable:true,hidden:true},
                        {name:"UPDATEDBY" , index:1, width:60,editable:true,hidden:true},
                        {name:"CREATED" , index:1, width:60,editable:true,hidden:true},
                        {name:"CREATEDBY" , index:1, width:60,editable:true,hidden:true},
                        {name:"DELETED" , index:1, width:60,editable:true,hidden:true},
                        {name:"DELETEDBY" , index:1, width:60,editable:true,hidden:true}
                    ],
                    rowNum:10,
                    rowList:[10,20,30],
                    pager: '#prowed3',
                    sortname: 'id',
                    viewrecords: true,
                    sortorder: "desc",
                    onSelectRow: function(id){
                        if(id && id!==lastsel){
                            jQuery('#rowed3').jqGrid('restoreRow',lastsel);
                            jQuery('#rowed3').jqGrid('editRow',id,true);
                            lastsel=id;
                        }
                    },
                   // editurl: "server.php",
                    caption: "Account"
                });
                jQuery("#rowed3").jqGrid('navGrid',"#prowed3",{edit:1,add:1,del:1});


        jQuery("#rowed3").jqGrid('gridResize');
                var mydata = [
                    /*
                    {id:"1",invdate:"2007-10-01",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
                    {id:"2",invdate:"2007-10-02",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
                    {id:"3",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
                    {id:"4",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
                    {id:"5",invdate:"2007-10-05",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
                    {id:"6",invdate:"2007-09-06",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
                    {id:"7",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
                    {id:"8",invdate:"2007-10-03",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
                    {id:"9",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"}*/
<?
$a = new Account(new DB());
$a = $a->vsearch(array("where" => 1));
$first = true;
for ($i = 0; $i < count($a); $i++) {
    $acc = $a[$i];
    if ($first) {
        $first = false;
    } else {
        echo ",";
    };

    echo "{" .
    '"userId":"' . $acc->getUserId() . '",' .
    '"loginName":"' . $acc->getLoginName() . '",' .
    '"chiname":"' . $acc->getChiName() . '",' .
    '"engname":"' . $acc->getEngName() . '",' .
    '"password":"' . '' . '",' .
    '"salt":"' . '' . '",' .
    '"sessionid":"' . $acc->getSessionId() . '",' .
    '"point":"' . $acc->getPoint() . '",' .
    '"credit":"' . $acc->getCredit() . '",' .
    '"email":"' . $acc->getEmail() . '",' .
    '"tel1":"' . $acc->getTel1() . '",' .
    '"tel2":"' . $acc->getTel2() . '",' .
    '"lastlogin":"' . $acc->getLastLogin() . '",' .
    '"lastip":"' . $acc->getLastIp() . '",' .
    '"HKID":"' . $acc->getHKID() . '",' .
    '"nickName":"' . $acc->getNickName() . '",' .
    '"UPDATED":"' . $acc->getUPDATED() . '",' .
    '"UPDATEDBY":"' . $acc->getUPDATEDBY() . '",' .
    '"CREATED":"' . $acc->getCREATED() . '",' .
    '"CREATEDBY":"' . $acc->getCREATEDBY() . '",' .
    '"DELETED":"' . $acc->getDELETED() . '",' .
    '"DELETEDBY":"' . $acc->getDELETEDBY() . '"}';
}
?>
        ];


        for(var i=0;i<=mydata.length;i++)
            jQuery("#rowed3").jqGrid('addRowData',i+1,mydata[i]);

    });
        </script>
    </head>
    <body>
        <table id="rowed3"></table>
        <div id="prowed3"></div>
    </body>
</html>