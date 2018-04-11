<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Friend extends DataBoundObject {
    
    protected $listId;
    protected $userId;
    protected $status;

   
    protected function DefineTableName() {
        return 'friend';
    }

    protected function DefineRelationMap() {
        return array(
            'listId'=>'listId',
            'userId'=>'userId',
            'status'=>'status'   
        );
    }

    protected function DefinePrimaryKey() {
        return array('listId','userId');
    }

    public function getList(){
        return new FriendList($this->_DB,$this->getListId());
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }



}