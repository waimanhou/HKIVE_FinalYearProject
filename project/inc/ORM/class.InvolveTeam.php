<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

class InvolveTeam extends DataBoundObject {

    protected $itId;
    protected $actId;
    protected $teamId;
    protected $status;
    protected $type;
    protected $selected;
    /*
    const STATUS_REQUESTED = 0;    //sent "join request" by team leader
    const STATUS_INVITED = 1;      //owner invited the team to join
    const STATUS_REJECTED = 2;     //the owner rejected the team's "join request"
    const STATUS_REJECTED2 = 3;    //team rejected the invitation
    const STATUS_ACCEPTED = 255;   //owner accepted team's "join request"
*/
    const TYPE_GUEST_TEAM=0;
    const TYPE_OWNER_TEAM=1;  //activity owner team

    const STATUS_PUBLIC=0;      //Allow Foreign players
    const STATUS_PRIVATE=1;     //NOT allow Foreign players
    const STATUS_INVITED=2;
    const STATUS_REJECTED=3;
//    const STATUS_SELECTED=2;    

    protected function DefineTableName() {
        return 'involveTeam';
    }

    protected function DefineRelationMap() {
        return array(
            'itId' => 'itId',
            'actId' => 'actId',
            'teamId' => 'teamId',
            'status' => 'status',
            'type' => 'type',
            'selected'=>'selected'
        );
    }

    protected function DefinePrimaryKey() {
        return 'itId';
    }

    public function getTeam() {
        return new Team($this->_DB, $this->getTeamId());
    }

    public function getAct() {
        return new Activity($this->_DB, $this->getActId());
    }

    public function getNoOfPlayer(){
        $result=$this->_DB->fetch_first("SELECT count(*) as c FROM involveaccount where DELETED is null and itId={$this->getItId()} and status=".InvolveAccount::STATUS_ACCEPTED);
        return $result['c'];
    }
}
