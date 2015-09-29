<?php
require 'admin_init.php';
login();
//删除单个文章
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    Post_Model::getInstance()->deleteLog($post_id);
}

// 删除多个文章
elseif (isset($_GET['post_ids'])) {
    $ids = explode(',', $_GET['post_ids']);
    foreach ($ids as $id) {
        Post_Model::getInstance()->deleteLog($id);
    }
}

// 删除目录
elseif (isset($_GET['term_id'])) {
    Category_Model::getInstance()->deleteTerm($_GET['term_id']);
}

elseif (isset($_GET['term_ids'])) {
    $ids = explode(',', $_GET['term_ids']);
    foreach ($ids as $id) {
        Category_Model::getInstance()->deleteTerm($id);
    }
}
?>