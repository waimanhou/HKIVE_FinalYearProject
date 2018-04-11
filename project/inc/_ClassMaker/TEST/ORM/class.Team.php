<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Team extends DataBoundObject {
    
    protected $teamId;
    protected $chiName;
    protected $engName;
    protected $leaderId;
    protected $orgId;
    protected $temporary;
    protected $noOfPlayer;
    protected $activityTimes;
    protected $url;
    protected $distCode;
    protected $slogan;
    protected $description;
    protected $type;

   
    protected function DefineTableName() {
        return 'team';
    }

    protected function DefineRelationMap() {
        return array(
            'teamId'=>'teamId',
            'chiname'=>'chiName',
            'engname'=>'engName',
            'leaderId'=>'leaderId',
            'orgId'=>'orgId',
            'temporary'=>'temporary',
            'noOfPlayer'=>'noOfPlayer',
            'activityTimes'=>'activityTimes',
            'url'=>'url',
            'distCode'=>'distCode',
            'slogan'=>'slogan',
            'description'=>'description',
            'type'=>'type'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'teamId';
    }

    public function getDist(){
        return new District($this->_DB,$this->getDistCode());
    }

    public function getOrg(){
        return new Organization($this->_DB,$this->getOrgId());
    }

    public function getLeader(){
        return new Account($this->_DB,$this->getLeaderId());
    }



}