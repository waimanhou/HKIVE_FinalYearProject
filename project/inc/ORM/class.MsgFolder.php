<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class MsgFolder extends DataBoundObject {
    
    protected $folderId;
    protected $parentFolderId;
    protected $name;
    protected $userId;

   
    protected function DefineTableName() {
        return 'msgFolder';
    }

    protected function DefineRelationMap() {
        return array(
            'folderId'=>'folderId',
            'parentFolderId'=>'parentFolderId',
            'name'=>'name',
            'userId'=>'userId'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'folderId';
    }

    public function getParentFolder(){
        return new MsgFolder($this->_DB,$this->getParentFolderId());
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }

    public function getSubFolder(){
        return $this->vsearch(
            array(
                "keyword"=>$this->getFolderId(),
                "fieldname_array"=>array("parentFolderId"),
                "limit"=>-1,
                "operator"=>"="
             )
         );
    }
    
    public function getMsg(){
        $msg=new MsgMap($this->_DB);
        $msg=$msg->vsearch(
            array(
                "keyword"=>$this->getFolderId(),
                "fieldname_array"=>array("folderId"),
                "limit"=>-1,
                "operator"=>"=",
                "orderby"=>"msgId",
                "order"=>"DESC"
            )
        );
        foreach($msg as $k => $v){
            $msg[$k]=$v->getMsg();
        }
        return $msg;
    }
    
    
    


}