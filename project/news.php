<?
require_once './inc/common.inc.php';

if(!isset($_GET['page'])){$_GET['page']=1;}
$page=intval($_GET['page']);
if($page<1)$page=1;
$db=new DB();
$news=new News($db);
$list = $news->searchf(
    array(
        'page'=>array($page,10)
    )
);
$max=ceil($news->getLastCount()/10.0);
$v=new View();
$v->assign("list",$list);
$v->assign("max_page",$max);
$v->assign("current_page",$page);
$v->display("news.htm");
