<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Gift extends DataBoundObject {
    
    protected $gid;
    protected $name;
    protected $desc;
    protected $point;
    protected $qty;
    protected $remain;

   
    protected function DefineTableName() {
        return 'gift';
    }

    protected function DefineRelationMap() {
        return array(
            'gid'=>'gid',
            'name'=>'name',
            'desc'=>'desc',
            'point'=>'point',
            'qty'=>'qty',
            'remain'=>'remain'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'gid';
    }



}