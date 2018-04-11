<?
function smarty_modifier_lang(){
    /*$a=func_get_args();
    array_shift($a);
        print_r($a);*/
    global $lang;
    
	
    $args=func_get_args();
    $string=array_shift($args);
    $string2=$string;
    $string=strtolower($string);
    if(!isset($lang)){
        include ROOT."/views/langs/{$_SESSION['lang']}.php";
    }
    if(array_key_exists($string, $lang)){
        return vsprintf($lang[$string], $args);
    }else{
		if(DEBUG_MODE){
			$db=new DB();
			$s1=addslashes($string);
			$s2=addslashes($_SERVER["REQUEST_URI"]);
			$db->query("insert into word_to_be_translated values('{$_SESSION['lang']}','$s1','$s2',null)");
		}
        return $string2;
    }

}