<ul id="admin_theme">
    <?php foreach ($themes as $theme): ?>
    <li>
        <a href="<?= SITE_URL . 'admin/admin_theme.php' . "?theme=$theme[name]" ?>" title="<?= $theme['name'] ?>">
            <img src="<?= $theme['thumbnail'] ?>" title="<?= $theme['name'] ?>" <?= $theme['name'] == $cur_theme ? ' class="active"' : '' ?> />
        </a>
        <h4><?= $theme['name'] ?></h4>
    </li>
    <?php endforeach ?>
</ul>