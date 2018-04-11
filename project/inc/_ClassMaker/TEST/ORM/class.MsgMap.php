<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class MsgMap extends DataBoundObject {
    
    protected $folderId;
    protected $msgId;
    protected $state;

   
    protected function DefineTableName() {
        return 'msgMap';
    }

    protected function DefineRelationMap() {
        return array(
            'folderId'=>'folderId',
            'msgId'=>'msgId',
            'state'=>'state'   
        );
    }

    protected function DefinePrimaryKey() {
        return array('folderId','msgId');
    }

    public function getMsg(){
        return new Message($this->_DB,$this->getMsgId());
    }

    public function getFolder(){
        return new MsgFolder($this->_DB,$this->getFolderId());
    }



}