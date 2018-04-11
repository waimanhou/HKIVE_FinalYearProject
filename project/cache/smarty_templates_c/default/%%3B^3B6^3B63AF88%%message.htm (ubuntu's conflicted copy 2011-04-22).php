<?php /* Smarty version 2.6.26, created on 2011-04-13 02:54:57
         compiled from message.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'message.htm', 16, false),)), $this); ?>

<?php ob_start(); ?>

<style>
  .ui-dialog{font-size:80%}
  fieldset { padding:0; border:0; }
  input.text {  width:100%; padding: .4em; }
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
    jQuery("#folderView").jqGrid('navButtonAdd',"#pfolderView",
    {
      caption:"<?php echo ((is_array($_tmp='Move')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
", buttonicon:"ui-icon-transferthick-e-w", onClickButton:function(){
        
      }, position: "last", title:"", cursor: "pointer"
    });
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
          $("#messageView").dialog("close");
          //----------------------------------------------------------------MOVE!!!!
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

    
  });
</script>


<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table align="center">
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