<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class EmailActivation extends DataBoundObject {
    
    protected $eaId;
    protected $email;
    protected $code;

   
    protected function DefineTableName() {
        return 'emailActivation';
    }

    protected function DefineRelationMap() {
        return array(
            'eaId'=>'eaId',
            'email'=>'email',
            'code'=>'code'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'eaId';
    }



}