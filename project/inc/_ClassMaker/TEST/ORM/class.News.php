<?php
    
require_once realpath(dirname(__FILE__))."/../config.inc.php";
require_once ROOT."/inc/class.DataBoundObject.php";
   
class News extends DataBoundObject {
    
    protected $newsId;
    protected $title;
    protected $body;
    protected $time;

   
    protected function DefineTableName() {
        return 'news';
    }

    protected function DefineRelationMap() {
        return array(
            'newsId'=>'newsId',
            'title'=>'title',
            'body'=>'body',
            'time'=>'time'   
        );
    }

    protected function DefinePrimaryKey() {
        return 'newsId';
    }



}