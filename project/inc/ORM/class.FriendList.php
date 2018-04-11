<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class FriendList extends DataBoundObject {
    
    protected $listId;
    protected $userId;
    protected $name;

   
    protected function DefineTableName() {
        return 'friendList';
    }

    protected function DefineRelationMap() {
        return array(
            'listId'=>'listId',
            'userId'=>'userId',
            'name'=>'name'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'listId';
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }


    public function getFriends(){
        $f=new Friend($this->_DB);
		return $f->search($this->getListId(),array(listId),'=','and',false,-1);
    }

    public function getFriendAccounts(){
        $f=$this->getFriends();
        for($i=0;$i<count($f);$i++){
            $f[$i]=$f[$i]->getUser();
        }
        return $f;
    }



}