<?php include_once realpath(dirname(__FILE__))."/class.DataBoundObject.php";class FriendList extends DataBoundObject {

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

}?>