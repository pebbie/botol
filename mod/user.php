<?php

route('/user/login', 'login_form');
function login($arg){
    template('login_form');
}

route('/user/login', 'do_login', 'POST');
function do_login($arg){
    ?>
    Login OK
    <?
}