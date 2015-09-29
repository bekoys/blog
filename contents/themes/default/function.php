<?php
$cat = Category_Model::getInstance();
// 为header中的导航菜单生成html
function create_nav_menu($root, &$nest_menu) {
    global $cat;
    if (empty($root)) {
        return;
    }
    // 叶节点
    if (count($root) == 1 and array_key_exists('id', $root)) {
        $nest_menu .= '<li><a href="' . SITE_URL . 'category.php?term_id=' . $root['id']
            . '" title="">' . $cat->getTermName($root['id']) . "</a></li>\n";
        return;
    }
    // 父目录
    if (count($root) == 2 and array_key_exists('id', $root)) {
        $nest_menu .= '<li><a href="' . SITE_URL . 'category.php?term_id=' . $root['id']
            . '" title="">' . $cat->getTermName($root['id']) . "</a>\n";
        $nest_menu .= "<ul>\n";

        // 该目录的子目录
        create_nav_menu($root['children'], $nest_menu);
        $nest_menu .= "</ul></li>\n";
        return;
    }
    foreach ($root as $key => $val) {
        if (is_numeric($key)) {
            create_nav_menu($val, $nest_menu);
        }
    }
}
