<?php

$post_id = $_REQUEST['pageid'];
$post = Post_Model::getInstance()->getPostById($post_id);

//为了显示文章名，延迟加载
$page_title = $post['post_title'] . ' | ' . SITE_TITLE;
require TEMPLATE_PATH . 'header.php';

/*// 获取评论
$Comment_model = Comment_Model::getInstance();
$comments = $Comment_model->getComments($post_id);
$comments_num = $Comment_model->getCommentsNum($post_id);*/

require TEMPLATE_PATH . 'single_post.php';
require TEMPLATE_PATH . 'footer.php';
