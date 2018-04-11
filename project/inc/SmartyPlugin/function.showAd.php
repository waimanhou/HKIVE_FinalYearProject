<?php

function smarty_function_showAd($params, &$smarty)
{
    if (empty($params['type'])) {
        $smarty->trigger_error("assign: missing 'type' parameter");
        return;
    }
    $db=new DB();
    $ad=new Ads($db);
    $ad=$ad->getAD($params['type']);
    return $ad;
   // return '';

}