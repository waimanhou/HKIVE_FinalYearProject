<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class TeamMember extends DataBoundObject {
    
    protected $teamId;
    protected $userId;
    protected $type;

   
    protected function DefineTableName() {
        return 'teamMember';
    }

    protected function DefineRelationMap() {
        return array(
            'teamId'=>'teamId',
            'userId'=>'userId',
            'type'=>'type'   
        );
    }

    protected function DefinePrimaryKey() {
        return array('teamId','userId');
    }

    public function getTeam(){
        return new Team($this->_DB,$this->getTeamId());
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }



}