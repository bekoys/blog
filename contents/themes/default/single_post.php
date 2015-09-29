<?php
/**
 * 单个文章的完整内容展示
 * @param 需要传入 Post_Model::getInstance()->getPostById 返回的单个文章信息
 */

if (!empty($post) && count($post) > 0) :
//    $post['post_content'] = htmlspecialchars_decode($post['post_content']);
    list($post['post_date'], $post_time) = explode(' ', $post['post_date']);
    $post['term_link'] = '<a href="' . SITE_URL . "term.php?term_id=$post[term_id]\" title=\"$post[term_name]\">$post[term_name]</a>";

    // 只有登陆后才有编辑的权限
    ?>
    <div id="single_post" class="post_item">
        <h1><?= $post['post_title'] ?></h1>
        <div class='post_meta'>
            <a class='meta-category' href="<?= SITE_URL . 'category.php?term_id=' . $post['term_id'] ?>"
               title=<?= $post['term_name'] ?>> <?= $post['term_name'] ?></a>
            <a class='meta-date'> <?= $post['post_date'] ?></a>
            <a class='meta-edit' href="<?= SITE_URL . 'admin/write_log.php?action=edit&pageid=' . $post['post_id'] ?>"> 编辑</a>
        </div>
        <!-- post_meta end -->
        <div id="post_content"><?= $post['post_content'] ?></div>
        <!-- post_content end -->
    </div>
    <!-- post end -->
<?php else: ?>
    <div class="post_item">
        <h2>抱歉，该文章未找到！<h2>
    </div>
<?php
endif;
