<?php /* Smarty version 2.6.26, created on 2011-04-11 11:15:28
         compiled from venueList.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'venueList.htm', 17, false),)), $this); ?>

<?php ob_start(); ?>
<style>
    .ui-dialog{
        font-size:80%
    }
</style>
<script>
    var map;
    var gotoGoogleMap=function(){};
    $(function(){
        $("#list").jqGrid({
            url:'?action=q',
            datatype: "json",
            colNames: [
                '#',
                '<?php echo ((is_array($_tmp='Venue name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Venue Abbr')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Tel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Region')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='District')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Address')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
                '<?php echo ((is_array($_tmp='Map')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
',
            ],
            
            colModel:[
                {name:"id",index:'venueId',width:30,hidden:true},
                {name:'name',index:'fullName',width:100},
                {name:'abbr',index:'abbrName',width:100},
                {name:'type',index:'typeId',width:100},
                {name:'tel',index:'tel',width:100},
                {name:'region',index:'distCode',width:100,formatter:function(v){return v=='HK'?'<?php echo ((is_array($_tmp='HKI')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
':(v=='NT'?'<?php echo ((is_array($_tmp='NT')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
':'<?php echo ((is_array($_tmp='KLN')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
')}},
                {name:'district',index:'distCode',width:100},
                {name:'address',index:'address',width:200},
                {name:'map',index:'map',hidden:true}
            ],
            rowNum:10,
            rowList:[10,20,30],
            pager: '#pager',
            sortname: 'id',
            viewrecords: true,
            sortorder: "desc",
            caption:"<?php echo ((is_array($_tmp='Venues')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
",
            width:800,
            height:300,
            onSelectRow:function(rowid,status){
                var id = jQuery("#list").jqGrid('getGridParam','selrow');
                if(!id)return;
                var data = jQuery("#list").jqGrid('getRowData',id);
                var p=eval(data.map);
                if(!p){
                    return;
                }
                gotoGoogleMap=function(){
                    window.open('http://maps.google.com.hk/maps?q=('+p[0]+','+p[1]+')&ll='+p[0]+','+p[1]+'&z=17')
                }
                $("#dialog-form").dialog('open');
                $("#dialog-form").dialog('option','title',"<?php echo ((is_array($_tmp='Map')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: <?php echo ((is_array($_tmp='Venues')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
#"+data.id +" - "+data.name);
                google.maps.event.trigger(map,'resize');
                map.panTo(new google.maps.LatLng(p[0],p[1]))
                map.setZoom(17);
                maker.setPosition(map.getCenter());
                maker.setTitle(data.venuename);
                infowindows.setContent("<div class='infoWin'>"
                    +"<?php echo ((is_array($_tmp='Venue name')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: "+data.name+"<br>"
                    +"<?php echo ((is_array($_tmp='Venue abbr')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: "+data.abbr+"<br>"
                // +"<?php echo ((is_array($_tmp='type')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: "+data.type+"<br>"
                    +"<?php echo ((is_array($_tmp='tel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: "+data.tel+"<br>"
                    +"<?php echo ((is_array($_tmp='address')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: "+data.address+"<br>"

                    +"</div>");
                infowindows.open(map,maker);
            }
        });

        jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false,search:false});

        jQuery("#list").jqGrid('gridResize');

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

        updateGrid=function(){
            var typeId=$("#typeId").val();
            var distCode=$("#distCode").val();
            $("#list").jqGrid().setGridParam({url:'?action=q&type='+typeId+'&district='+distCode});
            $("#list").jqGrid().trigger("reloadGrid");
        }
        $("#typeId").change(updateGrid);
        $("#distCode").change(updateGrid);


    });
</script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="dialog-form" title="<?php echo ((is_array($_tmp='Map')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
">

</div>
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