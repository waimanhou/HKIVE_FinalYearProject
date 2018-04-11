<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Message extends DataBoundObject {
    
    protected $msgId;
    protected $senderId;
    protected $subject;
    protected $body;

   
    protected function DefineTableName() {
        return 'message';
    }

    protected function DefineRelationMap() {
        return array(
            'msgId'=>'msgId',
            'senderId'=>'senderId',
            'subject'=>'subject',
            'body'=>'body'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'msgId';
    }

    public function getSender(){
        return new Account($this->_DB,$this->getSenderId());
    }


    public function isReceiver($account) {
        $userid = $account instanceof Account ? $account->getUserId() : $account;
        $userid=intval($userid);
        $result = $this->_DB->fetch_first("Select count(*) as c " .
                        "from message m, msgmap mm, msgfolder mf " .
                        "where m.msgId=mm.msgId " .
                        "and mm.folderId=mf.folderId " .
                        "and mf.userId={$userid}");
        return $result['c'] > 0;
    }

    public function getMsgMap($account) {
        $userid = $account instanceof Account ? $account->getUserId() : $account;
        $userid=intval($userid);
        $result = $this->_DB->fetch_first("Select mm.folderid as a,mm.msgid as b " .
                        "from msgmap mm, msgfolder mf " .
                        "where {$this->getMsgId()}=mm.msgId " .
                        "and mm.folderId=mf.folderId " .
                        "and mf.userId={$userid}");
        return new MsgMap(
                $this->_DB,
                array(
                    'folderId' => $result["a"],
                    'msgId' => $result["b"]
                )
        );
    }

    public function send($target) {
        $name = is_string($target) ? explode(",", $target) : $target;
        for ($n = 0; $n < count($name); $n++) {
            $folder = $this->_DB->fetch_first("Select m.folderId from account a,msgfolder m where parentFolderId is null and a.userid=m.userid and upper(a.loginname)=upper('" . addslashes($name[$n]) . "')");
            $this->_DB->query("insert into msgmap (msgid,folderId)values(" . $this->getMsgId() . "," . $folder['folderId'].")");
        }
    }




}