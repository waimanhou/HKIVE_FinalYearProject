<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Account extends DataBoundObject {
    
    protected $userId;
    protected $loginName;
    protected $chiName;
    protected $engName;
    protected $password;
    protected $salt;
    protected $sessionId;
    protected $point;
    protected $credit;
    protected $email;
    protected $tel1;
    protected $tel2;
    protected $lastLogin;
    protected $lastIp;
    protected $HKID;
    protected $nickName;
    protected $defaultMsgFolderId;
    protected $defaultFriendListId;

   
    protected function DefineTableName() {
        return 'account';
    }

    protected function DefineRelationMap() {
        return array(
            'userId'=>'userId',
            'loginName'=>'loginName',
            'chiname'=>'chiName',
            'engname'=>'engName',
            'password'=>'password',
            'salt'=>'salt',
            'sessionid'=>'sessionId',
            'point'=>'point',
            'credit'=>'credit',
            'email'=>'email',
            'tel1'=>'tel1',
            'tel2'=>'tel2',
            'lastlogin'=>'lastLogin',
            'lastip'=>'lastIp',
            'HKID'=>'HKID',
            'nickName'=>'nickName',
            'defaultMsgFolderId'=>'defaultMsgFolderId',
            'defaultFriendListId'=>'defaultFriendListId'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'userId';
    }

    public function getDefaultMsgFolder(){
        return new MsgFolder($this->_DB,$this->getDefaultMsgFolderId());
    }

    public function getDefaultFriendList(){
        return new FriendList($this->_DB,$this->getDefaultFriendListId());
    }


    private function getPassword() {
        return parent::getPassword();
    }//prevent getting the password from outside
    
    private function getSalt() {
        return parent::getSalt();
    }//prevent getting the salt from outside

    public function setPassword($pwd) {
        $this->setSalt(md5(rand()));
        $salt=$this->getSalt();
        $pwd=md5($pwd);
        $salt=md5($salt);
        $pwd.=$pwd;
        $pwd=$salt.$pwd.$salt.md5($salt);
        $pwd=md5($pwd);
        parent::setPassword($pwd);
    }

    public function chkPassword($pwd) {
        $salt=$this->getSalt();
        $pwd=md5($pwd);
        $salt=md5($salt);
        $pwd.=$pwd;
        $pwd=$salt.$pwd.$salt.md5($salt);
        $pwd=md5($pwd);
        return $pwd==$this->getPassword();
    }

    public function chkLogin($loginName,$password) {
        $a=new Account($this->_DB);
        $a=$a->search($loginName,array('loginName'),'=');
        if(count($a)>0) {
            $a=$a[0];
        }
        return $a->chkPassword($password);
    }
    /*
    public function isOrg(){
        return $this->getOrgId()==null;
    }
    public function isMem(){
        return $this->getMemId()==null;
    }
    */
    public function getFormattedHKID(){
        return substr($this->getHKID(),0,-1)."(".substr($this->getHKID(), -1).")";
    }
    public function getFriendLists(){
        $a=new FriendList($this->_DB);
        $a=$a->search($this->getUserId(),array('userId'),'=','and',false,-1);
        return $a;
    }
    public function getTeamMembers(){
        $a=new TeamMember($this->_DB);
        $a=$a->searchf(array('field_list'=>array('type'=>TeamMember::TYPE_JOINED,'userId'=>$this->getUserId())));
        return $a;
    }
    public function getLeaderTeams(){
        $a=new Team($this->_DB);
        $a=$a->searchf(array('field_list'=>array('leaderId'=>$this->getUserId())));
        return $a;
    }
    public function getInvolveActivities(){
        $a=new InvolveAccount($this->_DB);
        $a=$a->searchf(array('field_list'=>array('status'=>InvolveAccount::STATUS_ACCEPTED,'userId'=>$this->getUserId())));
        return $a;
    }
    public function getCreatedActivities(){
        $a=new activity($this->_DB);
        $a=$a->searchf(array('field_list'=>array('ownerId'=>$this->getUserId())));
        return $a;
    }

    public function __toString(){
        return $this->getLoginName();
    }


    public function getPhotoPath($size=32) {
        debug2file(ROOT."/images/userfile/users/{$this->getUserId()}/logo{$size}.jpg");
        return file_exists(ROOT."/images/userfile/users/{$this->getUserId()}/photo{$size}.jpg") ? "/images/userfile/users/{$this->getUserId()}/photo{$size}.jpg" : "/images/s.gif";
    }

    public function showPhoto($size=32, $return=true) {
        $html = <<<EOD
   <img src="{$this->getPhotoPath($size)}" width=$size height=$size/>
EOD;
        if (!$return) {
            echo $html;
        } else {
            return $html;
        }
    }
}