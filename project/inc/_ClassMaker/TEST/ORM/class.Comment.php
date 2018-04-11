<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Comment extends DataBoundObject {
    
    protected $cid;
    protected $fromId;
    protected $toId;
    protected $comment;
    protected $value;

   
    protected function DefineTableName() {
        return 'comment';
    }

    protected function DefineRelationMap() {
        return array(
            'cid'=>'cid',
            'fromId'=>'fromId',
            'toId'=>'toId',
            'comment'=>'comment',
            'value'=>'value'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'cid';
    }

    public function getFrom(){
        return new Account($this->_DB,$this->getFromId());
    }

    public function getTo(){
        return new Account($this->_DB,$this->getToId());
    }



}