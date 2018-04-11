<?php /* Smarty version 2.6.26, created on 2011-05-12 16:33:55
         compiled from map.htm */ ?>
<?php ob_start(); ?>
<script>
    var map;

    var mapdata=[]
    i=0;
        <?php $_from = $this->_tpl_vars['venue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
        mapdata[i++]={position:<?php echo $this->_tpl_vars['i']->getMap(); ?>
,fullName:"<?php echo $this->_tpl_vars['i']->getFullName(); ?>
"};
        <?php endforeach; endif; unset($_from); ?>
    
    $(function(){
        map=new google.maps.Map($("#mapdiv").get(0),{
            zoom: 11,
            center: new google.maps.LatLng(22.283867,114.172977),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var i=0;
        maker=[];
       for(i=0;i<mapdata.length;i++){
            maker[i++]=new google.maps.Marker({
            position: new google.maps.LatLng(mapdata[i].position[0],mapdata[i].position[1]),
            map: map,
            title:mapdata[i].fullName
            });
       }
    });
</script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="mapdiv" style="width:100%;height:600px">

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>