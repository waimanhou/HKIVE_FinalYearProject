<?php

function showErrMsg($msg, $goDie=true) {
    $v = new View();
    $v->assign("msg", $msg);
    $v->display("showErrMsg.htm");
    if ($goDie) {
        die();
    }
}

function showMsg($msg, $goDie=true) {
    $v = new View();
    $v->assign("msg", $msg);
    $v->display("showMsg.htm");
    if ($goDie) {
        die();
    }
}

function requireLogin() {
    if (!isset($_SESSION['userid'])) {
        showErrMsg("Please login first");
    }
}

function checkTicket($ticket_name, $fieldname='ticket', $method="POST", $goDie=true) {
    if ($method == "POST") {
        $v = $_POST[$fieldname];
    } else {
        $v = $_GET[$fieldname];
    }
    if (!isset($_SESSION[$ticket_name])) {
        showErrMsg("Error occured.");
    }
    if ($v != $_SESSION[$ticket_name]) {
        unset($_SESSION[$ticket_name]);
        if ($goDie) {
            showErrMsg("Error occured.");
            die();
        } else {
            return false;
        }
    }
    unset($_SESSION[$ticket_name]);
    return true;
}

function NewTicket($ticket_name='ticket') {
    $_SESSION[$ticket_name] = mt_rand();
    return $_SESSION[$ticket_name];
}

function redirect($url, $js=false) {
    if ($js) {
        echo '<script>location="' . addslashes($url) . '"</script>';
    } else {
        header("location: $url");
        die();
    }
}

function checkHKID($hkid) {
    $hkid = strtoupper($hkid);
    $hkid = str_replace(array('(', ')'), '', $hkid);
    if (!preg_match('/^[A-Z]{1,2}\d{6}[0-9A]$/', $hkid)) {
        return false;
    }
    $sum = 0;
    if (strlen($hkid) == 8) {
        $hkid = '@' . $hkid;
    }
    $sum+= ( ord($hkid{0}) - 64) * 9;
    $sum+= ( ord($hkid{1}) - 64) * 8;
    for ($i = 2; $i < 8; $i++) {
        $sum+=$hkid{$i} * (9 - $i);
    }
    $sum+= $hkid{8} == 'A' ? 10 : $hkid{8} * 1;
    return $sum % 11 == 0;
}

function page($pg_no, $each_pg, $total_record=-1) {
    //all start 1

    /*
     * e.g. total 789 record
     * for page 10
     * each 20 record
     * p.10 = 181 to 200 ( (10-1)*20+1  to 10*20+1  )
     * total page = each_pg/total_record
     */
    return array(
        "page" => $pg_no,
        "totla_page" => $total_record / $each_page,
        "start" => ($pg_no - 1) * 20 + 1,
        "end" => $pg_no * 20 + 1,
        "sqllimit" => ($pg_no - 1) * 20 + "," + $each_pg
    );
}

function debug2file($s) {
    $fp = fopen(ROOT . "/inc/_logs/debug.txt", "a+");
    fwrite($fp, date("jS F,Y H:i:s") . " @ " . $_SERVER["REQUEST_URI"] . "\r\n");
    fwrite($fp, $s);
    fwrite($fp, "\r\n");
    fclose($fp);
}

function isMobileBrowser() {
    //if(extension_loaded('zlib')){ob_start('ob_gzhandler');}
    //header("Content-type: text/css");
    $UA = $_SERVER['HTTP_USER_AGENT'];
    if (eregi("mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo|iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile|ipod|iphone|android|opera mini|blackberry|palm os|palm|hiptop|avantgo|fennec|plucker|xiino|blazer|elaine|iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile", $UA) == 1) {
        return true;
    } else {//include($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/default/style.css");
        //echo 'desktop';
        return false;
    }
    //if(extension_loaded('zlib')){ob_end_flush();}
}

/*
  function getAD($type="top")
  {
  $ad=new Ads(new DB());
  return $ad->getAD();
  } */

function goBack($js=false, $goDie=true) {
    if ($js) {
        echo "<script>history.go(-1)</script>";
    } else {
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
    if ($goDie) {
        die();
    }
}

function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }