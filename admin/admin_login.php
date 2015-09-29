<?php
require 'admin_init.php';

if (isset($_POST['login_submit'])) {
    if ($_POST['username'] == USERNAME && $_POST['password'] == PASSWORD) {
        $expire = isset($_POST['rememberme']) ? (time() + 3600 * 24 * 30) : null;
        setcookie('song_username', md5($_POST['username']), $expire, '/');
        setcookie('song_password', md5($_POST['password']), $expire, '/');
        $redirect_url = SITE_URL . 'admin/';
        echo "<script type=text/javascript>location.href='$redirect_url';</script>";
    } else {
        echo "<h2 class='warning' style='text-align: center;position: relative;top: 100px;'>Username or password wrong!</h2>";
    }
}

require ADMIN_VIEW_PATH . 'admin_login.php';
require ADMIN_VIEW_PATH . 'footer.php';
