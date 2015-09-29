<?php

$term_id = $_GET['term_id'];
$posts = Post_Model::getInstance()->getPostsByTerm($term_id);
$term_name = Category_Model::getInstance()->getTermName($term_id);
$page_title = $term_name . ' | ' . SITE_TITLE;

require TEMPLATE_PATH . 'header.php';

echo "<div id='main'>";
echo "<div id='term_name'><h1>$term_name</h1></div>";
require TEMPLATE_PATH . 'post_list.php';
widget_paging();
?>

    </div>
    <!-- main end -->

<?php
require TEMPLATE_PATH . 'right_side.php';
require TEMPLATE_PATH . 'footer.php';

			