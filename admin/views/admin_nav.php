<div id="nestable_wrapper" class="span10">
    <menu id="nestable-menu">
        <button class="btn" type="button" data-action="expand-all">Expand All</button>
        <button class="btn" type="button" data-action="collapse-all">Collapse All</button>
    </menu>

    <div class="cf nestable-lists">
        <div class="dd" id="nestable_not">
            <?= $menu_not_selected ?>
        </div>
        <div class="dd" id="nestable">
            <?= $menu_selected ?>
        </div>
        <div style="clear:both"></div>
    </div>
    <textarea id="nestable-output"></textarea>
    <div id="btn-group-submit">
        <button class="btn" name="save_submit" value="publish">保存</button>
    </div>
</div>

<script src="<?= SITE_URL . 'js/' ?>jquery.nestable.js"></script>
<script>

    $(document).ready(function () {

        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        })
            .on('change', updateOutput);

        // For nestable_not
        $('#nestable_not').nestable({
            group: 1
        })

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));

        $('#nestable-menu').on('click', function (e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        // 保存json字符串
        $("button[name='save_submit']").click(function(){
            var data = $('#nestable-output').val();
            $.post('<?= SITE_URL . 'admin/admin_nav.php'  ?>', {'menu': data}, function(){
                var success_info= "<div class=\"submit-success span6\"><span>保存成功 </span></div>";
                $('#btn-group-submit').append(success_info);
                $('#btn-group-submit .submit-success').hide(5000);
            });
            return false;
        });
    });
</script>
