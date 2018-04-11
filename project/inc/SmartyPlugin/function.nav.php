<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function smarty_function_nav($params, &$smarty) {
    $page = intval($params['page']);   //page number (first page=1)
    $total = intval($params['total']);        //total record
    $url = $params['url'];                    //url like "result.php?page="
    $eachNum = intval($params['eachNum']);          //number of page no. shown each time
    $perPage = intval($params['perPage']);        // record per page
    $separator = $params['separator'] ? $params['separator'] : '&nbsp;';        //html code between page number
    $currentCssClass = $params['currentCssClass'] ? $params['currentCssClass'] : '';
    $normalCssClass = $params['normalCssClass'] ? $params['normalCssClass'] : '';
    $currentCss = $params['currentCss'] ? addslashes($params['currentCss']) : '';
    $normalCss = $params['normalCss'] ? addslashes($params['normalCss']) : '';
    $eachNum = $eachNum == 0 ? 10 : $eachNum;
    $perPage = $perPage <= 0 ? 10 : $perPage;

    $totalpage = (int) (ceil($total / $perPage));

    $each = $each <= 0 ? 10 : $each;

    $page = $page <= 0 ? 1 : $page;

    $left = $each >> 1;
    if ($page - $left <= 0) {
        $left = 1;
        $right = $eachNum;
    }
    if ($right >= $totalpage) {
        $right = $totalpage;
        $left = $right - $eachNum;
        if ($left <= 0) {
            $left = 1;
        }
    }

    $output = array();
   
    for ($i = $left; $i <= $right; $i++) {
        if ($i == page) {
            $output[] = "<a href=\"{$url}{$i}\" class=\"{$currentCssClass}\" style=\"{$currentCss}\">$i</a>";
        } else {
            $output[] = "<a href=\"{$url}{$i}\" class=\"{$normalCssClass}\" style=\"{$normalCss}\">$i</a>";
        }
    }

    return implode($separator, $output);
}
