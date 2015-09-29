<?php #comment.php
ob_start();
require '../../init.php';
//利用ajax返回给page.php的数据
$content = htmlClean($_POST['comment_content']);
$name = trim($_POST['nickname']);
$post_id = $_POST['post_id'];

header('Content-type: text/html;charset=UTF-8');
echo "<p class='comment_author'>$name</p>" .
     "<div class='avatar'><img src='images/avatar.jpg' title='avatar'/></div>" .
     "<p class='comment_content'>$content</p><div class='spacer'></div>";

//将评论加入数据库
Comment_Model::getInstance()->updateComment($name, $content, $post_id);

