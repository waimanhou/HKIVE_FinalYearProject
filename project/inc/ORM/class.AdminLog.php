<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

class AdminLog extends DataBoundObject {

    protected $logId;
    protected $adminId;
    protected $data;
    protected $type;

    protected function DefineTableName() {
        return 'adminlog';
    }

    protected function DefineRelationMap() {
        return array(
            'logid'=>'logId',
            'adminid'=>'adminId',
            'data'=>'data',
            'type'=>'type'
        );
    }

    protected function DefinePrimaryKey() {
        return array('logid');
    }

    function getAdmin(){
        return new Administrator($this->_DB,$this->getAdminId());
    }
}