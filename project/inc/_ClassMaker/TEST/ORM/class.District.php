<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class District extends DataBoundObject {
    
    protected $distCode;
    protected $chiName;
    protected $engName;

   
    protected function DefineTableName() {
        return 'district';
    }

    protected function DefineRelationMap() {
        return array(
            'distCode'=>'distCode',
            'chiName'=>'chiName',
            'engName'=>'engName'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'distCode';
    }



}