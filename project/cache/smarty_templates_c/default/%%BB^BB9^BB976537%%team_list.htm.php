<?php /* Smarty version 2.6.26, created on 2011-04-13 16:06:35
         compiled from team_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'team_list.htm', 15, false),)), $this); ?>
<?php ob_start(); ?>
<style>
    .ui-dialog{
        font-size:80%
    }
</style>
<script>
    $(function(){
      
        $("#list").jqGrid({
            url:'?action=getList',
            datatype: "xml",
            colNames: [
                '#',
                '<?php echo ((is_array($_tmp='Team Name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Leader Nickname')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Leader LoginName')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='URL')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='OrgId')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
'
            ],
            colModel:[
                {name:"id",index:'teamId',width:30,hidden:true},
                {name:'name',index:'fullName',width:100},
                {name:'nickname',index:'nickName',width:100},
                {name:'loginname',index:'loginname',width:100,hidden:true},
                {name:'district',index:'distcode',width:50},
                {name:'type',index:'type',width:100,formatter:function(v){return v==0 ? '<?php echo ((is_array($_tmp='PUBLIC')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
' : '<?php echo ((is_array($_tmp='PRIVATE')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
';}},
                {name:'url',index:'url',width:200,formatter:function(v){return v?('<a href="'+v+'">'+v+'</a>'):''}},
                {name:'orgId',index:'orgId',hidden:true},
                {name:'org',index:'org',formatter:function(v){return v?'<u>'+v+'</u>':''}}

            ],
            rowNum:10,
            rowList:[10,20,30],
            pager: '#pager',
            sortname: 'id',
            viewrecords: true,
            sortorder: "desc",
            caption:"<?php echo ((is_array($_tmp='Teams')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
",
            width:800,
            height:300,
            onCellSelect:function(rowid,icol,cellcontent,e){
                var data = jQuery("#list").jqGrid('getRowData',rowid);
                if(icol==8){
                    if(data.orgId){
                    showOrg(data.orgId)
                    }else{
                        jqAlert('<?php echo ((is_array($_tmp="This team didn\'t join any organization")) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
','<?php echo ((is_array($_tmp='message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',1)
                    }
                }else{
                    showTeam(data.id);
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
            // close: function(){activityWinList[_this.activityId]=false},
            buttons:{
                "<?php echo ((is_array($_tmp='close')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
":function(){$(this).dialog("close")},
                "<?php echo ((is_array($_tmp='Open in new window')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
":function(){gotoGoogleMap();}

            },resize:function(){
                google.maps.event.trigger(map, 'resize');
            }
        });


        map=new google.maps.Map($("#dialog-form").get(0),{
            zoom: 17,
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
            //var typeId=$("#typeId").val();
            var distCode=$("#distCode").val();
            // $("#list").jqGrid().setGridParam({url:'?action=q&type='+typeId+'&district='+distCode});
            $("#list").jqGrid().setGridParam({url:'?action=getList&district='+distCode});
            $("#list").jqGrid().trigger("reloadGrid");
        }
        //$("#typeId").change(updateGrid);
        $("#distCode").change(updateGrid);


    });
</script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--div id="dialog-form" title="<?php echo ((is_array($_tmp='Map')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">

</div-->
<center>
    <table width="70%"><tr><td align="center">
    <?php echo ((is_array($_tmp='filter')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>

    <select name="district" id="distCode">
        <option value="all"><?php echo ((is_array($_tmp='all district')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</option>
        <option value="na">N/A</option>
        <?php $_from = $this->_tpl_vars['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['b']):
?>
        <option value="<?php echo $this->_tpl_vars['b']->getDistCode(); ?>
"><?php echo $this->_tpl_vars['b']->getName(); ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
            </td>
            <td align="center">
                <a href="?action=createteam"><img src="./images/add_team_icon.png"><?php echo ((is_array($_tmp='Create Your Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>
            </td>
    </table>
</center>
<table width="100%">
    <tr>
        <td align="center">
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