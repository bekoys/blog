<?php
/**
 * 全局项加载
 */

error_reporting(E_ALL);
ob_start();
header('Content-Type: text/html; charset=UTF-8');

/* Basic config */
define('SITE_TITLE', "扑爬");
define('SITE_PATH', dirname(__FILE__) . '/');
define('SITE_URL', '/' . basename(dirname(__FILE__)) . '/');
define('PLUG_PATH', SITE_PATH . 'contents/plugins/');  // *_PATH表示文件的路径，*_URL表示网站的URL路径
define('INC_PATH', SITE_PATH . 'includes/');
define('LIB_PATH', SITE_PATH . 'includes/lib/');
define('ITEM_NUM', 10);  // 每页显示的信息条目数

/* Admin */
define('ADMIN_VIEW_PATH', SITE_PATH . 'admin/views/');
define('ADMIN_VIEW_URL', SITE_URL . 'admin/views/');

/* User */
define('USERNAME', 'song');
define('PASSWORD', 'song12345');

/* Database */
// mysql database address
define('DB_HOST', 'localhost');
// mysql database user
define('DB_USER', 'root');
// database password
define('DB_PASSWD', '');
// database name
define('DB_NAME', 'blog');
// database prefix
define('DB_PREFIX', 'blog_');

require LIB_PATH . 'function.base.php';
$opt = Option_model::getInstance();
/* Theme */
define('TEMPLATE_URL', SITE_URL . 'contents/themes/' . $opt->getOption('current_theme') . '/');
define('TEMPLATE_PATH', SITE_PATH . 'contents/themes/' . $opt->getOption('current_theme') . '/');



