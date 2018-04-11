<?php

class MgtView extends View {

    function __construct() {
        parent::__construct();
        $this->template_dir = realpath(dirname(__FILE__)) . "/view";
    }

}

class Mgt {
    const TYPE_LIST=1;
    const TYPE_DETAIL=2;
    const TYPE_NEW=4;

    private $class;
    private $classname;
    private $displayProps = array();
    private $disableProps = array();
    private $propsName = array();
    private $pk;
    private $fk = array();
    private $colModel;
    private $listViewTemplate = "list.htm";
    private $LOVViewTemplate = "lov.htm";
    private $detailViewTemplate = "../administration/view/detail.php";
    private $newViewTemplate = "../administration/view/new.php";

    //private $dataViewTemplate = "xml.xml";

    function setListViewTemplate($s){
        $this->listViewTemplate=$s;
    }
    function setDetailViewTemplate($s){
        $this->detailViewTemplate=$s;
    }
    function setNewViewTemplate($s){
        $this->newViewTemplate=$s;
    }
    //function set

    function __construct($classname) {
        $this->classname = $classname;
        $this->class = new ReflectionClass($classname);
        $pk=$this->class->newInstance(new DB());
        $pk=$pk->get_PKFields();
        $this->pk=$pk[0];
        $this->displayProps = array();
        $this->disableProps = array();
        $p = $this->class->getProperties();
        foreach ($p as $v) {
            if($v->name=="password"){
                continue;
            }
            if($v->name=="salt"){
                continue;
            }
            if(substr($v->name, 0, 1) == "_") {
                continue;
            }
            $this->displayProps[$v->name] = 255;
            $this->disableProps[$v->name] = 0;
            $this->colModel[$v->name] = array(
                "name"=>$v->name,
                "index"=>$v->name,
		"editable"=>true
            );
        }
        $this->disableProps["DELETED"]=1;
        $this->disableProps["DELETEDBY"]=1;
        $this->disableProps["UPDATED"]=1;
        $this->disableProps["UPDATEDBY"]=1;
        $this->disableProps["CREATED"]=1;
        $this->disableProps["CREATEDBY"]=1;
    }

    function addFK($k, $v) {
        $this->fk[$k] = $v;
    }

    function getColModel($k) {
        return json_encode($this->colModel[$k]);
    }

    function setColModel($k, $v) {
        $this->colModel[$k] = json_decode($v);
    }

    function setColModelAry($k, $b) {
        $this->colModel[$k] = $v;
    }

    function getColModelAry($k) {
        return $this->colModel[$k];
    }

    function setColModelProp($k, $prop, $v) {
        $this->colModel[$k][$prop] = $v;
    }

    function getColModelProp($k, $prop) {
        return $this->colModel[$k][$prop];
    }

    function setPropName($k, $v) {
        $this->propsName[$k] = $v;
        $this->colModel[$k]->name = $v;
    }

    function getPropName($k) {
        if (array_key_exists($k, $this->propsName)) {
            return $this->propsName[$k];
        }
        return $k;
    }

    function getDisplayProps() {
        return $this->displayProps;
    }

    function setDisplayProps($s) {
        $this->displayProps = $s;
    }

    function hideProp($propname, $type) {
        $this->displayProps[$propname]|=$type;
        $this->displayProps[$propname]-=$type;
    }

    function showProp($propname, $type) {
        $this->displayProps[$propname]|=$type;
    }
    function disableProp($propname) {
        $this->disableProps[$propname]=1;
    }

    function enableProp($propname) {
        $this->disableProps[$propname]=0;
    }
    function getDisableProp($propname) {
        return $this->disableProps[$propname];
    }

    function getClassName() {
        return $this->class->getName();
    }

    function assignBeforeRun($v) {
        //dummy function, to be extended
    }

