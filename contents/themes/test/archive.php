<?php

$date = $_GET['y-m'];
$posts = Post_Model::getInstance()->getPostsByArchive($date);
$page_title = $date . ' | ' . SITE_TITLE;

require TEMPLATE_PATH . 'header.php';

echo "<div id='main'>";
echo "<div id='term_name'><h1>$date</h1></div>";
require TEMPLATE_PATH . 'post_list.php';
widget_paging();
?>

    </div>
    <!-- main end -->

<?php
require TEMPLATE_PATH . 'right_side.php';
require TEMPLATE_PATH . 'footer.php';

			