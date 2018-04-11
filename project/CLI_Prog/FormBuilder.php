<?
include "../inc/common.inc.php";

ini_set('register_argc_argv', 0);  

if (!isset($argc) || is_null($argc))
{ 
    echo <<< EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <title>&#21486;&#22137;</title> <style> body{	background:#fff;} #doraemon{	position:relative;	margin:50px;	} #head_light{	width:50px;	height:50px;	transform: rotate(20deg);		-webkit-transform: rotate(20deg);		-moz-transform: rotate(20deg);		-o-transform: rotate(20deg);	box-shadow:80px 20px 50px #fff;		-webkit-box-shadow:80px 20px 55px #fff;		-moz-box-shadow:80px 20px 50px #fff;	border-radius:45px;		-webkit-border-radius:45px;		-moz-border-radius:60px;	position:absolute;	top:-20px;	left:170px;	opacity:0.5} #face{	position:relative;	width:310px;	height:300px;	border-radius:146px;		-webkit-border-radius:146px;		-moz-border-radius:146px;	background:#07beea;		background: -webkit-gradient(linear, right top, left bottom, from(#fff) ,color-stop(0.20, #07beea), color-stop(0.73, #10a6ce),color-stop(0.95, #000), to(#444));		background: -moz-linear-gradient(right top, #fff,#07beea 20%, #10a6ce 73% ,#000 95% ,#000 155%); 	border:#333 2px solid;	top:-15px;	box-shadow:-5px 10px 15px rgba(0,0,0,0.45);		-webkit-box-shadow:-5px 10px 15px rgba(0,0,0,0.45);		-moz-box-shadow:-5px 10px 15px rgba(0,0,0,0.45);	} #base{	position:relative;	top:-5px;} #base_white{	position:absolute;	border:#000 2px solid;	width:264px;	height:196px;	border-radius: 150px 150px;		-webkit-border-radius: 150px 150px;		-moz-border-radius: 150px 150px;	background:#FFF;	background: -webkit-gradient(linear, right top, left bottom, from(#fff),color-stop(0.75,#fff),color-stop(0.83,#eee),color-stop(0.90,#999),color-stop(0.95,#444), to(#000));		background: -moz-linear-gradient(right top, #fff,#fff 75%, #eee 83%,#999 90%,#444 95%, #000); 	z-index:1;	top:85px;	left:22px;	}  #eyes{	position:relative;	top:-5px;} div.eye{	position:absolute;	border-radius: 35px 35px;		-webkit-border-radius: 35px 35px;		-moz-border-radius: 35px 35px;	border:2px solid #000;	width:72px;	height:83px;	z-index:20;	background:#fff;} div.black_eye{	position:absolute;	width:15px;	height:15px;	border-radius:10px;		-webkit-border-radius:10px;		-moz-border-radius:10px;	background:#333;	z-index:21;		-webkit-animation-name: cate;		-webkit-animation-duration: 10s;		-webkit-animation-timing-function: linear;		-webkit-animation-iteration-count: 200;} @-webkit-keyframes cate{	0%{		margin:0 0 0 0;	}	80%	{		margin:0px 0 0 0;	}	85%	{		margin:-20px 0 0 0;	}	90%{		margin:0 0 0 0;	}	93%{		margin:0 0 0 7px;	}	96%{		margin:0 0 0 0;	}	100%{		margin:0 0 0 0;	}} div.black_left{	top:100px;	left:130px;} div.black_right{	top:100px;	left:170px;} div.eye_left{	top:45px;	left:82px;	} div.eye_right{	top:45px;	left:156px;	} #nose{	width:32px;	height:32px;	border:2px solid #000;	border-radius:50px;		-webkit-border-radius:50px;		-moz-border-radius:50px;	background:#c93e00;	position:absolute;	top:117px;	left:139px;	z-index:30;} #nose_light{	width:10px;	height:10px;	border-radius:5px;		-webkit-border-radius:5px;		-moz-border-radius:5px;	box-shadow:19px 8px 5px #fff;		-webkit-box-shadow:19px 8px 5px #fff;		-moz-box-shadow:19px 8px 5px #fff;	position:relative;	top:0px;	left:0px;} #nose_line{	background:#000;	width:4px;	height:100px;	top:125px;	left:156px;	position:absolute;} #nose_line{	background:#333;	width:3px;	height:100px;	top:140px;	left:155px;	position:absolute;		z-index:20;} #mouth{	width:240px;	height:500px;	border-bottom:3px solid #333;	border-radius:120px;		-webkit-border-radius:120px;		-moz-border-radius:120px;	position:absolute;	top:-263px;	left:36px;	z-index:10;} #mouth_rewrite{	background:#fff;	width:240px;	height:90px;	position:relative;	top:115px;	left:35px;	z-index:12;	border-radius:45px;		-webkit-border-radius:45px;		-moz-border-radius:60px;} #firefox_mouth, x:-moz-broken, x:last-of-type, x:indeterminate {	position:relative;	width:170px;	height:150px;	-moz-border-radius:85px;	border:3px solid #000;	background:#FFF;	z-index:11;	top:-3px;	left:70px;} .whiskers{	background:#333;	height:2px;	width:60px;	position:absolute;	z-index:20;}.whi_right{	top:165px;	left:210px;	}	 .whi_right_top{	top:145px;	left:210px;}	 .whi_right_bottom{	top:185px;	left:210px;}	 .whi_left{	top:165px;	left:50px;	}	.whi_left_top{	top:145px;	left:50px;}	 .whi_left_bottom{	top:185px;	left:50px;} .rotate20{	transform: rotate(20deg);		-webkit-transform: rotate(20deg);		-moz-transform: rotate(20deg);		-o-transform: rotate(20deg);	} .rotate160{	transform: rotate(160deg);		-webkit-transform: rotate(160deg);		-moz-transform: rotate(160deg);		-o-transform: rotate(160deg);	} #choker{	position:relative;	top:-55px;	left:35px;	z-index:100;} #belt{	width:230px;	height:20px;	border:#000 solid 2px;	background:#ca4100;	background: -webkit-gradient(linear, left top, left bottom, from(#ca4100), to(#800400));		background: -moz-linear-gradient(top, #ca4100, #800400); 	border-radius:10px;			-webkit-border-radius:10px;			-moz-border-radius:10px;		position:relative;	left:5px;} #bell{	width:40px;	height:40px;	border-radius:50px;		-webkit-border-radius:50px;		-moz-border-radius:50px;	border:2px solid #000;	background:#f9f12a;	background: -webkit-gradient(linear, left top, left bottom, from(#f9f12a),color-stop(0.5, #e9e11a), to(#a9a100));		background: -moz-linear-gradient(top, #f9f12a, #e9e11a 75%,#a9a100); 	box-shadow:-5px 5px 10px rgba(0,0,0,0.25);		-webkit-box-shadow:-5px 3px 5px rgba(0,0,0,0.25);		-moz-box-shadow:-5px 5px 10px rgba(0,0,0,0.25);	position:relative;	top:-15px;	left:100px;} #bell:hover{	-webkit-animation-name: bellani;	-webkit-animation-duration: 2s;	-webkit-animation-timing-function: linear;	-webkit-animation-iteration-count: 1;}@-webkit-keyframes bellani{	0%{		left:100px;		transform: rotate(0deg);			-webkit-transform: rotate(0deg);			-moz-transform: rotate(0deg);			-o-transform: rotate(0deg);		}	20%{		left:105px;		transform: rotate(-20deg);			-webkit-transform: rotate(-20deg);			-moz-transform: rotate(-20deg);			-o-transform: rotate(-20deg);		}	40%{		left:100px;		transform: rotate(0deg);			-webkit-transform: rotate(0deg);			-moz-transform: rotate(0deg);			-o-transform: rotate(0deg);		}	65%{		left:95px;		transform: rotate(20deg);			-webkit-transform: rotate(20deg);			-moz-transform: rotate(20deg);			-o-transform: rotate(20deg);		}	80%{		left:100px;		transform: rotate(0deg);			-webkit-transform: rotate(0deg);			-moz-transform: rotate(0deg);			-o-transform: rotate(0deg);		}	100%{		left:100px;		transform: rotate(0deg);			-webkit-transform: rotate(0deg);			-moz-transform: rotate(0deg);			-o-transform: rotate(0deg);		}} #bell_line{	width:36px;	height:2px;	background:#f9f12a;	border:#333 solid 2px;	position:relative;	top:10px;} #bell_circle{	width:12px;	height:10px;	border-radius:5px;		-webkit-border-radius:5px;		-moz-border-radius:5px;	background:#000;	position:relative;	top:14px;	left:14px;} #bell_under{	width:3px;	height:15px;	background:#000;	position:relative;	top:10px;	left:18px;} #bell_light{	width:10px;	height:10px;	border-radius:10px;		-webkit-border-radius:10px;		-moz-border-radius:10px;	box-shadow:19px 8px 5px #fff;		-webkit-box-shadow:19px 8px 5px #fff;		-moz-box-shadow:19px 8px 5px #fff;	position:relative;	opacity:0.7;	top:-35px;	left:5px;} #doutai{	position:absolute;	width:220px;	height:165px;	background:#07beea;	background: -webkit-gradient(linear, right top, left top, from(#07beea),color-stop(0.5, #0073b3),color-stop(0.75,#00b0e0), to(#0096be));		background: -moz-linear-gradient(right, #07beea, #0073b3 50%,#0096be 75%,#00b0e0 ,#0096be 100% ,#333 114%); 	border:#333 2px solid;	top:262px;	left:46px;} div.base_white2{	position:absolute;	width:170px;	height:170px;	border-radius:85px;		-webkit-border-radius:85px;		-moz-border-radius:85px;	border:2px solid #000;	background:#FFF;	background: -webkit-gradient(linear, right top, left bottom, from(#fff),color-stop(0.75,#fff),color-stop(0.83,#eee),color-stop(0.90,#999),color-stop(0.95,#444), to(#000));		background: -moz-linear-gradient(right top, #fff,#fff 75%, #eee 83%,#999 90%,#444 95%, #000); } .doutai_center{	top:230px;	left:72px;} #circle{	position:relative;	width:130px;	height:130px;	border-radius:65px;		-webkit-border-radius:65px;		-moz-border-radius:65px;	background:#fff;	background: -webkit-gradient(linear, right top, left bottom, from(#fff),color-stop(0.70,#fff),color-stop(0.75,#f8f8f8),color-stop(0.80,#eee),color-stop(0.88,#ddd), to(#fff));		background: -moz-linear-gradient(right top, #fff, #fff 70%,#f8f8f8 75%,#eee 80%,#ddd 88% , #fff); 	border:2px solid #000;	top:-120px;	left:92px;}#circle_rewrite{	position:relative;	width:134px;	height:60px;	background:#fff;		border-bottom:2px solid #000;	top:-250px;	left:92px;}#hand_right{	position:absolute;	top:272px;	left:248px;	width:100px;	height:100px;} #arm_right{	position:relative;	width:80px;	height:50px;	background:#07beea;	background: -webkit-gradient(linear, left top, left bottom, from(#07beea),color-stop(0.85,#07beea), to(#555));		background: -moz-linear-gradient(top, #07beea, #07beea 85%, #555); 		border:solid 1px #000;	z-index:-1;	top:17px;	transform: rotate(35deg);		-webkit-transform: rotate(35deg);		-moz-transform: rotate(35deg);		-o-transform: rotate(35deg);	box-shadow:-10px 7px 10px rgba(0,0,0,0.35);		-webkit-box-shadow:-10px 7px 10px rgba(0,0,0,0.35);		-moz-box-shadow:-10px 7px 10px rgba(0,0,0,0.35);}#hand_right:hover #arm_right{	top:-10px;	transform: rotate(-35deg);		-webkit-transform: rotate(-35deg);		-moz-transform: rotate(-35deg);		-o-transform: rotate(-35deg);}#hand_right:hover .hand_circle{	margin-top:-80px;	margin-left:10px;	}#hand_left{	position:absolute;	top:272px;	left:-46px;	width:100px;	height:100px;} #arm_left{	position:relative;	width:80px;	height:50px;	background:#0096be;	border:solid 1px #000;	z-index:-1;	top:17px;	left:36px;	transform: rotate(145deg);		-webkit-transform: rotate(145deg);		-moz-transform: rotate(145deg);		-o-transform: rotate(145deg);	box-shadow:5px -7px 10px rgba(0,0,0,0.25);		-webkit-box-shadow:5px -7px 10px rgba(0,0,0,0.25);		-moz-box-shadow:5px -7px 10px rgba(0,0,0,0.25);} div.hand_circle{	position:absolute;	width:60px;	height:60px;	border-radius:30px;		-webkit-border-radius:30px;		-moz-border-radius:30px;	border:2px solid #000;	background:#fff;	background: -webkit-gradient(linear, right top, left bottom, from(#fff),color-stop(0.5,#fff),color-stop(0.70,#eee),color-stop(0.8,#ddd), to(#999));		background: -moz-linear-gradient(right top, #fff, #fff 50%, #eee 70%, #ddd 80%,#999); } .hand_right{	top:32px;	left:40px;	} .arm_rewrite_right{	position:relative;	width:4px;	height:45px;	background:#07beea;	top:-51px;	left:18px;} .hand_left{	top:34px;	left:10px;	} .arm_rewrite_left{	position:relative;	width:4px;	height:50px;	background:#0096be;	top:-52px;	left:92px;}  #foot{	position:relative;	width:280px;	height:40px;	top:-141px;	left:20px;} #foot_left{	width:125px;	height:30px;	background:#fff;	background: -webkit-gradient(linear, right top, left bottom, from(#fff),color-stop(0.75,#fff),color-stop(0.85,#eee), to(#999));		background: -moz-linear-gradient(right top, #fff,#fff 75%, #eee 85%, #999); 	border:solid 2px #333;	border-top-left-radius:80px;	border-bottom-left-radius:40px;	border-top-right-radius:60px;	border-bottom-right-radius:60px;		-webkit-border-top-left-radius:80px;		-webkit-border-bottom-left-radius:40px;		-webkit-border-top-right-radius:60px;		-webkit-border-bottom-right-radius:60px;		-moz-border-radius-topleft:80px;		-moz-border-radius-bottomleft:40px;		-moz-border-radius-topright:60px;		-moz-border-radius-bottomright:60px;	position:relative;	left:8px;	top:2px;	box-shadow:-6px 0px 10px rgba(0,0,0,0.35);		-webkit-box-shadow:-6px 0px 10px rgba(0,0,0,0.35);		-moz-box-shadow:-6px 0px 10px rgba(0,0,0,0.35);	z-index:-1;} #foot_right{	position:relative;	width:125px;	height:30px;	background:#fff;	background: -webkit-gradient(linear, right top, left bottom, from(#fff),color-stop(0.75,#fff),color-stop(0.85,#eee), to(#999));		background: -moz-linear-gradient(right top, #fff,#fff 75%, #eee 85%, #999); 	border:solid 2px #333;	border-top-left-radius:60px;	border-bottom-left-radius:60px;	border-top-right-radius:80px;	border-bottom-right-radius:40px;		-webkit-border-top-left-radius:60px;		-webkit-border-bottom-left-radius:60px;		-webkit-border-top-right-radius:80px;		-webkit-border-bottom-right-radius:40px;		-moz-border-radius-topleft:60px;		-moz-border-radius-bottomleft:60px;		-moz-border-radius-topright:80px;		-moz-border-radius-bottomright:40px;	top:-32px;	left:141px;	box-shadow:-6px 0px 10px rgba(0,0,0,0.35);		-webkit-box-shadow:-6px 0px 10px rgba(0,0,0,0.35);		-moz-box-shadow:-6px 0px 10px rgba(0,0,0,0.35);	z-index:-1;} #foot_rewrite{	position:relative;	width:20px;	height:10px;	background:#fff;	background: -webkit-gradient(linear, right top, left bottom, from(#666),color-stop(0.83,#fff), to(#fff));		background: -moz-linear-gradient(right top, #666, #fff 83%, #fff); 	top:-76px;	left:127px;	border-top:2px solid #000;	border-right:2px solid #000;	border-left:2px solid #000;	border-top-right-radius:40px;	border-top-left-radius:40px;		-webkit-border-top-right-radius:40px;		-webkit-border-top-left-radius:40px;		-moz-border-radius-topleft:40px;		-moz-border-radius-topright:40px;} #shadow_doutai_left{	width:30px;	height:200px;	box-shadow:-10px 10px 15px rgba(0,0,0,0.45);		-webkit-box-shadow:-10px 10px 15px rgba(0,0,0,0.45);		-moz-box-shadow:-10px 10px 15px rgba(0,0,0,0.45);	position:absolute;	top:250px;	left:46px;	z-index:-10;} #shadow_doutai_right{	width:30px;	height:200px;	box-shadow:10px 10px 15px rgba(0,0,0,0.35);		-webkit-box-shadow:10px 10px 25px rgba(0,0,0,0.35);		-moz-box-shadow:10px 10px 15px rgba(0,0,0,0.35);	position:absolute;	top:240px;	left:230px;	z-index:-10;} #shadow_doutai_arm{	width:85px;	height:165px;	box-shadow:-100px 10px 15px rgba(0,0,0,0.0);		-webkit-box-shadow:-100px 10px 15px rgba(0,0,0,0.25);		-moz-box-shadow:-100px 10px 15px rgba(0,0,0,0.25);	position:absolute;	top:230px;	left:113px;	z-index:10;	opacity:0.5;	transform: rotate(-20deg);		-webkit-transform: rotate(-20deg);		-moz-transform: rotate(-20deg);		-o-transform: rotate(-20deg);	border-bottom-left-radius:40px;		-webkit-border-bottom-left-radius:40px;		-moz-border-radius-bottomleft:40px;	border-top-left-radius:20px;		-webkit-border-top-left-radius:20px;		-moz-border-radius-topleft:20px;} #shadow_belt{	width:40px;	height:30px;	box-shadow:-100px 10px 15px rgba(0,0,0,0);		-webkit-box-shadow:-100px 10px 15px rgba(0,0,0,0.25);		-moz-box-shadow:-100px 10px 15px rgba(0,0,0,0.25);	position:absolute;	top:240px;	left:130px;	z-index:10;	border-bottom-left-radius:40px;		-webkit-border-bottom-left-radius:40px;		-moz-border-radius-bottomleft:40px;	z-index:300;} #arm_left:not(\*|*), .arm_rewrite_left:not(\*|*){	background:#07beea;} #arm_left, .arm_rewrite_left{	background:#07beea\9;	*background:#07beea;	_background:#07beea;} #kiji{	position:relative;	top:-150px;}</style> <meta http-equiv="adimage" content="200" /> </head>  <body> <div id="doraemon"> 	<div id="face">     	<div id="head_light"></div>     	<div id="eyes">     	<div class="eye eye_left"></div>         	<div class="black_eye black_left"></div>               	<div class="eye eye_right"></div>         	<div class="black_eye black_right"></div>         </div>         <div id="base"> 			<div id="base_white"></div> 				<div id="nose"> 					<div id="nose_light"></div> 				</div>                 <div id="nose_line"></div>                 <div id="mouth"></div>                 <div id="mouth_rewrite"></div>                 <div id="firefox_mouth"></div>  				<div class="whiskers whi_right_top rotate160"></div> 				<div class="whiskers whi_right"></div> 				<div class="whiskers whi_right_bottom rotate20"></div>                     				<div class="whiskers whi_left_top rotate20"></div> 				<div class="whiskers whi_left"></div> 				<div class="whiskers whi_left_bottom rotate160"></div>         </div> 	</div>     <div id="choker">     	<div id="belt"></div>     	<div id="bell">        	  <div id="bell_line"></div>             <div id="bell_circle"></div>             <div id="bell_under"></div> 		<div id="bell_light"></div> 		</div>     </div> 	<div id="body">     <div id="doutai"></div> 		<div class="base_white2 doutai_center"></div>         		<div id="pocket">                 	<div id="circle"></div>                     <div id="circle_rewrite"></div>                 </div> 	</div> 	<div id="hand_right">     	<div id="arm_right"></div> 		<div class="hand_circle hand_right"></div> 		<div class="arm_rewrite_right"></div>     </div> 	<div id="hand_left">     	<div id="arm_left"></div> 		<div class="hand_circle hand_left"></div> 	  <div class="arm_rewrite_left"></div>     </div> 	<div id="foot">     	<div id="foot_left"></div>         <div id="foot_right"></div>         <div id="foot_rewrite"></div>     </div>     	<div id="shadow_doutai_arm"></div>     	<div id="shadow_doutai_left"></div>     	<div id="shadow_doutai_right"></div>         <div id="shadow_belt"></div>  </div> </body> </html> 
EOD;
    die();
}


