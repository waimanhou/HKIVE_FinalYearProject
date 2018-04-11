


    public function __construct(DB $DB, $id = NULL) {
        parent::__construct($DB, $id);
        include ROOT . "/cache/activityType.php";
        $this->activityType = $activityType;
        $this->type = $id;
    }

    public function getList() {
        $list = array();
        foreach ($this->activityType as $key => $value) {
            $list[] = new ActivityType($this->_DB, $key);
        }
        return $list;
    }

    public function updateCache() {
        $result = $this->_DB->fetch_all("select * from activitytype;");
        $fp = fopen(ROOT . "/cache/activityType2.php", "w");
        fwrite($fp, "<?\n\$activityType=array( \n\t");
        $first = true;
        //print_r($result);
        foreach ($result as $k => $v) {
            //  print_r($v);
            if ($first) {
                $first = false;
            } else {
                fwrite($fp, ",\n\t");
            }
            //fwrite($fp,'"'. $v["distCode"] . '"=>array("en"=>"' .$v['engName']. '","zh"=>"' . $v['chiName'].'")' );
            fwrite($fp, " {$v["type"]}=>array('en'=>'{$v['engName']}','zh'=>'{$v['chiName']}')");
        }
        fwrite($fp, "\n);\n?>");
        fclose($fp);
        copy(ROOT . "/cache/activityType2.php", ROOT . "/cache/activityType.php");
        unlink(ROOT . "/cache/activityType2.php");
        include_once ROOT . "/cache/activityType.php";
        $this->activityType = $activityType;
    }

    public function getType(){
        return $this->type;
    }
    public function getChiName(){
        return $this->activityType[$this->getType()]['zh'];
    }
    public function getEngName(){
        return $this->activityType[$this->getType()]['en'];
    }
    public function getName(){
      return $_SESSION['lang']=='zh'?$this->getChiName():$this->getEngName();
    }

