<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Gift extends DataBoundObject {
    
    protected $gid;
    protected $chiName;
    protected $desc;
    protected $point;
    protected $qty;
    protected $remain;
    protected $engName;

   
    protected function DefineTableName() {
        return 'gift';
    }

    protected function DefineRelationMap() {
        return array(
            'gid'=>'gid',
            'chiName'=>'chiName',
            'desc'=>'desc',
            'point'=>'point',
            'qty'=>'qty',
            'remain'=>'remain',
            'engName'=>'engName'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'gid';
    }

    public function getName(){
      return $_SESSION['lang'] =='zh' ? $this->getChiName():$this->getEngName();
    }

}