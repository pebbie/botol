<?php
//define('DEBUG', true);
$time_start = microtime(1);
session_start();
$route = array();
$routevars = array();
foreach( glob('ext/*.php') as $module)
    require_once($module);

//bootstrapping code
if (file_exists('boot.php')) require_once('boot.php');

foreach( glob('mod/*.php') as $module)
    require_once($module);


function escape($str){
    return str_replace('/', '\/',$str);
}
function route($path,$handler,$method='GET'){
    global $route, $routevars;
    $epath = escape($path);
    
    $n = preg_match_all('(:\w+)', $path, $matches);
    if(intval($n) > 0){
        foreach($matches[0] as $k=>$m){
            $epath = str_replace($m, '(\w+)', $epath);
        }
        $routevars[$epath] = array();
        foreach($matches[0] as $k=>$m){
            $routevars[$epath][substr($m, 1)] = $k;
        }
    }
    if(isset($route[$epath]) && is_array($route[$epath])){
        $route[$epath][$method] = $handler;
    }
    else{
        $route[$epath] = array($method=>$handler);
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

$path = '/' . (isset($_GET['q']) ? $_GET['q'] : '');
$found = false;
$method = $_SERVER['REQUEST_METHOD'];
foreach($route as $pattern => $handler){
    if(preg_match(pr($pattern), $path, $matches) && (is_callable($handler[$method]) || function_exists($handler[$method]))){
        
        $arg = $matches;
        if(isset($routevars[$pattern]) && is_array($routevars[$pattern])){
            $arg = array();
            foreach($routevars[$pattern] as $key=>$idx){
                $arg[$key] = $matches[$idx+1];
            }
        }
        call_user_func($handler[$method], $arg);
        $found = true;
        break;
    }
}
if(!$found)
    require_once('404.php');
if(defined('DEBUG')){
    function convert($size) {
       $unit=array('b','kb','mb','gb','tb','pb');
       return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
    echo ' '.((microtime(1)-$time_start)*1000).' ms ';
    echo convert(memory_get_peak_usage(true));
}