$fp = fopen("php://stdin", "r");
MainMenu();

function getInput(){
    GLOBAL $fp;
    return trim(fgets($fp));
}
function cls(){
    for($i=0;$i<=99;$i++)echo "\n";
}
function MainMenu(){
    cls();
    echo <<<EOD

                    +------------------------------+
                    | DataBoundObject Form Builder |
                    +------------------------------+
                    
                        n.  Create New Form
                        o.  Open Saved Form
                        ex. Exit
                        

EOD;
    echo "Please enter your option: ";
    while(1){
            $in=getInput();
            if($in=='ex'){
            //cls();
            echo <<<EOD
            
            
                                          
   ______                __   ____                
  / ____/___  ____  ____/ /  / __ )__  _____      
 / / __/ __ \/ __ \/ __  /  / __  / / / / _ \     
/ /_/ / /_/ / /_/ / /_/ /  / /_/ / /_/ /  __/   _ 
\____/\____/\____/\__,_/  /_____/\__, /\___/   ( )
                                /____/         |/ 

    __  __                                   _                  __               __
   / / / /___ __   _____     ____ _   ____  (_)_______     ____/ /___ ___  __   / /
  / /_/ / __ `/ | / / _ \   / __ `/  / __ \/ / ___/ _ \   / __  / __ `/ / / /  / / 
 / __  / /_/ /| |/ /  __/  / /_/ /  / / / / / /__/  __/  / /_/ / /_/ / /_/ /  /_/  
/_/ /_/\__,_/ |___/\___/   \__,_/  /_/ /_/_/\___/\___/   \__,_/\__,_/\__, /  (_)    
                                                                    /____/   

                                                                    
                                                                    
                                                                    
                                                                    
EOD;
            die();
            }
            if($in=='n'){return NewForm();}
            if($in=='o'){return OpenForm();}
            return MainMenu();
    }
}

function NewForm($classname=""){
    cls();
    echo <<<EOD

                    +------------------------------+
                    | DataBoundObject Form Builder |
                    |       Create a new form      |
                    +------------------------------+
                    
                    

EOD;

    if(empty($classname)){
        echo "Class name: ";
        $db=new DB();
        while(1){
            $classname=getInput();
            if($classname=="")return MainMenu();
            if(!file_exists(ROOT."/inc/ORM/class.{$classname}.php")){
                echo "please try again, or enter nothing to exit\n";
                continue;
            }
            $class=new ReflectionClass($classname);
            return NewForm($classname);
        }
    }
    
    $class=new ReflectionClass($classname);
    $props2=$class->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
    $props=array();
    foreach($props2 as $k=>$v){
        $props[$k]=array($v,"select"=>"","list"=>"R","detail"=>"RW","type"=>"text","FK"=>"",'display'=>$v->getName(),"type"=>"Prop");
    }
    $config=array("controller"=>"tempForm.php", "list"=>"tempList.htm","detail"=>"tempDetail.htm","class"=>$class,"PK"=>0);
   
    $methods=$class->getMethods(ReflectionMethod::IS_PUBLIC);
    foreach($methods as $v){
        if(substr($v->getName(),0,3)=="get"){
            $props[]=array($v,"select"=>"","list"=>"R","detail"=>"RW","type"=>"text","FK"=>"",'display'=>substr($v->getName(),3),"type"=>"Getter");
        }
        if(substr($v->getName(),0,3)=="set"){
            $props[]=array($v,"select"=>"","list"=>"R","detail"=>"RW","type"=>"text","FK"=>"",'display'=>substr($v->getName(),3),"type"=>"Setter");
        }
    }
   
    EditForm($config,$props);
    
}

function OpenForm(){
    echo "not implemented";
    getInput();
    return MainMenu();
}

function EditForm($config,$props){
    $undo=array();
    $redo=array();
    $classname=$config['class']->getName();
    $displayDBO=true;
    $displayNonDBO=true;
    while(1){
        cls();
        $undocount=count($undo);
        $redocount=count($redo);

        echo <<<EOD
        
                    +------------------------------+
                    | DataBoundObject Form Builder |
                    |      Create / Edit form      |
                    |          Form Detail         |
                    +------------------------------+

EOD;

        $pfstr="| %-1.1s%3.3s | %-6.6s | %-20.20s | %-20.20s | %-20.20s | %-6.6s | %-6.6s | %-8.8s | %-20.20s |\n";
        $hr="----------------------------------------------------------------------------------------";

        echo "Config: \n";
        echo "\tForm Detail -  class $classname\n";
        echo "\tController Filename: \t{$config['controller']}\n";
        echo "\tList View Filename: \t{$config['list']}\n";
        echo "\tDetail View Filename: \t{$config['detail']}\n";
        echo "\tDBO: ".($displayDBO ? "DISPLAY" : "HIDDEN")."\tnon-DBO: ".($displayNonDBO ? "DISPLAY" : "HIDDEN");
        echo "\n";
        printf( $pfstr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr);
        printf( $pfstr,"","#","Type","Properties Name","Display Name","Declaring class","List","Detail","Type","FK");
        printf( $pfstr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr);
        foreach($props as $k=>$v){
            if($v[0]->getDeclaringClass()->getName()=="DataBoundObject" && !$displayDBO)continue;
            if($v[0]->getDeclaringClass()->getName()!="DataBoundObject" && !$displayNonDBO)continue;
            
            printf( $pfstr,
                $v["select"],
                $k,
                $v['type'],
                $v[0]->getName().($config["PK"]==$k?" [PK]":""),
                $v['display'],
                $v[0]->getDeclaringClass()->getName(),
                $v['list'],
                $v['detail'],
                $v['type'],
                $v['FK']
            );
        }
        printf( $pfstr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr,$hr);
        echo <<< EOD
      ex = exit     sa = select all   da = deselect all    (num1) (num2) = select/deselect prop(s)   cfg = change config
    sdbo = Select All DBO props     ddbo = Deselect All DBO props     pk = change 1st selected prop be PK
      d1 = Display/Hidden DBOs        d2 = Display/Hidden non-DBOs
      cl = change "List"              cd = change "Detail"            ct = change "Type"              cn = change display name
       z = undo({$undocount})          x = redo({$redocount})          s = save setting              gen = Generate Form

> 
EOD;
//echo "undo: ".count($undo)."\tredo: ".count($redo);

        $in=getInput();
        if($in=="ex") return MainMenu();
        
        if($in!='z' && $in!='x' && $in!='s'){
            array_push($undo,array($props,$config));
            $redo=array();
        }
        if($in=="z"){
            if(count($undo)==0)continue;
            $data=array_pop($undo);
            array_push($redo,array($props,$config));
            $props=$data[0];
            $config=$data[1];
        }else if($in=="x"){
            if(count($redo)==0)continue;
            $data=array_pop($redo);
            array_push($undo,array($props,$config));
            $props=$data[0];
            $config=$data[1];
        }else if($in=='sa'){
            foreach($props as $k=>$v){
                $props[$k]['select']="*";
            }
        }else if($in=='da'){
            foreach($props as $k=>$v){
                $props[$k]['select']="";
            }
        }else if($in=='d1'){
            $displayDBO=!$displayDBO;
        }else if($in=='d2'){
            $displayNonDBO=!$displayNonDBO;
        }else if($in=='sdbo'){
            foreach($props as $k=>$v){
                if($v[0]->getDeclaringClass()->getName()=="DataBoundObject"){
                    $props[$k]['select']="*";
                }
            }
        }else if($in=='ddbo'){
            foreach($props as $k=>$v){
                if($v[0]->getDeclaringClass()->getName()=="DataBoundObject"){
                    $props[$k]['select']="";
                }
            }
        }else if($in=='cfg'){
            echo "New Controller filename (leave empty = unchange): ";
            $filename=getInput();
            $config['controller']=empty($filename)?$config['controller']:$filename;
            echo "New List View filename (leave empty = unchange, ! = don't create): ";
            $filename=getInput();
            $config['list']=empty($filename)?$config['list']:$filename;
            echo "New Detail View filename (leave empty = unchange, ! = don't create): ";
            $filename=getInput();
            $config['detail']=empty($filename)?$config['detail']:$filename;   
        }else if($in=='cl'){
            echo "[Change 'List' of selected props] new value:";
            $value=getInput();
            foreach($props as $k=>$v){
                if($v['select']=='*'){
                    $props[$k]['list']=$value;
                }
            }
        }else if($in=='cd'){
            echo "[Change 'Detail' of selected props] new value:";
            $value=getInput();
            foreach($props as $k=>$v){
                if($v['select']=='*'){
                    $props[$k]['detail']=$value;
                }
            }
        }else if($in=='ct'){
            echo "[Change 'Type' of selected props] new value:";
            $value=getInput();
            foreach($props as $k=>$v){
                if($v['select']=='*'){
                    $props[$k]['type']=$value;
                }
            }
        }else if($in=='cn'){
            echo "[Change 'Display Name' of selected props]\n";
            foreach($props as $k=>$v){
                if($v['select']=='*'){
                    echo "\tDisplay name for the prop '",$v[0]->getName(),"' : ";
                    $value=getInput();
                    if($value!=""){
                        $props[$k]['display']=$value;
                    }
                }
            }
        }else if($in=='pk'){
            foreach($props as $k=>$v){
                if($v['select']=='*'){
                    $config['PK']=$k;
                    break;
                }
            }
        }else if($in=='s'){
            echo "Not implemented";
            getInput();
        }else if($in=='gen'){
            /*echo "Not implemented";
            getInput();*/
            genForm($config,$props);
        }else if($in!=""){
            $in=explode(" ",$in);
            foreach($in as $v){
                if(!is_numeric($v))continue;
                $props[$v]['select']=$props[$v]['select']=="*"?"":"*";
            }
        }
    }
}

function genForm(){ //hardcode first

    getInput();
}
?>