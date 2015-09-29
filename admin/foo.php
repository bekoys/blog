<?php
require "../init.php";

$menu = '[{"id":1},{"id":4,"children":[{"id":3},{"id":2}]}]';
$menu = json_decode($menu, true);
//print_r($menu);

$cat = Category_Model::getInstance();
function traverse($root, &$nest_menu) {
    global $cat;
    if (! is_array($root)) {
        return;
    }
    // 叶节点
    if (count($root) == 1 and array_key_exists('id', $root)) {
        $nest_menu .= '<li class="dd-item dd3-item" data-id="' . $root['id'] . '">' . "\n";
        $nest_menu .= '<div class="dd-handle dd3-handle">Drag</div>' . "\n";
        $nest_menu .= '<div class="dd3-content">' . $cat->getTermName($root['id']) . '</div>' . "\n";
        $nest_menu .= '<li>' . "\n";
        return;
    }
    // 父目录
    if (count($root) == 2 and array_key_exists('id', $root)) {
        $nest_menu .= '<li class="dd-item dd3-item" data-id="' . $root['id'] . '">' . "\n";
        $nest_menu .= '<div class="dd-handle dd3-handle">Drag</div>' . "\n";
        $nest_menu .= '<div class="dd3-content">' . $cat->getTermName($root['id']) . '</div>' . "\n";
        // 该目录的子目录
        traverse($root['children'], $nest_menu);
        $nest_menu .= "</li>" . "\n";
        return;
    }
    $nest_menu .= '<ol class="dd-list">' . "\n";
    foreach ($root as $key => $val) {
        if (is_numeric($key)) {
            traverse($val, $nest_menu);
        }
    }
    $nest_menu .= "</ol>" . "\n";
}

traverse($menu, $nest_menu);
echo $nest_menu;

?>