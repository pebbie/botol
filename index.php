<?
define('DEBUG', true);
$time_start = microtime(1);
session_start();
$route = array();
foreach( glob('ext/*.php') as $module)
    require_once($module);
foreach( glob('mod/*.php') as $module)
    require_once($module);

function escape($str){
    return str_replace('/', '\/',$str);
}
function route($path,$handler,$method='GET'){
    global $route;
    if(is_array($route[escape($path)])){
        $route[escape($path)][$method] = $handler;
    }
    else{
        $route[escape($path)] = array($method=>$handler);
    }
}
function pr($str){
    return '/^'.$str.'$/s';
}

function template($template,$vars=array()){
    $tpl = new Savant3();
    $tpl->vars = $vars;
    $tpl->root = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
    $ftpl = 'tpl/'.$template.'.tpl';
    $tpl->display($ftpl);
}

$path = '/'.$_GET['q'];
$found = false;
$method = $_SERVER['REQUEST_METHOD'];
foreach($route as $pattern => $handler){
    if(preg_match(pr($pattern), $path) and function_exists($handler[$method])){
        call_user_func($handler[$method], $path);
        $found = true;
        break;
    }
}
if(!$found)
    require_once('404.php');

?>