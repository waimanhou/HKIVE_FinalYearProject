<?php


    public function  __construct(DB $DB, $id = NULL) {
        parent::__construct($DB, $id);
        include ROOT."/cache/district.php";
        $this->district=$district;
        $this->distCode=$id;
    }
    public function getList(){
        $list=array();
        foreach ($this->district as $key => $value) {
            $list[]=new District($this->_DB,$key);
        }
        return $list;
    }
    public function updateCache(){
        $result=$this->_DB->fetch_all("select * from district;");
        $fp=fopen(ROOT."/cache/district2.php","w");
        fwrite($fp,"<?\n\$district=array( \n\t");
        $first=true;
        //print_r($result);
        foreach ($result as $k=>$v){
           // print_r($v);
            if($first){
                $first=false;
            }else{
                fwrite($fp,",\n\t");
            }
            //fwrite($fp,'"'. $v["distCode"] . '"=>array("en"=>"' .$v['engName']. '","zh"=>"' . $v['chiName'].'")' );
            fwrite($fp," '{$v["distCode"]}'=>array('en'=>'{$v['engName']}','zh'=>'{$v['chiName']}')");

        }
        fwrite($fp,"\n);\n?>");
        fclose($fp);
        copy(ROOT."/cache/district2.php",ROOT."/cache/district.php");
        unlink(ROOT."/cache/district2.php");
        include_once ROOT."/cache/district.php";
        $this->district=$district;
    }

    public function getDistCode(){
        return $this->distCode;
    }
    public function getChiName(){
        return $this->district[$this->getDistCode()]['zh'];
    }
    public function getEngName(){
        return $this->district[$this->getDistCode()]['en'];
    }
    public function getName(){
        return $_SESSION['lang']=='zh'?$this->getChiName():$this->getEngName();
    }
?>
