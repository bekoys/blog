<?php
require_once 'function.php';
//导航菜单
function widget_navibar() { ?>
<div id="navigation" class="clearfix">
    <div class="menu-main-container">
    <ul class="sf-menu">
    <li class="current"><a href="<?= SITE_URL ?>index.php">主页</a>
        <?php
        $menu_arr = json_decode(Option_model::getInstance()->getOption('theme_menu'), true);
        create_nav_menu($menu_arr, $menu);
        echo $menu;
        ?>
    </ul>
</div>
</div>
<?php } ?>
<?php
// 分页
function widget_paging() {
    $Post_model = Post_Model::getInstance();
    if (($post_num = $Post_model->getPostsNum()) > ITEM_NUM) {
        $paging_num = ceil(($post_num - 1) / ITEM_NUM); // 页总数，向上取整
        echo '<div id="paging">';
        if (! isset($_GET ['paging_id'])) {
            $_GET ['paging_id'] = 1;
        }
        $pre_page = $_GET ['paging_id'] - 1;
        if ($pre_page >= 1) {
            echo "<a href='$_SERVER[PHP_SELF]?paging_id=$pre_page'>上一页</a>";
        }
        for ($i = 1; $i <= $paging_num; $i++) {
            if ($i == $_GET ['paging_id']) {
                echo "<span>$i</span>";
            } else {
                echo "<a href='$_SERVER[PHP_SELF]?paging_id=$i'>$i</a>";
            }
        }
        $next_page = $_GET ['paging_id'] + 1;
        if ($next_page <= $paging_num) {
            echo "<a href='$_SERVER[PHP_SELF]?paging_id=$next_page'>下一页</a>";
        }
        echo '</div>';  // paging end
    }
}
?>
<?php
// 搜索框,采用Google搜索
function widget_GoogleSearchbox() { ?>
    <div id="search_box" class="widget">
        <form method="get" action="http://google.com/search" target="_blank" accept-charset="utf-8">
            <input  type="search" name="q" results="0" placeholder="搜索" />
            <input type="hidden" name="q" value="site:<?= $_SERVER['HTTP_HOST'] . SITE_URL ?>">
        </form>
    </div>
<?php } ?>
<?php
// 评论排行
function widget_comment() { ?>
<div class="widget">
    <h3>评论排行</h3>
    <ul>
    <?php
        $posts = Post_Model::getInstance()->getPostsSortByComment(5);
        foreach ($posts as $post) {
            $title = subString($post['post_title'], 0, 8);
            echo '<li><a href="' . SITE_URL .'post.php?pageid=' . $post['post_id'] . "\" title=\"$title\">$title ($post[comment_count])</a></li>";
        }
    ?>
    </ul>
</div>
<?php } ?>
<?php
// 文章存档
function widget_archive() { ?>
<div class="widget">
    <h3>文章存档</h3>
    <ul>
        <?php
        $posts = Post_Model::getInstance()->getPostlistByArchive(5);
        foreach ($posts as $post) {
            echo "<li><a href='" . SITE_URL . "archive.php?y-m=$post[post_date]' title=''>$post[post_date]    ($post[post_count])</a></li>";
        }
        ?>
    </ul>
</div>
<?php } ?>
<?php
// 网站收藏
function widget_links() { ?>
<div class="widget">
    <h3>网站收藏</h3>
    <ul>
        <?php
        $links = Link_Model::getInstance()->getLinks(5);
        foreach($links as $link) {
            $name = subString($link['link_name'], 0, 16);
            echo "<li><a class='link_description' href='$link[link_url]'>$name<span>$link[link_description]</span></a></li>";
        }
        ?>
    </ul>
</div>
<?php } ?>

<?php
// 登陆
function widget_login() { ?>
<div class="widget">
    <h3>登录</h3>
    <ul>
        <?php if (isset($_COOKIE['song_password']) and isset($_COOKIE['song_username'])
            and $_COOKIE['song_password'] == md5(PASSWORD) and $_COOKIE['song_username'] == md5(USERNAME)): ?>
        <li><a href="<?= SITE_URL . 'admin/admin_login.php'?>"><?= USERNAME ?></a></li>
        <?php else: ?>
        <li><a href="<?= SITE_URL . 'admin/admin_login.php'?>">登录</a></li>
        <?php endif ?>
        <li><a href="<?= SITE_URL . 'admin'?>">管理</a></li>
    </ul>
</div>
<?php } ?>
