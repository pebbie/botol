<?php

route('/user/login', 'login_form');
function login_form($arg){
    template('login');
}

route('/user/login', 'do_login', 'POST');
function do_login($arg){
    ?>
    Login OK
    <?
}