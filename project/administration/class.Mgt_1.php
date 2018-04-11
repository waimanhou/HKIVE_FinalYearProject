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
    private $propsName = array();
    private $pk;
    private $fk = array();
    private $colModel;
    private $listViewTemplate = "list.htm";
    private $detailViewTemplate = "detail.htm";
    private $newViewTemplate = "new.htm";
    private $dataViewTemplate = "xml.xml";

    function __construct($classname) {
        $this->classname = $classname;
        $this->class = new ReflectionClass($classname);
        $this->displayProps = array();
        $p = $this->class->getProperties();
        foreach ($p as $v) {
            $this->colModel[$v->name] = array(
                "name" => $v->name,
                "index" => $v->name
            );
        }
    }

    function getColModel($k) {
        return json_encode($this->colModel[$k]);
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

    function getClassName() {
        return $this->class->getName();
    }

    function assignDeforeRun($v) {
        //dummy function, to be extended
    }

    function run() {
        $v = new MgtView();
        //$v->debugging = 1;
        $this->assignDeforeRun($v);
        $v->assign("data", $this);
        if ($_GET['action'] == 'getData') {
            //$v->display($this->dataViewTemplate);
            $this->showListData();
        } else if ($_GET['action'] == 'edit') {
            $v->display($this->detailViewTemplate);
        } else if ($_GET['action'] == 'new') {
            $v->display($this->newViewTemplate);
        } else {
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
            foreach ($this->displayProps as $c) {
                $m = "get$c";
                $response['rows'][$i]['cell'][] = $r->$m();
            }
            $i++;
        }
        echo json_encode($response);
    }

}
