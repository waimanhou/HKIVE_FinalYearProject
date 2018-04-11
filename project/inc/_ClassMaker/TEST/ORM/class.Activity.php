<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Activity extends DataBoundObject {
    
    protected $actId;
    protected $ownerId;
    protected $venueId;
    protected $startTime;
    protected $endTime;
    protected $otherInfo;
    protected $requiredNoOfTeam;
    protected $requiredNoOfPlayer;
    protected $name;
    protected $joinedNoOfPlayer;
    protected $joinedNoOfTeam;
    protected $status;
    protected $type;
    protected $orgId;

   
    protected function DefineTableName() {
        return 'activity';
    }

    protected function DefineRelationMap() {
        return array(
            'actId'=>'actId',
            'ownerId'=>'ownerId',
            'venueId'=>'venueId',
            'starttime'=>'startTime',
            'endtime'=>'endTime',
            'otherInfo'=>'otherInfo',
            'requiredNoOfTeam'=>'requiredNoOfTeam',
            'requiredNoOfPlayer'=>'requiredNoOfPlayer',
            'name'=>'name',
            'joinedNoOfPlayer'=>'joinedNoOfPlayer',
            'joinedNoOfTeam'=>'joinedNoOfTeam',
            'status'=>'status',
            'type'=>'type',
            'orgId'=>'orgId'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'actId';
    }

    public function getOrg(){
        return new Organization($this->_DB,$this->getOrgId());
    }

    public function getOwner(){
        return new Account($this->_DB,$this->getOwnerId());
    }

    public function getVenue(){
        return new Venue($this->_DB,$this->getVenueId());
    }



    public function getQA() {
        $aqa = new ActivityQA($this->_DB);
        return $aqa->vsearch(
                array(
                    'where'=>'actId='.$this->getActId(),
                    'limit'=>-1
                ));/*
        return $aqa->vsearch(
        );*/
    }
    
    


}