<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class OrgReq extends DataBoundObject {
    
    protected $invId;
    protected $orgId;
    protected $teamId;
    protected $status;
    protected $reqMsg;

   
    protected function DefineTableName() {
        return 'orgReq';
    }

    protected function DefineRelationMap() {
        return array(
            'invId'=>'invId',
            'orgId'=>'orgId',
            'teamId'=>'teamId',
            'status'=>'status',
            'reqMsg'=>'reqMsg'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'invId';
    }

    public function getOrg(){
        return new Organization($this->_DB,$this->getOrgId());
    }

    public function getTeam(){
        return new Team($this->_DB,$this->getTeamId());
    }



}