<?php /* Smarty version 2.6.26, created on 2011-05-08 01:04:21
         compiled from list.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html><head>

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
    var map;
    $(function(){
        $("#list").jqGrid({
            url:'?action=getData',
            datatype: "json",
            colNames: [

                <?php $_from = $this->_tpl_vars['data']->getDisplayProps(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prop'] => $this->_tpl_vars['v']):
?>
                    <?php if (( $this->_tpl_vars['v'] & 1 ) != 0): ?>
                        "<?php echo $this->_tpl_vars['data']->getPropName($this->_tpl_vars['prop']); ?>
",
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                "toString"
            ],

            colModel:[
                <?php $_from = $this->_tpl_vars['data']->getDisplayProps(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prop'] => $this->_tpl_vars['v']):
?>
                    <?php if (( $this->_tpl_vars['v'] & 1 ) != 0): ?>
                        <?php echo $this->_tpl_vars['data']->getColModel($this->_tpl_vars['prop']); ?>
,
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                {"name":"DELETEDBY","hidden":true}
            ],
            shrinkToFit:false,
            //scroll:true,
            rowNum:20,
            rowList:[10,20,30,50,100,200,500,1000],
            pager: '#pager',
            sortname: '',
            viewrecords: true,
            sortorder: "desc",
            caption:"<?php echo $this->_tpl_vars['data']->getClassName(); ?>
",
            width:800,
            height:600,
            ondblClickRow:function(rowid, iRow, iCol, e){
				var row=jQuery("#list").getRowData(rowid);
				location="?action=edit&pk="+row['<?php echo $this->_tpl_vars['pk']; ?>
'];
            }
        });

        jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false,search:false});

        jQuery("#list").jqGrid('gridResize');
        

/*
        updateGrid=function(){
            var typeId=$("#typeId").val();
            var distCode=$("#distCode").val();
            $("#list").jqGrid().setGridParam({url:'?action=q&type='+typeId+'&district='+distCode});
            $("#list").jqGrid().trigger("reloadGrid");
        }
        $("#typeId").change(updateGrid);
        $("#distCode").change(updateGrid);
*/


        $("#incdelcb").change(function(){

            if($(this).is(':checked')){

                $("#list").jqGrid().setGridParam({url:'?action=getData&incDel=1'});
                $("#list").jqGrid().trigger("reloadGrid");

            }else{

                $("#list").jqGrid().setGridParam({url:'?action=getData'});
                $("#list").jqGrid().trigger("reloadGrid");


            }

        })
    });

</script>

    </head>
    <body>

        <center>
            <label><input id="incdelcb" type="checkbox" /> Include Deleted</label><input type=button value="New Record" onclick="location='?action=new'">
        </center>
<table width="100%">
    <tr>
        <td align="center">
            <table id="list"></table>
            <div id="pager"></div>
        </td>
    </tr>
</table>


    </body>
</html>