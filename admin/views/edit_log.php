<!-- 加载文本编辑器插件 -->
<div id="write-log-edit" class="span10">
    <!--发表新文章的表单-->
    <form id="write-log-form" enctype='multipart/form-data' action="<?= $_SERVER['REQUEST_URI'].'#btn-group-submit' ?>" method="post">
        <legend>发布文章</legend>
        <label>
            <input class="span10" type="text" name="post_title" value="<?= isset($post_title) ? $post_title : '' ?>"
                   placeholder="在此输入标题"/>
        </label>

        <!--textarea不在value中嵌入php代码-->
        <div class="container">
            <div class="wmd-panel">
                <div id="wmd-button-bar"></div>
                <textarea name="post_content" class="span10" rows="15" id="wmd-input"><?= isset($post_content) ? $post_content : '' ?></textarea>
            </div>
            <div id="wmd-preview" class="wmd-preview  span10"></div>
        </div>

        <div class="write-log-excerpt">
            <h3>摘要</h3>
            <textarea class="span10" name="post_excerpt" rows="5"
                      placeholder="也可以在文章中加入<！-- more -->标记，其之前的内容会被自动生成为摘要"><?= isset($post_excerpt) ? $post_excerpt : '' ?></textarea>
        </div>

        <label>分类</label>
        <select name="post_term">
            <?php
            $terms = Category_Model::getInstance()->getTermsAll();
            foreach ($terms as $term) :
                $select = ($post_term == $term['term_name']) ? ' selected="selected"' : '';
                ?>
                <option value="<?= $term['term_id'] ?>"<?= $select ?>><?= $term['term_name'] ?></option>
            <?php endforeach ?>
        </select>

        <div id="btn-group-submit">
            <button class="btn" type="submit" name="update_publish" value="save">保存修改</button>
            <button class="btn" type="submit" name="update_draft" value="draft">保存草稿</button>
            <?php echo isset($publish_success_div) ? $publish_success_div : null ?>
        </div>
        <!--避免表单重复提交,产生一个唯一的32字符的字符串-->
        <input type="hidden" name="stamp" value="<?php echo md5(uniqid(rand(), true)); ?>"/>
    </form>
</div>

<script src="PageDown/js/bootstrap-transition.js"></script>
<script src="PageDown/js/bootstrap-modal.js"></script>
<script src="PageDown/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="PageDown/js/Markdown.Converter.js"></script>
<script type="text/javascript" src="PageDown/js/Markdown.Sanitizer.js"></script>
<script type="text/javascript" src="PageDown/js/Markdown.Editor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-group-submit[type="submit"]').click(function () {
            $('#write-log-form').submit();
            return false;
        });
    });
</script>
<script type="text/javascript">
    (function () {
        var converter = Markdown.getSanitizingConverter();
        // 自定义markdown代码块表示方式
        converter.hooks.chain("preBlockGamut", function (text, rbg) {
            return text.replace(/^```.*?\n((?:.*?\n)+?)``` *$/gm, function (whole, inner) {
                return "<pre>" + rbg(inner) + "</pre>\n";
            });
        });

        var editor1 = new Markdown.Editor(converter);
        editor1.run();
    })();
</script>
