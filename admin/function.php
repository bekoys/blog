<?php
/**
 * 对「导航」管理生成嵌套的菜单
 * @param $root
 * @param $nest_menu
 * @param $terms_selected
 * @global $cat
 */
$cat = Category_Model::getInstance();
function create_nest_menu($root, &$nest_menu, &$terms_selected) {
    global $cat;
    if (empty($root)) {
        return;
    }
    // 叶节点
    if (count($root) == 1 and array_key_exists('id', $root)) {
        $terms_selected[] = $root['id'];
        $nest_menu .= '<li class="dd-item dd3-item" data-id="' . $root['id'] . '">' . "\n";
        $nest_menu .= '<div class="dd-handle dd3-handle">Drag</div>' . "\n";
        $nest_menu .= '<div class="dd3-content">' . $cat->getTermName($root['id']) . '</div>' . "\n";
        $nest_menu .= '<li>' . "\n";
        return;
    }
    // 父目录
    if (count($root) == 2 and array_key_exists('id', $root)) {
        $terms_selected[] = $root['id'];
        $nest_menu .= '<li class="dd-item dd3-item" data-id="' . $root['id'] . '">' . "\n";
        $nest_menu .= '<div class="dd-handle dd3-handle">Drag</div>' . "\n";
        $nest_menu .= '<div class="dd3-content">' . $cat->getTermName($root['id']) . '</div>' . "\n";
        // 该目录的子目录
        create_nest_menu($root['children'], $nest_menu, $terms_selected);
        $nest_menu .= "</li>" . "\n";
        return;
    }
    $nest_menu .= '<ol class="dd-list">' . "\n";
    foreach ($root as $key => $val) {
        if (is_numeric($key)) {
            create_nest_menu($val, $nest_menu, $terms_selected);
        }
    }
    $nest_menu .= "</ol>" . "\n";
}


/**
 * 获取主题文件夹下的主题
 * @return array
 */
function getThemes() {
    $dir = SITE_PATH . 'contents/themes/';
    if (false != ($handle = opendir($dir))) {
        while (false !== ($file = readdir($handle))) {
            $file_path = $dir . $file;
            if ($file != "." && $file != ".." && is_dir($file_path)) {
                $row['name'] = $file;
                if (file_exists($file_path . '/screenshot.png')) {
                    $row['thumbnail'] = SITE_URL . 'contents/themes/' . $file . '/screenshot.png';
                } elseif (file_exists($file_path . '/screenshot.jpg')) {
                    $row['thumbnail'] = SITE_URL . 'contents/themes/' . $file . '/screenshot.jpg';
                } else {
                    $row['thumbnail'] = SITE_PATH . 'img/default_theme.png';
                }
                $themes[] =$row;
            }
        }
        closedir($handle);
    }
    return $themes;
}

/**
 * 需要登录的页面在开头添加login()
 */
function login() {
    if (!isset($_COOKIE['song_password']) or $_COOKIE['song_password'] != md5(PASSWORD) or
        !isset($_COOKIE['song_username']) or $_COOKIE['song_username'] != md5(USERNAME)) {
        $redirect_url = SITE_URL . 'admin/admin_login.php';
        echo "<script type=text/javascript>location.href='$redirect_url';</script>";
    }
}