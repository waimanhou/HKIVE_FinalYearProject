<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Organization extends DataBoundObject {
    
    protected $orgId;
    protected $creatorId;
    protected $noOfTeam;
    protected $noOfPlayer;
    protected $joinedTimes;
    protected $url;
    protected $slogan;
    protected $distCode;
    protected $description;
    protected $type;

   
    protected function DefineTableName() {
        return 'organization';
    }

    protected function DefineRelationMap() {
        return array(
            'orgId'=>'orgId',
            'creatorId'=>'creatorId',
            'noOfTeam'=>'noOfTeam',
            'noOfPlayer'=>'noOfPlayer',
            'joinedTimes'=>'joinedTimes',
            'url'=>'url',
            'slogan'=>'slogan',
            'distCode'=>'distCode',
            'description'=>'description',
            'type'=>'type'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'orgId';
    }

    public function getDist(){
        return new District($this->_DB,$this->getDistCode());
    }

    public function getCreator(){
        return new Account($this->_DB,$this->getCreatorId());
    }



}