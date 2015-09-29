<?php
/**
 * 文章列表组件
 * @params 通过 $Post_model->getPostlist 获取的文章列表
 */

if (! empty($posts)) :
    foreach ($posts as $post) :
        $post_url = SITE_URL . "post.php?pageid=$post[post_id]";
        ?>
        <div class='post_item'>
            <h2><a href="<?= $post_url ?>"><?= $post['post_title'] ?></a></h2>

            <div class='post_meta'>
                <a class='meta-category' href="<?= SITE_URL . 'category.php?term_name=' . $post['term_name'] ?>"
                   title=<?= $post['term_name'] ?>> <?= $post['term_name'] ?></a>
                <a class='meta-date'></a><?= $post['post_date'] ?></a>
            </div>
            <!-- post_meta end -->
            <div class="post_excerpt">
                <?php $post['post_excerpt'] = md_to_html($post['post_excerpt']); ?>
                <?= $post['post_excerpt'] ?>
            </div>
            <!-- post_content end -->
            <div class="post_footer">
                <a href=<?= $post_url ?> class="read_more"><span>全文阅读</span></a>
            </div>
        </div>

    <?php
    endforeach;
else :
    ?>
    <div class="post_item">
        <h2>抱歉，没有找到相关文章！<h2>
    </div>
<?php
endif;