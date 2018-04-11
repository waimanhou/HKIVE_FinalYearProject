<?

require_once './inc/common.inc.php';


$db=new DB();
$news=new News($db);
$list = $news->vsearch(
                array(
                    'limit' => 10,
                    'orderby' => 'newsId'
                )
);
$v=new View();
$v->assign("list",$list);
$v->display("index.htm");


/*
 *
 * TODO: News Mgt, Venue Mgt, Gift Mgt (w/ upload), Cancel activity
 *
 */