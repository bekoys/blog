<?php
/**
 * 定义路由的规则
 * @in $path 请求的url
 */
$rules = array(
    // theme
    'index' => '{' . SITE_URL . '(index.php)}',
    'post' => '{' . SITE_URL . '(post.php)}',
    'category' => '{' . SITE_URL . '(category.php)}',
    'archive' => '{' . SITE_URL . '(archive.php)}',
    // admin
    'admin_index' => '{' . SITE_URL . '(admin/index.php)}',
    'admin_login' => '{' . SITE_URL . '(admin/admin_login.php)}',
    'admin_log' => '{' . SITE_URL . '(admin/admin_log.php)}',
    'admin_write' => '{' . SITE_URL . '(admin/admin_write.php)}',
    'admin_nav' => '{' . SITE_URL . '(admin/admin_nav.php)}',
    'admin_term' => '{' . SITE_URL . '(admin/admin_term.php)}',
    'admin_theme' => '{' . SITE_URL . '(admin/admin_theme.php)}',
    'admin_write_log' => '{' . SITE_URL . '(admin/write_log.php)}',
	'admin_delete' => '{' . SITE_URL . '(admin/admin_delete.php)}',
);
$url['index'] = TEMPLATE_PATH . 'index.php';
$url['404'] = TEMPLATE_PATH . '404.php';
$url['admin'] = SITE_PATH . '/admin/index.php';

global $path;
if ($path == SITE_URL) {
    require TEMPLATE_PATH . 'function.php';
    require $url['index'];
    exit;
}
if ($path == SITE_URL . 'admin/') {
    require $url['admin'];;
    exit;
}

foreach ($rules as $rule => $regex) {
    if (preg_match($regex, $path, $m)) {
        // admin
        if (strpos($rule, 'admin_') !== false) {
            require SITE_PATH . $m[1];
        } else { // theme
            require TEMPLATE_PATH . 'function.php';
            require TEMPLATE_PATH . $m[1];
        }
        exit;
    }
}

// 404 error
require $url['404'];