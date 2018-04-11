<?php

function smarty_compiler_addjs($params, &$smarty) {
    $params.=' var=$jsFiles';
    $params = $smarty->_parse_attrs($params);
    return( "{$params['var']}[] = {$params['url']};");
}