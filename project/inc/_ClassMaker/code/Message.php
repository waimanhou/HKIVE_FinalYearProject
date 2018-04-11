<?class asdf {

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
            $this->_DB->query("insert into MsgMap set msgid=" . $this->getMsgId() . ",folderId=" . $folder['folderId']);
        }
    }


    