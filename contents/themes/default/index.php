<?php
require TEMPLATE_PATH . 'header.php';
$page_title = SITE_TITLE;
echo "<div id='main'>";
$Post_model = Post_Model::getInstance();
$paging_id = isset($_GET['paging_id']) ? $_GET['paging_id'] : null;
$posts = $Post_model->getPostlist('post_date desc', $paging_id);
require TEMPLATE_PATH . 'post_list.php';
widget_paging();
?>

</div>
<!-- main end -->

<?php
require TEMPLATE_PATH . 'right_side.php';
require TEMPLATE_PATH . 'footer.php';

