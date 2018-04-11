<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

class Activity extends DataBoundObject {

    protected $actId;
    protected $ownerId;
    protected $venueId;
    protected $startTime;
    protected $endTime;
    protected $otherInfo;
    protected $name;
    protected $status;
    protected $type;
    protected $orgId;
    protected $requiredTeam;
    protected $requestedTeam;
    protected $acceptedTeam;
    protected $playerPerTeam;

    const TYPE_PUBLIC = 0;  //all member / team / temp team can sent "join request"
    const TYPE_INVITE = 1;  //only can join by team leader send invite to user
    const TYPE_TEAM = 2;    //only non-temp team can join
    const TYPE_ORG = 3;     //only the teams of the specificed organization (col `orgId`) can request to join

    const STATUS_OPEN=1;
    const STATUS_CLOSED=0;
    const STATUS_CANCELLED=2;

    protected function DefineTableName() {
        return 'activity';
    }

    protected function DefineRelationMap() {
        return array(
            'actId' => 'actId',
            'ownerId' => 'ownerId',
            'venueId' => 'venueId',
            'starttime' => 'startTime',
            'endtime' => 'endTime',
            'otherInfo' => 'otherInfo',
            'name' => 'name',
            'status' => 'status',
            'type' => 'type',
            'orgId' => 'orgId',
            'requiredTeam' => 'requiredTeam',
            'requestedTeam' => 'requestedTeam',
            'acceptedTeam' => 'acceptedTeam',
            'playerPerTeam' => 'playerPerTeam'
        );
    }

    protected function DefinePrimaryKey() {
        return 'actId';
    }

    public function getOrg() {
        return new Organization($this->_DB, $this->getOrgId());
    }

    public function getOwner() {
        return new Account($this->_DB, $this->getOwnerId());
    }

    public function getVenue() {
        return new Venue($this->_DB, $this->getVenueId());
    }

    public function getQA() {
        $aqa = new ActivityQA($this->_DB);
        return $aqa->vsearch(
                array(
                    'where' => 'actId=' . $this->getActId(),
                    'limit' => -1
        )); /*
          return $aqa->vsearch(
          ); */
    }

    public function getAllInvolveAccountAccount($excludeRejected=true) {
        if ($excludeRejected) {
            $records = $this->_DB->fetch_all(
                            "SELECT acc.userId
                    FROM activity act, involveteam it, involveaccount ia, account acc
                    WHERE act.actid = {$this->getActId()}
                    AND act.actid = it.actid
                    AND ia.itid = it.itid
                    AND ia.userId = acc.userId
                    AND it.status <3
                    AND (
                    ia.status <2
                    OR ia.status >3
                    )
                    AND it.DELETED IS NULL
                    AND ia.DELETED IS NULL"
            );
        } else {
            $records = $this->_DB->fetch_all(
                            "SELECT acc.userId
                    FROM activity act, involveteam it, involveaccount ia, account acc
                    WHERE act.actid = {$this->getActId()}
                    AND act.actid = it.actid
                    AND ia.itid = it.itid
                    AND ia.userId = acc.userId
                    AND it.DELETED IS NULL
                    AND ia.DELETED IS NULL"
            );
        }
        foreach ($records as &$v) {
            $v=$v['userId'];
        }
        $records=array_unique($records);
        $list = array();
        foreach ($records as $v) {
            $list[] = new Account($this->_DB, $v);
        }
        return $list;
    }

}