<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class InvolveAccount extends DataBoundObject {
    
    protected $iaId;
    protected $actId;
    protected $userId;
    protected $teamId;
    protected $time;
    protected $status;

   
    protected function DefineTableName() {
        return 'involveAccount';
    }

    protected function DefineRelationMap() {
        return array(
            'iaId'=>'iaId',
            'actId'=>'actId',
            'userId'=>'userId',
            'teamId'=>'teamId',
            'time'=>'time',
            'status'=>'status'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'iaId';
    }

    public function getTeam(){
        return new Team($this->_DB,$this->getTeamId());
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }

    public function getAct(){
        return new Activity($this->_DB,$this->getActId());
    }



}