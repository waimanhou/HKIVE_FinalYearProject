<?

/* require_once "./inc/class.DB.php";
  require_once "./inc/ORM/class.FriendList.php";
  require_once "./inc/ORM/class.Friend.php";
  require_once "./inc/ORM/class.Account.php";
 */

/*

  public function search($keyword, $fieldname_array=false, $operator = "", $join_operator = "OR", $where = false, $limit="10") {

 */
/*
  require_once "inc/common.inc.php";
  $a=new Account(new DB());
  $a->setLoginName("admin2");
  $a->setChiName("admin2");
  $a->setEngName("System Admin2");
  $a->setPassword("admin");
  $a->setEmail("admin@admin.com");
  $a->setTel1("22222222");
  $a->save();
 */
/**/


include "./inc/common.inc.php";/*
  $v=new View();
  $v->display("test.htm");*/


$db = new DB();
$act=new Activity($db,16);
$ac=$act->getAllInvolveAccountAccount();
foreach ($ac as $v){
    echo $v->getUserId().":".$v;
    echo "<br>";
}
/*$venue=new Venue($db);
$venue=$venue->searchf(array());
$v=new View();
$v->assign("venue",$venue);
$v->display("map.htm");
/*$admin=new Administrator($db);
$admin->setUserId(7);
$admin->setPassword("abcd1234");
$admin->Save();
/*$o=new organization($db,10);
$list=$o->getTeams();
foreach($list as $a){
    echo $a;
    echo "<br>";

}

$t=new Team($db,1);
echo $t;
$t->updateNoOfPlayer();
print_r( $db->getHistory());
/*
      srand((double)microtime()*1000000);
      $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $char_list .= "abcdefghijklmnopqrstuvwxyz";
      $char_list .= "1234567890                    ";
for ($i = 0; $i <= 20; $i++) {
    $o = new Comment($db);
    $o->setActId(rand()%6+1);
    $o->setFromId(rand()%20);
    $o->setToId(7);
    $o->setValue(rand()%3-1);
    $random= "";
      // Add the special characters to $char_list if needed

      for($n = 0; $n < rand()%255+20; $n++)
      {
        $random .= substr($char_list,(rand()%(strlen($char_list))), 1);
      }
    $o->setComment($random);
    $o->Save();
}
/* $team=new Team($db,10);
  $result=$team->getMemberAccounts();
  foreach($result as $k => $v){
  echo $v;
  echo "<br>";
  }

  /*
  for($i=0;$i<=30;$i++){
  /*$a=new Account($db) ;
  $a->setLoginName("user$i");
  $a->setChiName("告告告$i");
  $a->setEngName("TaiMan$i");
  $a->setNickName("Dummy $i");
  $a->setPassword("user$i");
  $a->setEmail("dummyuser$i@fddsa.com");
  $a->setTel1("11223344");
  $a->setTel2("55667788");
  $a->setHKID("Y0000000");
  $a->Save(); */
/*
  $t=new Organization($db);
  $t->setChiName("團體$i");
  $t->setEngName("Org$i");
  $t->setCreatorId(rand(1,100));
  $t->Save(); */
/*    $tm=new TeamMember($db);
  $tm->setTeamId(10);
  $tm->setUserId(rand(10*$i,10*($i+1)));
  $tm->Save();
  }
  /*$v=new View();
  $v->display("test.htm");

  /*
 * searchw('');
 *
 * searchf(
 *  array(
 *    'field_list'=>array(
 *       'col1'=>123,                         //    'col1'=>'=123'
 *       'col2'=>array('>',123,'and'),        //    'col2'=>'>123'
 *       'col3'=>array('like','%asdf%')       //    'col3'=>" like '%asd%'"
 *       'col4'=>array('like',array("%abc%",'%def%','%ghi%')) // where ... and (col4 like ... or col4 like ... or col4 like ....)
 *     ),
 *    'order'=>array(
 *       'name'=>'asc',
 *       'id'=>'desc'
 *     ),
 *    'page'=>array(10,2), //(page#,recPerPage   first page is page 1) or 'range'=array(60,30) show id=60 to 90
 *    'show_deleted'=>false // default false
 *  )
 * )
 *
 */
/*
  $v=new Venue(new DB());
  $list=$v->searchf(array(

  'field_list'=>array(
  'distCode'=>'south'
  )

  ));
  foreach ($list as $key => $value) {
  echo $value."<br>";
  }

  $d=new District(new DB());
  $l=$d->getList();
  foreach ($l as $value) {
  echo $value->getName();
  }
  /*echo $d;
  /*
  echo $d->getDistCode();
  echo "<br>";
  echo $d->getChiName();
  echo "<br>";
  echo $d->getEngName();
  echo "<br>";
  echo $d->getName();
  /*$d->updateCache();
 */
