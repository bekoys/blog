<?php
require 'admin_init.php';
login();
// 更新菜单项
if (isset($_POST['menu'])) {
    $menu = str_replace(',{}', '', $_POST['menu']);
    Option_model::getInstance()->updateOption('theme_menu', $menu);
    exit;
}
require ADMIN_VIEW_PATH . 'header.php';
$menu = Option_model::getInstance()->getOption('theme_menu');
// 初始化菜单项
if (empty($menu)) :
    $terms = Category_Model::getInstance()->getTermsAll();
    echo '<div class="dd" id="nestable">';
    echo '<ol class="dd-list">';
    foreach ($terms as $term) : ?>
        <li class="dd-item dd3-item" data-id="<?= $term['term_id'] ?>">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content"><?= $term['term_name'] ?></div>
        </li>
<?php
    endforeach;
    echo '</ol></div>';
endif;

$menu_arr = json_decode($menu, true);
// 已经被添加到菜单中的分类
create_nest_menu($menu_arr, $menu_selected, $terms_selected);
$terms = Category_Model::getInstance()->getTermsAll();
$term_ids = array();
foreach ($terms as $term) {
    $term_ids[] = $term['term_id'];
}

// 还未被添加到菜单中的分类
$terms_not_selected = array_diff($term_ids, $terms_selected);
foreach ($terms_not_selected as $term_id) {
    $menu_not_selected = '<li class="dd-item dd3-item" data-id="' . $term_id . '">' . "\n";
    $menu_not_selected .= '<div class="dd-handle dd3-handle">Drag</div>' . "\n";
    $menu_not_selected .= '<div class="dd3-content">' . $cat->getTermName($term_id) . '</div>' . "\n";
    $menu_not_selected .= '<li>' . "\n";
}
if (empty($menu_not_selected)) {
    $menu_not_selected = '<h2>无还未添加到菜单的分类</h2>';
} else {
    $menu_not_selected = '<ol class="dd-list">' . $menu_not_selected . '</ol>';
}

require ADMIN_VIEW_PATH . 'admin_nav.php';
require ADMIN_VIEW_PATH . 'footer.php';
