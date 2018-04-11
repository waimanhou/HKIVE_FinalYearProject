<?

require_once realpath(dirname(__FILE__)).'/config.inc.php';
require_once ROOT.'/inc/Smarty/Smarty.class.php';

class View extends Smarty {
    function __construct() {
        parent::Smarty();
        if(!isset($_SESSION['theme'])) {
			if(isMobileBrowser()==false){
	    $_SESSION['theme']='default';
			}else{
				$_SESSION['theme']='mobile';
			}
			//$_SESSION['theme']='mobile';
        }
        if(!file_exists(ROOT.'/views/'.$_SESSION['theme'])) {
            $_SESSION['theme']='default';
        }
        $this->template_dir=ROOT.'/views/'.$_SESSION['theme'];
        $this->compile_dir=ROOT."/cache/smarty_templates_c/{$_SESSION['theme']}";
        $this->cache_dir=ROOT."/cache/smarty_cache/{$_SESSION['theme']}";
        //$this->caching=true;
        $this->caching=false;
        $this->cache_lifetime=10;
        $this->left_delimiter="<{";
        $this->right_delimiter="}>";
        $this->plugins_dir[]=ROOT."/inc/SmartyPlugin";
    }
}
