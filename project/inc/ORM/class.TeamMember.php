<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class TeamMember extends DataBoundObject {
    
    protected $teamId;
    protected $userId;
    protected $type;
    protected $tmId;

   const TYPE_USER_REQ_TEAM=0;  //the user requested to join the team
   const TYPE_TEAM_REQ_USER=1;  //the team leader invited a user to join the team
   const TYPE_TEAM_REJ_USER=2;  //the team leader rejected the invitation of type=TYPE_USER_REQ_TEAM=0
   const TYPE_USER_REJ_TEAM=3;  // the user rejected the invitation of type=TYPE_TEAM_REQ_USER=1
   const TYPE_JOINED=255;       //joined

    
    protected function DefineTableName() {
        return 'teamMember';
    }

    protected function DefineRelationMap() {
        return array(
            'teamId'=>'teamId',
            'userId'=>'userId',
            'type'=>'type',
            'tmId'=>'tmId'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'tmId';
    }

    public function getTeam(){
        return new Team($this->_DB,$this->getTeamId());
    }

    public function getUser(){
        return new Account($this->_DB,$this->getUserId());
    }



}