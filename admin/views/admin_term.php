<div id="admin-table" xmlns="http://www.w3.org/1999/html">
    <div class="span9">
        <h2>分类管理</h2>
        <table class="table table-hover">
            <thead>
            <tr class="table-head">
                <th class="span1"><input type="checkbox" id="select-all" /></th>
                <th>名称</th>
                <th class="span4">描述</th>
                <th>查看</th>
                <th>文章</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($terms as $term) : ?>
                <tr>
                    <td><input type="checkbox" class="select-one" /> </td>
                    <td><a href=""><?= $term['term_name'] ?></a></td>
                    <td><?= $term['term_description'] ?></td>
                    <td><a href="<?= SITE_URL . 'category.php?term_id=' . $term['term_id'] ?>"><img src="<?= SITE_URL ?>img/open-new-window.gif" /></a></td>
                    <td><a href="<?= SITE_URL . 'admin/admin_log.php?term_id=' . $term['term_id'] ?>">
                            <?= Category_Model::getInstance()->getPostsNumByTerm($term['term_id']) ?></a></td>
                    <td>
                        <a href="" class="admin-btn-edit btn-small">编辑 </a>
                        <a href="" class="text-danger admin-btn-delete btn-small">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="table-bottom-nav">
            <span>选中项：</span><a id="delete-selected" class="text-danger btn-small" href="" >删除</a>
        </div>
    </div>
</div>
<div class="admin_right_bar span3">
    <h3>新建分类</h3>
    <form role="form" id="create_term_form" action="<?= $_SERVER['REQUEST_URI'] . '?action=add' ?>" method="post">
        <div class="form-group">
            <label for="term_name">分类名</label>
            <input type="text" class="form-control" name="term_name" placeholder="Term name">
        </div>
        <div class="form-group">
            <label for="term_description">描述</label>
            <input type="text" class="form-control" name="term_description" placeholder="Term description">
        </div>
        <input name="create_term_btn" type="submit" class="btn btn-default" value="提交" />
    </form>
</div>

<script type="text/javascript">
    $(function(){
        $("a.admin-btn-edit").click(function(){
            var $tr = $(this).closest("tr");
            var href = $tr.find("td:eq(4) a").attr("href");
            var term_id = href.match(/term_id=(\d+)/)[1];
            var term_name = $tr.find("td:eq(1)").text();
            var term_description = $tr.find("td:eq(2)").text();
            var url = top.location.origin + top.location.pathname + '?action=edit&term_id=' + term_id;

            var edit_node_html = '<tr><td colspan="6"><form class="form-horizontal" role="form" action="' + url + '" method="post">'
                + '<div class="form-group">'
                + '<label for="term_name">分类名</label>'
                + '<input type="text" class="form-control" name="term_name" placeholder="Term name" value="' + term_name + '">'
                + '</div>'
                + '<div class="form-group">'
                + '<label for="term_description">描述</label>'
                + '<input type="text" class="form-control" name="term_description" placeholder="Term description" value="' + term_description + '">'
                + '</div>'
                + '<button name="inline_save" type="submit" class="btn btn-default inline_save">保存</button>'
                + '<button type="button" class="btn btn-default inline_cancel">取消</button>'
                + '</form></td></tr>';
            $tr.hide().after(edit_node_html);

            // !!!不要将该事件绑定写到$(function(){})的底层作用域中，因为添加form表单节点后绑定click事件才有效
            $("button.inline_cancel").click(function(e){
                var $node = $(this).closest("tr");
                $node.remove();
                $tr.show('normal');
                e.preventDefault();
            });

            return false;
        });

        /*$("button.inline_save").click(function(e){
            var $form = $(this).closest("form");
            $form.hide('normal');
            e.event.preventDefault();
        });*/



        // select-all btn
        $("#select-all").click(function () {
            var checks = $("table").find("input.select-one");
            checks.each(function(){
                this.checked = !this.checked;
            });
        });

        // delete selected
        $("#delete-selected").click(function(event){
            var $checked = $("table").find("input.select-one:checked");
            var term_ids = [];
            $checked.each(function(){
                var $tr = $(this).closest("tr");
                var href = $tr.find("td:eq(4) a").attr("href");
                var term_id = href.match(/term_id=(\d+)/)[1];
                term_ids.push(term_id);
            });

            $.get("<?= SITE_URL . 'admin/admin_delete.php?term_ids=' ?>" + term_ids.join(), function(){
                $checked.each(function(){
                    var $tr = $(this).closest("tr");
                    $tr.hide("normal");
                });
            });

            event.preventDefault();
        });

        $("a.admin-btn-delete").click(function(){
            var $tr = $(this).closest("tr");
            var href = $tr.find("td:eq(4) a").attr("href");
            var term_id = href.match(/term_id=(\d+)/)[1];

            $.get("<?= SITE_URL . 'admin/admin_delete.php?term_id=' ?>" + term_id, function(){
                $tr.hide("normal");
            });

            return false;
        });
    });

</script>