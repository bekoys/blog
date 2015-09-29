<div id="admin-table">
    <div class="span10">
        <h2>文章管理</h2>
        <table class="table table-hover">
            <thead>
            <tr class="table-head">
                <th class="span1"><input type="checkbox" id="select-all" /></th>
                <th><a href="<?= SITE_URL. "admin/admin_log.php?orderby=title&order=$order" ?>">名称</a></th>
                <th>分类</th>
                <th><a href="<?= SITE_URL. "admin/admin_log.php?orderby=date&order=$order" ?>">日期</a></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post):
                $edit_url = SITE_URL . 'admin/write_log.php?pageid='. $post['post_id']. '&action=edit'; ?>
                <tr>
                    <td><input type="checkbox" class="select-one" /> </td>
                    <td><a href="<?= $edit_url ?>" target="_blank"><?= $post['post_title'] ?></a></td>
                    <td><a href="<?= SITE_URL . 'admin/admin_log.php?term_id='. $post['term_id'] ?>"><?= $post['term_name'] ?></a></td>
                    <td><?= $post['post_date'] ?></td>
                    <td>
                        <a class="admin-btn-edit btn-small" href="<?= $edit_url ?>">编辑</a>
                        <a class="text-danger admin-btn-delete btn-small" href="" >删除</a>
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

<script type="text/javascript">
    $(function(){
        // delete one
        $("a.admin-btn-delete").click(function(){
            var $tr = $(this).closest("tr");
            var href = $tr.find("td:eq(1) a").attr("href");
            var post_id = href.match(/pageid=(\d+)/)[1];
 /* 			var test = "<?= SITE_URL . 'admin/admin_delete.php?post_id=' ?>"+ post_id;
			document.write(test);
			alert (test);   */
			
            $.get("<?= SITE_URL . 'admin/admin_delete.php?post_id=' ?>" + post_id, function(data){
                $tr.hide("normal");
				alert("Data Loaded: " + data);
            });

            return false;
        });

        // select-all btn
        $("#select-all").click(function () {
            var checks = $("table").find("input.select-one");
            checks.each(function(){
                this.checked = !this.checked;
            });
        });

        // delete selected
        $("#delete-selected").click(function(){
            var $checked = $("table").find("input.select-one:checked");
            var post_ids = [];
            $checked.each(function(){
                var $tr = $(this).closest("tr");
                var href = $tr.find("td:eq(1) a").attr("href");
                var post_id = href.match(/pageid=(\d+)/)[1];
                post_ids.push(post_id);
            });

            $.get("<?= SITE_URL . 'admin/admin_delete.php?post_ids=' ?>" + post_ids.join(), function(){
                $checked.each(function(){
                    var $tr = $(this).closest("tr");
                    $tr.hide("normal");
                });
            });

            return false;
        });
    });

</script>
