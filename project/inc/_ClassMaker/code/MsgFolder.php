<?
    public function getSubFolder(){
        return $this->vsearch(
            array(
                "keyword"=>$this->getFolderId(),
                "fieldname_array"=>array("parentFolderId"),
                "limit"=>-1,
                "operator"=>"="
             )
         );
    }
    
    public function getMsg(){
        $msg=new MsgMap($this->_DB);
        $msg=$msg->vsearch(
            array(
                "keyword"=>$this->getFolderId(),
                "fieldname_array"=>array("folderId"),
                "limit"=>-1,
                "operator"=>"=",
                "orderby"=>"msgId",
                "order"=>"DESC"
            )
        );
        foreach($msg as $k => $v){
            $msg[$k]=$v->getMsg();
        }
        return $msg;
    }
    
    
    
    