/*

  $lang=array(
  "Hello World"=>"你好，世界",
  "login"=>"登入",
  "logout"=>"登出",
  "loginName"=>"登入名稱",
  "forget password"=>"忘記密碼",
  "password"=>"密碼",
  "register"=>"註冊",
  "you are logged in as :"=>"你已登入為",
  "you are not logged in."=>"你尚未登入",
  "Email address"=>"電郵地址",
  "Submit"=>"提交",
  "Recaptcha"=>"字詞驗證",
  "back_page"=>"返回",
  "back_home"=>"回主頁",
  "Error occured"=>"發生錯誤",
  "invalid email address"=>"無效的電郵地址",
  "invalid reCAPTCHA"=>"字詞驗證錯誤",
  "confirm email have been sent"=>"已發送認証電郵",
  "register_desc"=>"請輸入你的電郵地址以接收註冊連結",
  "required_field_desc"=>"必填項",
  "I accept to the Terms of Service"=>"我已閱讀並同意 服務條款 和 私隱政策",
  "Venues"=>"場地",
  "Venue name"=>"場地名稱",
  "Venue Abbr"=>"場地簡稱",
  "Type"=>"類型",
  "Tel"=>"電話",
  "Address"=>"地址",
  "change language"=>"English",
  "MsgId"=>"訊息編號",
  "Subject"=>"主旨",
  "Sender"=>"發件人",
  "Time"=>"時間",
  "Message"=>"訊息",
  "Folder"=>"資料夾",
  "Account"=>"賬號"

  );

  $lang2=array();
  foreach($lang as $k => $v){
  $lang2[strtolower($k)]=$v;
  }
  var_export($lang2);

  /*

  require_once "inc/common.inc.php";
  $db=new db();
  //$db->query(12);


  $mf=new MsgFolder($db,8);
  echo "<pre>";
  //pmf($mf);
  printFolder($mf,0);
  function printFolder($mf,$tab){
  echo str_repeat("\t",$tab);
  pmf($mf);
  echo "\n";
  $sub=$mf->getSubFolder();
  $tab++;
  foreach($sub as $k => $v){
  printFolder($v,$tab);
  }
  /*$msgs=$mf->getMsg();
  foreach($msgs as $k => $v){
  echo str_repeat("\t",$tab);
  echo "[MSG ".($v->getMsgId())."] ".($v->getSubject());
  echo "\n";
  } *//*
  }

  function pmf($mf){
  echo "[DIR ".$mf->getFolderId()."] ".$mf->getName();
  }
  //$list=$mf->vsearch(array("limit"=>-1));
  /*foreach($list as $k => $v){
  if($v->getFolderId()>10){
  $v->setUserId($v->getParentFolder()->getUserId());
  $v->save();
  }
  } */


/* $venue=new Venue($db);
  $venue=$venue->vsearch(array("limit"=>-1));
  //var_dump($venue);
  $v=new View();
  $v->assign("list",$venue);
  $v->display("test.htm");
  /*
  $a=new Account(new DB());
  $a=$a->search("admin2",array("loginName"));
  $a=$a[0];
  /*$a->delete();
  $a->Save(); */
//var_dump($a);
//$a->delete();
/*
  $db=new DB();
  for($i=0;$i<20;$i++){
  $a=new Account($db);
  $a->setLoginName("user$i");
  $a->setChiName("ChiUser$i");
  $a->setEngName("EngUser$i");
  $a->setPassword("user$i");
  $a->setEmail("user$i@example.net");
  $a->setTel1(mt_rand(20000000,29999999));

  $b=new Member($db);
  $b->setHKID("Y".mt_rand(1000000,9999999));
  $b->setNickName("user $i");
  $b->save();

  $a->setMemId($b->getMemId());
  $a->save();
  }
 *//*

  $db=new DB();
  for($i=0;$i<20;$i++){
  $a=new Account($db);
  $a->setLoginName("org$i");
  $a->setChiName("員Org$i");
  $a->setEngName("EngOrg$i");
  $a->setPassword("org$i");
  $a->setEmail("org$i@example.org");
  $a->setTel1(mt_rand(20000000,29999999));


  $b=new Organization($db);
  $b->setContactPerson("CP$i");
  $b->save();
  $a->setOrgId($b->getOrgId());
  $a->save();
  } */
