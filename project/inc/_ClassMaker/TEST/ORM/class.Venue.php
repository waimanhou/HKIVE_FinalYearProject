<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Venue extends DataBoundObject {
    
    protected $venueId;
    protected $fullName;
    protected $abbrName;
    protected $typeId;
    protected $price;
    protected $address;
    protected $tel;
    protected $map;
    protected $distCode;
    protected $region;

   
    protected function DefineTableName() {
        return 'venue';
    }

    protected function DefineRelationMap() {
        return array(
            'venueId'=>'venueId',
            'fullName'=>'fullName',
            'abbrName'=>'abbrName',
            'typeId'=>'typeId',
            'price'=>'price',
            'address'=>'address',
            'tel'=>'tel',
            'map'=>'map',
            'distCode'=>'distCode',
            'region'=>'region'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'venueId';
    }

    public function getDist(){
        return new District($this->_DB,$this->getDistCode());
    }

    public function getType(){
        return new ActivityType($this->_DB,$this->getTypeId());
    }


    public function getTypeStr() {
        if ($_SESSION['lang'] == 'zh') {
            return $this->getType()->getChiName();
        } else {
            return $this->getType()->getEngName();
        }
    }
    


}