<?php include_once realpath(dirname(__FILE__))."/class.DataBoundObject.php";class Account extends DataBoundObject {

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

}?>