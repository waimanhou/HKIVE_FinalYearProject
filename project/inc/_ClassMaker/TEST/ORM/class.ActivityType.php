<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class ActivityType extends DataBoundObject {
    
    protected $type;
    protected $chiName;
    protected $engName;

   
    protected function DefineTableName() {
        return 'activityType';
    }

    protected function DefineRelationMap() {
        return array(
            'type'=>'type',
            'chiName'=>'chiName',
            'engName'=>'engName'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'type';
    }



}