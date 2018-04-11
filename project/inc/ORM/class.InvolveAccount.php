<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

class InvolveAccount extends DataBoundObject {

    protected $iaId;
    protected $actId;
    protected $userId;
    protected $itId;
    protected $teamId;//TO BE DELETED
    protected $time;
    protected $status;
    protected $credit;//TO BE DELETED
    protected $info;

//    const STATUS_REQUESTED = 0;    //sent "join request" by team leader
//    const STATUS_INVITED = 1;      //owner invited the team to join
//    const STATUS_REJECTED = 2;     //the owner rejected the team's "join request"
//    const STATUS_REJECTED2 = 3;    //team rejected the invitation
//    const STATUS_ACCEPTED = 255;   //owner accepted team's "join request"
    const STATUS_USER_REQ_IT=0;     //user sent join request to IT
    const STATUS_IT_REQ_USER=1;     //IT(team owner) sent join req to user
    const STATUS_IT_REJ_USER=2;     //rejected 0
    const STATUS_USER_REJ_IT=3;     //rejected 1
    const STATUS_ACCEPTED = 255;   

    protected function DefineTableName() {
        return 'involveAccount';
    }

    protected function DefineRelationMap() {
        return array(
            'iaId' => 'iaId',
            'actId' => 'actId',
            'userId' => 'userId',
            'itId' => 'itId',
            'teamId' => 'teamId',//TO BE DELETED
            'time' => 'time',
            'status' => 'status',
            'credit' => 'credit',   //TO BE DELETED
            'info' => 'info'
        );
    }

    protected function DefinePrimaryKey() {
        return 'iaId';
    }

    public function getIt() {
        return new InvolveTeam($this->_DB, $this->getItId());
    }

    public function getUser() {
        return new Account($this->_DB, $this->getUserId());
    }

    public function getAct() {
        return new Activity($this->_DB, $this->getActId());
    }

}