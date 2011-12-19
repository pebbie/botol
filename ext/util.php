<?php

function is_auth(){
    return session_is_registered('user');
}

function login($user,$group){
    session_register('user');
    session_register('group');
    $_SESSION['user'] = $user;
    $_SESSION['group'] = $group;
}

function logout(){
    session_unregister('user');
    session_unregister('group');
}

function root(){
    return str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
}

function url($url){
    return root().$url;
}

function redirect($url=''){
    header('Location: '.root().$url);
}