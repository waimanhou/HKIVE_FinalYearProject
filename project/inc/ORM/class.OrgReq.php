<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class OrgReq extends DataBoundObject {
    
    protected $invId;
    protected $orgId;
    protected $teamId;
    protected $status;
    protected $reqMsg;

    const TYPE_ORG_REQ_TEAM=0;  //the organization requested the team to join
    const TYPE_TEAM_REQ_ORG=1;  //the team requested to the the organization
    const TYPE_TEAM_REJ_ORG=2;  //the team rejected the organization (rejected a request of OrgReq.type=0)
    const TYPE_ORG_REJ_TEAM=3;  //the organization rejected the team (rejected a request of OrgReq.type=1)
    const TYPE_JOINED=255;      //joined

   
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