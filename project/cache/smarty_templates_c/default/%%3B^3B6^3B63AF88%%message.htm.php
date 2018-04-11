<?php /* Smarty version 2.6.26, created on 2011-05-14 21:02:56
         compiled from message.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'message.htm', 17, false),array('modifier', 'escape', 'message.htm', 230, false),)), $this); ?>

<?php ob_start(); ?>

<style>
    .ui-dialog{font-size:80%}
    fieldset { padding:0; border:0; }
    input.text {  width:100%; padding: .4em; }
    .btn{font-size:80%}
</style>
<script>
    jQuery(function(){
        jQuery("#folderView").jqGrid({
            //url:'message.php?q=getFolderMessage&folderid=-1',
            datatype: "xml",
            height: "600",
            width: "700",
            colNames:['<?php echo ((is_array($_tmp='MsgId')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
','<?php echo ((is_array($_tmp='Subject')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
','<?php echo ((is_array($_tmp='Sender')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
','<?php echo ((is_array($_tmp='Time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
'],
            colModel:[
                {name:'msgId',index:'msgId', width:1,hidden:true,key:true,sortable: false},
                {name:'Subject',index:'subject', width:450,sortable: false},
                {name:'Sender',index:'Sender', width:200,sortable: false},
                {name:'Time',index:'Time', width:200,sortable: false},
            ],
            onCellSelect:function(rowid,iCol,cellcontent,e){
                if(iCol!=0)
                {
                    $("#folderView").jqGrid().setSelection(rowid,false);
                    $.get("message.php",{'q':'getMessage','messageId':rowid}, function(data){
                        jQuery("#messageView").html("<Table width=100%><tr>"+
                            "<td width=100><b><?php echo ((is_array($_tmp='subject')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 </b></td><td>"+data.getElementsByTagName("subject")[0].firstChild.data+"</td>"+
                            "</tr><tr>"+
                            "<td><b><?php echo ((is_array($_tmp='sender')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 </b></td><td>"+data.getElementsByTagName("sender")[0].firstChild.data+"</td>"+
                            "</tr><tr>"+
                            "<td><b><?php echo ((is_array($_tmp='time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: </b></td><td>"+data.getElementsByTagName("time")[0].firstChild.data+"</td>"+
                            "</tr></table><hr>"+
                            ""+data.getElementsByTagName("body")[0].firstChild.data+"<br>");
                        jQuery("#messageView").dialog("open");
                        jQuery("#messageView").dialog.msgid=data.getElementsByTagName("message")[0].getAttribute("id");
                        jQuery("#messageView").dialog.msgsubject=data.getElementsByTagName("subject")[0].firstChild.data;
                        jQuery("#messageView").dialog.msgsender=data.getElementsByTagName("sender")[0].firstChild.data;
                        jQuery("#messageView").dialog.msgsenderLoginName=data.getElementsByTagName("sender")[0].getAttribute("loginName");
                        jQuery("#folderView").jqGrid().trigger("reloadGrid");
                    },"xml");
                }
            },
            multiselectWidth:25,
            multiselect: true,
            forceFit:true,
            rowList:[10,15,20,25,30,50,100,250],
            rowNum:50,
            mtype: "GET",
            pager: '#pfolderView',
            viewrecords: true,
            editurl: 'message.php',
            //emptyrecords: "test",
            caption: "<?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
"
        });
        jQuery("#folderView").jqGrid('navGrid','#pfolderView',
        {
            edit:false,
            search:false,
            addfunc:function(){
                new showSendMsgDialog();
                jQuery("#folderView").jqGrid().trigger("reloadGrid");
            },
            delfunc:function(id){
                jQuery("#delmessage").dialog.id=id;
                jQuery("#delmessage").dialog("open");
            }
        });
        /* jQuery("#folderView").jqGrid('navButtonAdd',"#pfolderView",
        {
            caption:"<?php echo ((is_array($_tmp='Move')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
", buttonicon:"ui-icon-transferthick-e-w", onClickButton:function(){
        
            }, position: "last", title:"", cursor: "pointer"
        });*/
        jQuery("#folderTree").jqGrid({
            treeGrid: true,
            treeGridModel: 'adjacency',
            ExpandColumn : 'name',
            url: 'message.php?q=getfoldertree',
            datatype: "xml",
            mtype: "POST",
            colNames:["id","<?php echo ((is_array($_tmp='Folder')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
"],
            colModel:[
                {name:'id',index:'id', width:1,hidden:true,key:true,sortable: false},
                {name:'name',index:'name',width:'100%',sortable: false}
            ],
            height: "600",
            width: "200",
            scroll: true,
            pager : "#pfolderTree",
            caption: "<?php echo ((is_array($_tmp='Folder')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
",
            onSelectRow:function(id){
                jQuery("#folderView").jqGrid().setGridParam({url : 'message.php?q=getFolderMessage&folderid='+id}).trigger("reloadGrid");
            },
            loadComplete:function(){
                var firstDataId=$("#folderTree").jqGrid().getDataIDs()[0];
                $("#folderTree").jqGrid().setSelection(firstDataId,true);
            }
        });
        jQuery("#messageView").dialog({
            autoOpen: false,
            show: "blind",
            hide: "puff",
            modal: true,
            width: 600,
            height: $(window).height()*0.8,
            position: 'center',
            buttons: {
                "<?php echo ((is_array($_tmp='Reply')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
                    showSendMsgDialog(jQuery("#messageView").dialog.msgsenderLoginName,"RE: "+jQuery("#messageView").dialog.msgsubject);
                },
                "<?php echo ((is_array($_tmp='Move')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
                    ShowMoveMsgDialog(jQuery("#messageView").dialog.msgid);//----------------------------------------------------------------MOVE!!!!
                    $("#messageView").dialog("close");
                },
                "<?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
                    $.get("message.php",{'q':'delMessage','messageId':jQuery("#messageView").dialog.msgid}, function(data){
                        $("#messageView").dialog("close");
                        jQuery("#folderView").jqGrid().trigger("reloadGrid");
                    },"html");
                },
                "<?php echo ((is_array($_tmp='Mark as unread')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
                    $.get("message.php",{'q':'makeAsUnreadMessage','messageId':jQuery("#messageView").dialog.msgid}, function(data){
                        $("#messageView").dialog("close");
                        jQuery("#folderView").jqGrid().trigger("reloadGrid");
                    },"html");
                }
            }
        });
        jQuery("#delmessage").dialog({
            autoOpen: false,
            show: "blind",
            hide: "puff",
            modal: true,
            position: 'center',
            buttons: {
                "<?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
                    for(i in jQuery("#delmessage").dialog.id)
                    {
                        $.get("message.php",{'q':'delMessage','messageId':jQuery("#delmessage").dialog.id[i]}, function(data){},"html");
                    }
                    $("#delmessage").dialog("close");
                    jQuery("#folderView").jqGrid().trigger("reloadGrid");
                },
                "<?php echo ((is_array($_tmp='Cancel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
                    $("#delmessage").dialog("close");
                }
            }
        });
        jQuery.fx.speeds._default = 500;

        //$("#bodyeditor").ckeditor();

        $("#movedialog").dialog({
            autoOpen: false ,
            buttons:{
                "<?php echo ((is_array($_tmp='Move')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
":function(){
                    $.get("message.php",{'q':'moveMessage','msgId':$("#moveMsgId").val(), 'folderId':$("#moveMsgFolder").val()}, function(data){},"html");
                    $(this).dialog("close");
                    //$("#folderView").jqGrid().setGridParam({url : 'message.php?q=getFolderMessage&folderid='+$("#moveMsgFolder").val()}).trigger("reloadGrid");
                    $("#folderView").jqGrid().trigger("reloadGrid");
                },
                "<?php echo ((is_array($_tmp='cancel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
":function(){
                    $(this).dialog("close")
                }
            }
        }
    );
        $("#mgtfolderdialog").dialog({
            autoOpen: false ,
            width: 350,
            buttons:{
                "<?php echo ((is_array($_tmp='Close')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
":function(){
                    $(this).dialog("close")
                }
            }
        }
    );





        $("#mgtfolderop").change(function(){
        
            var forms=[$("#createfolder"),$("#movefolder"),$("#renamefolder"),$("#deletefolder")];
            for(i in forms){
                forms[i].hide();
            }
            forms[$(this).val()].show();
        })

        $("#mgtfolderiframe").get(0).onload=function(){
            $("#mgtfolderdialog").dialog("close");
            // $("#folderTree").jqGrid().trigger("reloadGrid");
            location="?"+Math.random();
        }


        $(".btn").button();

    });

    function ShowMoveMsgDialog(msgId){
        $("#moveMsgId").val(msgId)
        $("#movedialog").dialog("open");
    }
    function showMgtFolderDialog(){

        var forms=[$("#createfolder"),$("#movefolder"),$("#renamefolder"),$("#deletefolder")];
        for(i in forms){
            forms[i].hide();
        }
        forms[$("#mgtfolderop").val()].show();
        $("#mgtfolderdialog").dialog("open");
    }
