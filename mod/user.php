<?php

route('/user/login', 'login');
function login($arg){
    template('login');
}

route('/user/login', 'do_login', 'POST');
function do_login($arg){
    ?>
    Login OK
    <?
}