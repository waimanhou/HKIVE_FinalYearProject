<?php

require_once realpath(dirname(__FILE__)) . "/../config.inc.php";
require_once ROOT . "/inc/class.DataBoundObject.php";

class Administrator extends DataBoundObject {

    protected $adminId;
    protected $userId;
    protected $password;

    protected function DefineTableName() {
        return 'administrator';
    }

    protected function DefineRelationMap() {
        return array(
            'adminid'=>'adminId',
            'userid'=>'userId',
            'password'=>'password'
        );
    }

    protected function DefinePrimaryKey() {
        return array('actId');
    }

    public function getAccount(){
        return new Account($this->_DB,$this->getUserId());
    }
    

    private function getPassword() {
        return parent::getPassword();
    }//prevent getting the password from outside
    
    public function setPassword($pwd) {
        for($i=0;$i<10;$i++){
            $pwd=md5(($this->getUserId()).$pwd.md5($pwd).($this->getUserId()));
        }
        $pwd=md5($pwd);
        $pwd2=$pwd.str_rot13($pwd);
        for($i=0;$i<16;$i++){
            $pwd{$i}=$pwd2{$i*2};
        }
        for($i=16;$i<32;$i++){
            $pwd{$i}=$pwd2{($i-16)*2+1+16};
        }
        $pwd=str_rot13(strrev($pwd));
        parent::setPassword($pwd);
    }

    public function chkPassword($pwd) {
       for($i=0;$i<10;$i++){
            $pwd=md5(($this->getUserId()).$pwd.md5($pwd).($this->getUserId()));
        }
        $pwd=md5($pwd);
        $pwd2=$pwd.str_rot13($pwd);
        for($i=0;$i<16;$i++){
            $pwd{$i}=$pwd2{$i*2};
        }
        for($i=16;$i<32;$i++){
            $pwd{$i}=$pwd2{($i-16)*2+1+16};
        }
        $pwd=str_rot13(strrev($pwd));
        return $pwd==$this->getPassword();
    }
}