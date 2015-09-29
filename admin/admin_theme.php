<?php
require 'admin_init.php';
login();
if (! empty($_GET['theme'])) {
    Option_model::getInstance()->updateOption('current_theme', $_GET['theme']);
}

require ADMIN_VIEW_PATH . 'header.php';

$themes = getThemes();
$cur_theme = Option_model::getInstance()->getOption('current_theme');

require ADMIN_VIEW_PATH . 'admin_theme.php';
require ADMIN_VIEW_PATH . 'footer.php';