/*
  $db=new DB();
  $a=new Account($db,2);
  $a=$a->getFriendLists();
  for($i=0;$i<count($a);$i++){
  echo $a[$i]->getName(),"\n";
  $b=$a[$i]->getFriendAccounts();
  for($j=0;$j<count($b);$j++){
  echo "\t",$b[$j]->getChiName(),"\n";
  }
  }
 */
//require_once './inc/common.inc.php';
//require_once './inc/class.View.php';

/*
  $v=new View();
  $v->assign("msg", "Hello World");
  $v->display("test.htm");

 */
/*
  $msg="";
  $db=new DB();
  $a=new Account($db,2);
  $a=$a->getFriendLists();
  for($i=0;$i<count($a);$i++){
  $msg.=$a[$i]->getName()."\n";
  $b=$a[$i]->getFriendAccounts();
  for($j=0;$j<count($b);$j++){
  $msg.= "\t".$b[$j]->getChiName()."\n";
  }
  }
  echo $msg; */
/*
  $v=new View();
  $v->assign("msg","asdf");
  $v->clear_cache("test.htm");
  $v->debugging=1;
  $v->display("test.htm");
 */
/*
  function test($var)
  {
  $var->display();
  }

  $abc = 123;
  test($abc); */


/*



  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>XmlTreeLoader Example</title>
  <link rel="stylesheet" type="text/css" href="js/ext-3.3.1/resources/css/ext-all.css" />
  <script type="text/javascript" src="js/ext-3.3.1/adapter/ext/ext-base.js"></script>

  <!--link rel="stylesheet" type="text/css" href="js/ext-3.3.1/examples/tree/xml-tree-loader.css" /-->
  <script type="text/javascript" src="js/ext-3.3.1/ext-all.js"></script>
  <!--script type="text/javascript" src="js/ext-3.3.1/examples/ux/XmlTreeLoader.js"></script>
  <script type="text/javascript" src="js/ext-3.3.1/examples/tree/xml-tree-loader.js"></script-

  <link rel="stylesheet" type="text/css" href="js/ext-3.3.1/examples/shared/examples.css" />
  <script type="text/javascript" src="js/ext-3.3.1/examples/shared/examples.js"></script-->

  <script>
  var treePanel = new Ext.tree.TreePanel({
  id: 'tree-panel',
  title: 'Folder',
  region:'west',
  split: true,
  height: 300,
  minSize: 150,
  width: 200,
  autoScroll: true,

  collapsible: true,
  // tree-specific configs:
  rootVisible: false,
  lines: false,
  useArrows: true,


  root: new Ext.tree.AsyncTreeNode({
  expanded:true,
  children:
  [{text:'Basic Ext Layouts',expanded: true,children:[{text:'Absolute',id:'absolute',leaf:true},{text:'Accordion',id:'accordion',leaf:true},{text:'Anchor',id:'anchor',leaf:true},{text:'Border',id:'border',leaf:true},{text:'Card (TabPanel)',id:'card-tabs',leaf:true},{text:'Card (Wizard)',id:'card-wizard',leaf:true},{text:'Column',id:'column',leaf:true},{text:'Fit',id:'fit',leaf:true},{text:'Form',id:'form',leaf:true},{text:'Table',id:'table',leaf:true},{text:'vBox',id:'vbox',leaf:true},{text:'hBox',id:'hbox',leaf:true}]},{text:'Custom Layouts',children:[{text:'Row',id:'row',leaf:true},{text:'Center',id:'center',leaf:true}]},{text:'Combination Examples',children:[{text:'Absolute Layout Form',id:'abs-form',leaf:true},{text:'Tabs with Nested Layouts',id:'tabs-nested-layouts',leaf:true}]}]
  })


  });
  Ext.onReady(
  function(){
  new Ext.Panel(
  {
  //title: "Message",
  renderTo: "tree",
  layout: "border",
  width: "90%",
  height: 500,
  items: [
  treePanel,
  {
  region: 'center',
  title: 'Message Details',
  id: 'details-panel',
  autoScroll: true,
  }
  ]
  }
  )
  }
  )
  </script>
  </head>
  <body>
  <h1>FindSport</h1>
  <h3>[<a href='./'>BACK HOME</a>]</h3>

  你尚未登入 [<a href="login.php">登入</a>]
  <a href="changeLang.php">change language</a>
  <hr>
  <a href="venueList.php">Venues</a>
  <hr>



  <div id="tree"></div>

  </body>
  </html> */