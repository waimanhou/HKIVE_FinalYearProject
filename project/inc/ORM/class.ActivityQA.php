<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class ActivityQA extends DataBoundObject {
    
    protected $qaId;
    protected $actId;
    protected $userId;
    protected $question;
    protected $answer;
    protected $qTime;
    protected $aTime;

   
    protected function DefineTableName() {
        return 'activityQA';
    }

    protected function DefineRelationMap() {
        return array(
            'qaId'=>'qaId',
            'actId'=>'actId',
            'userId'=>'userId',
            'question'=>'question',
            'answer'=>'answer',
            'qTime'=>'qTime',
            'aTime'=>'aTime'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'qaId';
    }

    public function getAct(){
        return new Activity($this->_DB,$this->getActId());
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }



}