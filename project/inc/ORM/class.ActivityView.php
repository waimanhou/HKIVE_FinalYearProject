<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

class ActivityView extends DataBoundObject {

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
    protected $distCode;
    protected $region;
    protected $activityTypeId;

    protected function DefineTableName() {
        return 'activityView';
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
            'playerPerTeam' => 'playerPerTeam',
            'distCode' => 'distCode',
            'region' => 'region',
            'activityTypeId' => 'activityTypeId'
        );
    }

    protected function DefinePrimaryKey() {
        return array('actId');
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

    public function getDist() {
        return new District($this->_DB, $this->getDistCode());
    }

    public function getActivityType() {
        return new ActivityType($this->_DB, $this->getActivityTypeId());
    }

    public function getActivityTypeStr() {
        if ($_SESSION['lang'] == 'zh') {
            return $this->getActivityType()->getChiName();
        } else {
            return $this->getActivityType()->getEngName();
        }
    }

}