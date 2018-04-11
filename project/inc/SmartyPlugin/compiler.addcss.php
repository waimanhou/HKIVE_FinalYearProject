<?php

function smarty_compiler_addcss($params, &$smarty) {
    $params.=' var=$cssFiles';
    $params = $smarty->_parse_attrs($params);
    return( "{$params['var']}[] = {$params['url']};");
}