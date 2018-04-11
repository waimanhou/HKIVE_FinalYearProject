<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

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
    protected $chiName;
    protected $engName;

    const TYPE_PUBLIC=0;    //all non-temp team can join
    const TYPE_INVITE=1;    //only invited non-temp team can join

    protected function DefineTableName() {
        return 'organization';
    }

    protected function DefineRelationMap() {
        return array(
            'orgId' => 'orgId',
            'creatorId' => 'creatorId',
            'noOfTeam' => 'noOfTeam',
            'noOfPlayer' => 'noOfPlayer',
            'joinedTimes' => 'joinedTimes',
            'url' => 'url',
            'slogan' => 'slogan',
            'distCode' => 'distCode',
            'description' => 'description',
            'type' => 'type',
            'chiName' => 'chiName',
            'engName' => 'engName'
        );
    }

    protected function DefinePrimaryKey() {
        return 'orgId';
    }

    public function getCreator() {
        return new Account($this->_DB, $this->getCreatorId());
    }

    public function getDist() {
        return new District($this->_DB, $this->getDistCode());
    }

    public function getName() {
        return $_SESSION['lang'] == 'zh' ? $this->getChiName() : $this->getEngName();
    }

    public function getTeams($status=OrgReq::TYPE_JOINED) {
        $orgreq = new OrgReq($this->_DB);
        $result = $orgreq->searchf(
                        array(
                            'field_list' => array(
                                'orgId' => $this->getOrgId(),
                                'status' => 255
                            )
                        )
        );
        $list = array();
        foreach ($result as $v) {
            $list[] = $v->getTeam();
        }
        return $list;
    }

    public function getOrgReqs() {
        $orgreq = new OrgReq($this->_DB);
        return $orgreq->searchf(array('field_list' => array('orgId' => $this->getOrgId())));
    }

    public function getTeamActivitiesAry() {
        $teams = $this->getTeams();
        $list = array();
        foreach ($teams as $team) {
            $act = $team->getActivities();
            foreach ($act as $v) {
                $list[] = array($team, $v);
            }
        }
        return $list;
    }

    public function updateNoOfTeamAndPlayer($save=false) {
        /* $this->setNoOfTeam(count($this->getTeams())); */
        $teams = $this->getTeams();
        $this->setNoOfTeam(count($teams));
        $c = 0;
        foreach ($teams as $v) {
            $c+=$v->getNoOfPlayer();
        }
        $this->setNoOfPlayer($c);
        if ($save
            )$this->Save();
    }

    public function __toString() {
        return $this->chiName;
    }

    public function getLogoPath($size=32) {
        return file_exists(ROOT."/images/userfile/orgs/{$this->getOrgId()}/logo{$size}.jpg") ? "/images/userfile/orgs/{$this->getOrgId()}/logo{$size}.jpg" : "/images/s.gif";
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