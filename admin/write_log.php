<?php
require 'admin_init.php';
login();
require ADMIN_VIEW_PATH . 'header.php';
?>
<link href="PageDown/style.css" rel="stylesheet" type="text/css"/>

<?php
// 1. 发布、编辑文章
if (isset ($_POST ['publish_submit']) || isset ($_POST ['draft_submit']) ||
    isset ($_POST['update_publish']) || isset ($_POST['update_draft'])) {
    $has_form_error = false;

    // 用empty检查文本输入框,检查标题不能为空
    if (! empty ($_POST ['post_title'])) {
        $post_title = trim($_POST ['post_title']);
    } else {
        $has_form_error = true;
        fyAlert("标题不能为空");
    }

    // 检查文章不为空
    if (!$has_form_error && !empty ($_POST ['post_content'])) {
        $post_content = $_POST ['post_content'];
    } else if (!$has_form_error) {
        $has_form_error = true;
        fyAlert("内容不能为空！");
    }
    // TODO: 检查防止重复提交

     if (!$has_form_error && empty($_POST ['post_excerpt'])) {
            if (preg_match('#<!--\s*more\s*-->#', $post_content, $matches)) {
            $pos = strpos($post_content, $matches[0]);
            $post_excerpt = substr($post_content, 0, $pos);
        }
    } else { 
        $post_excerpt = $_POST ['post_excerpt'];
    }

    $post_term = $_POST ['post_term'];
    $post_status = isset($_POST ['draft_submit']) ? 'draft' : 'publish';

    // 表单验证正确
    if (!$has_form_error) {
        $log_data = array();
        $log_data[] = $post_title;
        $log_data[] = escape_data($post_content);
        $log_data[] = isset($post_excerpt) ? escape_data($post_excerpt) : null;
        $log_data[] = $post_status;
        $log_data[] = $post_term;

        if (isset ($_POST['publish_submit'])) {
            $post_id = Post_Model::getInstance()->addLog($log_data);
        } elseif(isset($_POST['update_publish'])) {
            $post_id = $_GET['pageid'];
            Post_Model::getInstance()->updateLog($post_id, $log_data);
        }
        $post_url = SITE_URL . "post.php?pageid=$post_id";
        $publish_success_div = "<div class=\"submit-success span6\"><span>保存成功 </span><a href=\"$post_url\" target='_blank'>查看文章</a></div>";
    }
}

// 2. 编辑文章显示的内容
elseif (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $post_id = $_GET['pageid'];
    $post = Post_Model::getInstance()->getPostById($post_id, false);
    $post_title = $post['post_title'];
	$post_excerpt = $post['post_excerpt'];
    //$post_excerpt = isset($post['post_excerpt']) ? $post['post_excerpt'] : null;
    $post_content = $post['post_content'];
    $post_status = isset($_POST ['update_draft']) ? 'draft' : 'publish';
    $term_id = $post['term_id'];

    $post_term = Category_Model::getInstance()->getTermName($term_id);
}

if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    require ADMIN_VIEW_PATH . 'edit_log.php';
} else {
    require ADMIN_VIEW_PATH . 'write_log.php';
}

require ADMIN_VIEW_PATH . 'footer.php';

