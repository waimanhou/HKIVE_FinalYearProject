<?php /* Smarty version 2.6.26, created on 2011-05-10 11:20:04
         compiled from activityList.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'activityList.htm', 21, false),)), $this); ?>
<?php ob_start(); ?>
<style>
	.ui-resizable-helper { border: 2px dotted gray; }
    .infoWin{
        font-size:80%;
    }
    .ui-dialog{
        font-size:80%;
    }</style>
<script>
    var map;
    var maker;
    var infowindows;
    var viewDetail=function(){};
    $(function(){
        $("#list").jqGrid({
            url:'?action=getActivityList',
            datatype: "xml",
            colNames: [
                '#',
                '<?php echo ((is_array($_tmp='ActivityName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='OwnerId')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Owner')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Credit')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='VenueId')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Venue abbr')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Venue name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Region')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Map')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='date')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='starttime')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='endtime')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
'
            ],
            colModel:[
                {name:"activityid",index:'1',width:20,sortable:false,hidden:true},
                {name:"activityname",index:'1',width:150,sortable:false},
                {name:'ownerid',index:'2',width:100,hidden:true,sortable:false},
                {name:'owner',index:'3',width:150,sortable:false},
                {name:'ownercredit',index:'5',width:40,sortable:false,align:'center'},
                {name:'venueid',index:'5',width:100,hidden:true,sortable:false},
                {name:'venueabbr',index:'5',width:70,sortable:false},
                {name:'venuename',index:'5',width:100,hidden:true,sortable:false},
                {name:'venuetype',index:'5',width:70,sortable:false},
                {name:'region',index:'5',width:50,sortable:false,formatter:function(v){return v=='HK'?'<?php echo ((is_array($_tmp='HKI')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
':(v=='NT'?'<?php echo ((is_array($_tmp='NT')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
':'<?php echo ((is_array($_tmp='KLN')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
')}},
                {name:'district',index:'5',width:70,sortable:false},
                
                {name:"map",index:'1',width:30,sortable:false,hidden:true},
                {name:"date",index:'1',width:80,sortable:false,align:'center'},
                {name:"start",index:'1',width:60,sortable:false,align:'center'},
                {name:"end",index:'1',width:60,sortable:false,align:'center'}

            ],
            rowNum:10,
            rowList:[10,20,30],
            pager: '#pager',
            sortname: 'id',
            viewrecords: true,
            sortorder: "desc",
            caption:"<?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
",
            width:900,
            height:300,
            onSelectRow:function(rowid,status){
                //$("#map").attr("src", )
                var id = jQuery("#list").jqGrid('getGridParam','selrow');
                if(!id)return;

                var data = jQuery("#list").jqGrid('getRowData',id);
                showActivity(data.activityid);
            },
            gridComplete:function(){

                var ids = jQuery("#list").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var data=$("#list").jqGrid('getRowData', ids[i]);
                    jQuery("#list").jqGrid('setRowData',ids[i],{
                        reqteam:data.jointeam+"/"+data.reqteam,
                        reqplayer:data.joinplayer+"/"+data.reqplayer

                    });
                }

            }

        });


        jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false,search:false});

        jQuery("#list").jqGrid('gridResize');
        /*
        $("#dialog-form").dialog({
            autoOpen: false,
            height: 500,
            width: 500,
            modal: false,
            buttons:{
                "<?php echo ((is_array($_tmp='Close')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function(){$("#dialog-form").dialog('close')},
                "<?php echo ((is_array($_tmp='View Detail')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function(){viewDetail()}
            },
            resize:function(){
                google.maps.event.trigger(map, 'resize');
            }


        });

        map=new google.maps.Map($("#dialog-form").get(0),{
            zoom: 15,
            center: new google.maps.LatLng(22.283867,114.172977),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        maker=new google.maps.Marker({
            position: new google.maps.LatLng(22.283867,114.172977),
            map: map,
            title:""
        });
        
        infowindows=new google.maps.InfoWindow();

         */

        updateGrid=function(){
            var typeId=$("#typeId").val();
            var distCode=$("#distCode").val();
            var keyword=$("#keyword").val();

            $("#list").jqGrid().setGridParam({url:'?action=getActivityList&type='+typeId+'&district='+distCode+'&keyword='+encodeURIComponent(keyword)});
            $("#list").jqGrid().trigger("reloadGrid");
        }
        $("#typeId").change(updateGrid);
        $("#distCode").change(updateGrid);
        $("#keyword").change(updateGrid).keyup(updateGrid);

    });
</script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<!--div id="dialog-form" title="<?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">

</div-->


<table width="100%">
    <tr><td align="center">
  

<center><?php echo ((is_array($_tmp='filter')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

    <select name="type" id="typeId">
        <option value="all"><?php echo ((is_array($_tmp='all type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>

        <?php $_from = $this->_tpl_vars['activityType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
        <option value="<?php echo $this->_tpl_vars['a']->getType(); ?>
"><?php echo $this->_tpl_vars['a']->getName(); ?>
</option>
        <?php endforeach; endif; unset($_from); ?>

    </select>

    <select name="district" id="distCode">
    <option value="all"><?php echo ((is_array($_tmp='all district')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>

        <?php $_from = $this->_tpl_vars['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['b']):
?>
        <option value="<?php echo $this->_tpl_vars['b']->getDistCode(); ?>
"><?php echo $this->_tpl_vars['b']->getName(); ?>
</option>
        <?php endforeach; endif; unset($_from); ?>

    </select>
  <?php echo ((is_array($_tmp='keyword')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
:<input type="text" id="keyword"/>&nbsp;
</center>
  </td>
  <td><?php if ($_SESSION['userId']): ?>
      <a href="?action=create"><img src="./images/add_icon.png"><?php echo ((is_array($_tmp='Create activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
      <?php endif; ?>
  </td></tr>
    <tr>
        <td align="center" colspan="2">
            <table id="list"></table>
            <div id="pager"></div>
        </td>
    </tr>
</table>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>