    function run() {
        $v = new MgtView();
        $db = new DB();
        //$v->debugging = 1;
        $this->assignBeforeRun($v);
        $v->assign("data", $this);
        if ($_GET['action'] == 'getData') {
            $this->showListData();
        } else if ($_GET['action'] == 'edit' && !empty($_GET["pk"])) {
            try {
                $inst = $this->class->newInstance($db, $_GET["pk"]);
            } catch (RecordNotFoundException $rnfx) {
                echo "Record not found";
                die();
            }
            if (substr($this->detailViewTemplate, -3) == "php") {
                $mgtobj = $this;
                include $this->detailViewTemplate;
                die();
            } else {
                $v->assign("obj", $inst);
                $v->display($this->detailViewTemplate);
            }
        } else if ($_GET['action'] == 'new') {
            try {
                $inst = $this->class->newInstance($db, $_GET["pk"]);
            } catch (RecordNotFoundException $rnfx) {
                echo "Record not found";
                die();
            }
            if (substr($this->newViewTemplate, -3) == "php") {
                $mgtobj = $this;
                include $this->newViewTemplate;
                die();
            } else {
                $v->assign("obj", $inst);
                $v->assign("pkName", $this->pk);
                $v->display($this->newViewTemplate);
            }
        } else if ($_GET['action'] == 'save') {
            $inst=$this->class->newInstance($db,$_POST['pk']);
			foreach ($_POST as $k => $v) {
				if($inst->isColExists($k))
				{
					$method="set".$k;
					//debug2file("$method($v)");
					if($v=="")$v=null;
					$inst->$method($v);
				}
			}
			if($_POST["_delete"]){
				$inst->delete();
			}else{
				$inst->setDELETED(null);
				$inst->setDELETEDBY(null);
			}
			$inst->save();
			//$inst->set
			echo '<script>alert("saved")</script>';
            //$v->display($this->listViewTemplate);
			redirect("?",1);
            //$inst=$this->class->newInstance($db,$_POST['pk']);
            //echo $inst;
        } else if ($_GET['action'] == 'savenew') {
            $inst=$this->class->newInstance($db);
            foreach ($_POST as $k => $v) {
                    if($inst->isColExists($k))
                    {
                            $method="set".$k;
                            //debug2file("$method($v)");
                            if($v=="")$v=null;
                            $inst->$method($v);
                    }
            }
            if($_POST["_delete"]){
                    $inst->delete();
            }else{
                    $inst->setDELETED(null);
                    $inst->setDELETEDBY(null);
            }
            $inst->save();
            //$inst->set
            echo '<script>alert("saved")</script>';
            //$v->display($this->listViewTemplate);
            redirect("?",1);
            //$inst=$this->class->newInstance($db,$_POST['pk']);
            //echo $inst;
        }else if ($_GET['action'] == 'lov'){
            $v->assign("pk", $this->pk);
            $v->assign("k", $_GET['col']);
            $v->display($this->LOVViewTemplate);
        }else{
            $v->assign("pk", $this->pk);
            $v->display($this->listViewTemplate);
        }
    }

    function showListData() {
        $page = intval($_GET['page']); // get the requested page
        $limit = intval($_GET['rows']); // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        // if (!$sidx)
        //    $sidx = 1;
        if ($page == 0)
            $page = 1;
        if ($limit == 0)
            $limit = 30;
        $page = $page == 0 ? 1 : $page;
        $db = new DB();
        $classname = $this->classname;
        $source = new $classname($db);
        $sf = array();
        $sf['field_list'] = array();
        $sf['page'] = array($page, $limit);
        if ($sidx) {
            $sf['order'] = array(
                $sidx => $sord
            );
        }
        $sf['show_deleted'] = ($_GET['incDel'] == 1);
        $list = $source->searchf($sf);
        $response = array();
        $response['page'] = $page;
        $response['total'] = ceil($source->getLastCount() / $limit);
        $response['records'] = $source->getLastCount();
        $response['rows'] = array();
        $i = 0;
        foreach ($list as $r) {
            $response['rows'][$i]['id'] = $i;
            $response['rows'][$i]['cell'] = array();
            foreach ($this->displayProps as $k => $c) {
                if (($c & self::TYPE_LIST) == 0) {
                    continue;
                }
                if (array_key_exists($k, $this->fk)) {
                    $m = "get$k";

                    if ($this->fk[$k] instanceof ReflectionClass) {
                        try {
                            if ($r->$m() != "") {
                                $inst = $this->fk[$k]->newInstance($db, $r->$m());
                                $response['rows'][$i]['cell'][] = $r->$m() . ":" . $inst->__toString();
                            } else {

                                $response['rows'][$i]['cell'][] = "";
                            }
                        } catch (RecordNotFoundException $rnfx) {
                            $response['rows'][$i]['cell'][] = $r->$m() . ":(no record)";
                        }
                    }
                } else {
                    $m = "get$k";
                    $response['rows'][$i]['cell'][] = $r->$m();
                }
            }
            $response['rows'][$i]['cell'][] = $r->__toString();
            $i++;
        }
        echo json_encode($response);
    }
}
