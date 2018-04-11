<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

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

    const TYPE_PUBLIC=0;    //Public
    const TYPE_PRIVATE=1;   //Private (by invitation only)

    protected function DefineTableName() {
        return 'team';
    }

    protected function DefineRelationMap() {
        return array(
            'teamId' => 'teamId',
            'chiname' => 'chiName',
            'engname' => 'engName',
            'leaderId' => 'leaderId',
            'orgId' => 'orgId',
            'temporary' => 'temporary',
            'noOfPlayer' => 'noOfPlayer',
            'activityTimes' => 'activityTimes',
            'url' => 'url',
            'distCode' => 'distCode',
            'slogan' => 'slogan',
            'description' => 'description',
            'type' => 'type'
        );
    }

    protected function DefinePrimaryKey() {
        return 'teamId';
    }

    public function getDist() {
        return new District($this->_DB, $this->getDistCode());
    }

    public function getOrg() {
        return new Organization($this->_DB, $this->getOrgId());
    }

    public function getLeader() {
        return new Account($this->_DB, $this->getLeaderId());
    }

    public function getName() {
        return $_SESSION['lang'] == 'zh' ? $this->getChiName() : $this->getEngName();
    }

    public function getTeamMembers() {
        $tm = new TeamMember($this->_DB);
        return $tm->searchf(array('field_list' => array('teamId' => $this->getTeamId())));
    }

    public function getMemberAccounts($type=TeamMember::TYPE_JOINED) {
        $tm = new TeamMember($this->_DB);
        $result = $tm->searchf(
                        array(
                            'field_list' => array(
                                'teamId' => $this->getTeamId(),
                                'type' => $type
                            )
                        )
        );
        $ren = array();
        foreach ($result as $k => $v) {
            $ren[] = $v->getUser();
        }
        return $ren;
    }

    public function getActivities() {
        $ia = new InvolveTeam($this->_DB);
        $list = $ia->searchf(
                        array(
                            'field_list' => array(
                                'teamId' => $this->getTeamId(),
                                //'userId' => null,
                                'selected' => 1
                            )
                        )
        );
        $activities = array();
        foreach ($list as $v) {
            $activities[] = $v->getAct();
        }
        return $activities;
    }

//public function getNoOfPlayer(){return 999;}
    public function updateNoOfPlayer($autosave=false) {
        $this->setNoOfPlayer(count($this->getTeamMembers()));
        if ($autosave

            )$this->save();
    }

    public function getLogoPath($size=32) {
        return file_exists(ROOT."/images/userfile/teams/{$this->getTeamId()}/logo{$size}.jpg") ? "/images/userfile/teams/{$this->getTeamId()}/logo{$size}.jpg" : "/images/s.gif";
    }

    public function showLogoHTML($size=32, $return=true) {
        $html = <<<EOD
   <img src="{$this->getLogoPath($size)}" width=$size height=$size/>
EOD;
        if (!$return) {
            echo $html;
        } else {
            return $html;
        }
    }

}