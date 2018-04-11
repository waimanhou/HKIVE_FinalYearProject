<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class RedeemGift extends DataBoundObject {
    
    protected $userId;
    protected $gid;
    protected $status;
    protected $rgId;

   
    protected function DefineTableName() {
        return 'redeemGift';
    }

    protected function DefineRelationMap() {
        return array(
            'userId'=>'userId',
            'gid'=>'gid',
            'status'=>'status',
            'rgId'=>'rgId'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'rgId';
    }

    public function getGift(){
        return new Gift($this->_DB,$this->getGid());
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }



}