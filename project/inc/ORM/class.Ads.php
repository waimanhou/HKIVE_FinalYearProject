<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class Ads extends DataBoundObject {
    
    protected $advId;
    protected $available;
    protected $type;
    protected $displayOrder;
    protected $title;
    protected $parameters;
    protected $code;
    protected $startTime;
    protected $endTime;

   
    protected function DefineTableName() {
        return 'ads';
    }

    protected function DefineRelationMap() {
        return array(
            'advid'=>'advId',
            'available'=>'available',
            'type'=>'type',
            'displayorder'=>'displayOrder',
            'title'=>'title',
            'parameters'=>'parameters',
            'code'=>'code',
            'starttime'=>'startTime',
            'endtime'=>'endTime'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'advid';
    }

    public function getAD($type="top")
    {
        $ad=$this->searchf(array(
            "field_list"=>array("type"=>$type,
                                "startTime"=>array("<",date('Y-m-d H:i:s')),
                                "endTime"=>array(">",date('Y-m-d H:i:s'))
            )));
        if(count($ad)==0){return "";}

/////////////////////////temp code///////////////////////

	return $ad[rand()%count($ad)]->getCode();

/////////////////////////temp code///////////////////////
/*
        $adsp=array();

        $sum=0;
        $adsp[-1]=0;
        //var_dump($ad);
        for($n=0;$n<count($ad);$n++)
        {
            $adsp[$n]=$adsp[$n-1]+$ad[$n]->getDisplayOrder();
            $sum+=$ad[$n]->getDisplayOrder();
        }
        $choose=(rand()*32767+rand())%$sum;
        for($n=0;$n<count($ad);$n++)
        {
            if($adsp[$n-1]<=$choose&&$choose<$adsp[$n])
            {
                return $ad[$n]->getCode();
            }
        }
	debug2file("test");*/
    }
}