</script>


<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<iframe width="0" height="0" id="mgtfolderiframe" name="mgtfolderiframe" style="display:none"></iframe>
<div id="movedialog" title="<?php echo ((is_array($_tmp='Move message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
     Move the selected message to:
     <input type="hidden" value="" id="moveMsgId" name="moveMsgId">
    <select style="width:100%" id="moveMsgFolder">
        <?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <option value="<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
</div>
<div id="mgtfolderdialog" title="<?php echo ((is_array($_tmp='Management folders')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
     <?php echo ((is_array($_tmp='Operation')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<select id="mgtfolderop">
        <option value="0"><?php echo ((is_array($_tmp='Create Folder')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
        <option value="1"><?php echo ((is_array($_tmp='Move Folder')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
        <option value="2"><?php echo ((is_array($_tmp='Rename Folder')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
        <option value="3"><?php echo ((is_array($_tmp='Delete Folder')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
    </select><br><br>
    <form id="createfolder" action="?q=createfolder" method="post" target="mgtfolderiframe">
        Folder name: <input type="text" name="foldername">
        <br><?php echo ((is_array($_tmp='at')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

        <select style="width:100%" name="toFolder">
            <?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <br><input type="submit" class="btn" value="<?php echo ((is_array($_tmp='Create')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
    </form>
    <form id="movefolder" action="?q=movefolder" method="post" target="mgtfolderiframe">
        From:
        <select style="width:100%" name="fromFolder">
            <?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        To:
        <select style="width:100%" name="toFolder">
            <?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <br><input type="submit" class="btn" value="<?php echo ((is_array($_tmp='Move')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
    </form>
    <form id="renamefolder" action="?q=renamefolder" method="post" target="mgtfolderiframe">
        Rename
        <select style="width:100%" name="fromFolder">
            <?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        to <br><input type="text" name="newname">
        <br><input type="submit" class="btn" value="<?php echo ((is_array($_tmp='Rename')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
    </form>
    <form id="deletefolder" action="?q=deletefolder" method="post" target="mgtfolderiframe">
        Delete (including sub-folders and messages)
        <select style="width:100%" name="fromFolder">
            <?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <br>
        <input type="submit" class="btn" value="<?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
    </form>
</div>

<table align="center">
    <tr><td colspan="2">
            <input type="button" class="btn" value="<?php echo ((is_array($_tmp='Management folders')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="showMgtFolderDialog()">
            <input type="button" class="btn" value="<?php echo ((is_array($_tmp='new message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
" onclick="new showSendMsgDialog()">
        </td></tr>
    <tr>
        <td>
            <table id="folderTree"></table>
            <div id="pfolderTree"></div>
        </td>
        <td>
            <table id="folderView"></table>
            <div id="pfolderView"></div>
        </td>
    </tr>
</table>

<div id="messageView" title="<?php echo ((is_array($_tmp='Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
</div>

<div id="delmessage" title="<?php echo ((is_array($_tmp='Delete')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">
    <p><?php echo ((is_array($_tmp='Are you sure you want to delete those message?')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</p>
</div>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>