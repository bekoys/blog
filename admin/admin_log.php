<?php
require 'admin_init.php';
login();
require ADMIN_VIEW_PATH . 'header.php';
// default order by date
$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'date';
// title => asc order, time => desc order
if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = ($orderby == 'title') ? 'asc' : 'desc';
}
$order_clause = "post_$orderby $order";

if (! isset($_GET['term_id'])) {
    $posts = Post_Model::getInstance()->getPostlist($order_clause);
} else {
    $request_clause = 'term_id='. $_GET['term_id']. '&';
    $posts = Post_Model::getInstance()->getPostsByTerm($_GET['term_id'], $order_clause);
}

$order = isset ( $_GET ['order'] ) ? ($_GET ['order'] == 'asc' ? 'desc' : 'asc') : 'asc';

require ADMIN_VIEW_PATH . 'admin_log.php';
require ADMIN_VIEW_PATH . 'footer.php';
