<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class BlackList extends DataBoundObject {
    
    protected $ownerId;
    protected $userId;

   
    protected function DefineTableName() {
        return 'blackList';
    }

    protected function DefineRelationMap() {
        return array(
            'ownerId'=>'ownerId',
            'userId'=>'userId'   
        );
    }

    protected function DefinePrimaryKey() {
        return array('ownerId','userId');
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }

    public function getOwner(){
        return new Account($this->_DB,$this->getOwnerId());
    }



}