<?

/*
 *
 * TODO: Search Venue, Add Regional data
 *
 */

require_once './inc/common.inc.php';
if (empty($_GET["action"])) {
    $v = new View();
    //$v->debugging=1;
    $db = new DB();
    $a = new ActivityType($db);
    $v->assign("activityType", $a->getList());
    $b = new District($db);
    $v->assign("district", $b->getList());
    $v->display("venueList.htm");
    die();
} else {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
    $db = new DB();


    $page = intval($_GET['page']); // get the requested page
    $limit = intval($_GET['rows']); // get how many rows we want to have into the grid
    $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
    $sord = $_GET['sord']; // get the direction
    
    if ($page == 0)
        $page = 1;
    if ($limit == 0)
        $limit = 30;

    $page = $page == 0 ? 1 : $page;
    //$limit = ($page - 1) * 30 . ",30";
    $venue = new Venue($db);
    /* $list = $venue->vsearch(
      array(
      //'limit' => $limit,
      'each' => $limit,
      'page' => $page,
      'orderby' => $sidx,
      'order' => $sord
      )
      ); */
    $sf=array();
    if($sidx && $venue->isColExists($sidx)){
        $sf['order']=array($sidx=>$sord);
    }
    $sf['field_list']=array();
    if(isset($_GET['type']) && $_GET['type']!='all'){
        $sf['field_list']['typeId']=$_GET['type'];
    }
    if(isset($_GET['district']) && $_GET['district']!='all'){
        $sf['field_list']['distCode']=$_GET['district'];
    }
    $sf['page']=array($page,$limit);
    $list = $venue->searchf($sf);
    $v = new View();
    $v->assign('list', $list);
    $v->assign('totalrecord', $venue->getLastCount());
    $v->assign("totalpage", ceil($venue->getLastCount() / $limit));
    $v->assign('page', $page);
    $v->assign('orderby', $_GET['orderby']);
    $v->display("venueList_json.htm");
//    var_dump($list);
}
?>