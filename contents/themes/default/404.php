<?php #404.php
$page_title = '404Error | ' . SITE_TITLE;
$need_login = false;
require TEMPLATE_PATH . 'header.php';
echo '<div id="error404"><h1>Ops, Page NOT Found!</h1><img src="' . TEMPLATE_URL . 'images/404.png" /></div>';
require TEMPLATE_PATH . 'footer.php';

