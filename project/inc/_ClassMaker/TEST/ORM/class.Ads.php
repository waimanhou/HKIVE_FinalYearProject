<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Ads extends DataBoundObject {
    
    protected $advId;
    protected $available;
    protected $type;
    protected $displayOrder;
    protected $title;
    protected $parameters;
    protected $code;
    protected $startTime;
    protected $endTime;

   
    protected function DefineTableName() {
        return 'ads';
    }

    protected function DefineRelationMap() {
        return array(
            'advid'=>'advId',
            'available'=>'available',
            'type'=>'type',
            'displayorder'=>'displayOrder',
            'title'=>'title',
            'parameters'=>'parameters',
            'code'=>'code',
            'starttime'=>'startTime',
            'endtime'=>'endTime'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'advid';
    }



}