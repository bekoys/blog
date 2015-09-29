<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>博客管理 | <?= SITE_TITLE ?></title>

    <link href="<?= SITE_URL . "img/favicon-16.ico"?>" rel="shortcut icon" type='image/vnd.microsoft.icon' />
    <!-- Bootstrap core CSS -->
    <link href="<?= SITE_URL . 'includes/bootstrap-2.3.1/css/bootstrap.css' ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL . 'includes/bootstrap-2.3.1/css/docs.css' ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL . 'includes/bootstrap-2.3.1/css/bootstrap-responsive.css' ?>" rel="stylesheet" type="text/css"/>

    <link href="<?= SITE_URL ?>css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template -->
    <link href="<?= ADMIN_VIEW_URL . 'css/admin.css' ?>" rel="stylesheet">

    <script type="text/javascript" src="<?= SITE_URL . "js/jquery-1.10.2.min.js"?>"></script>
    <script type="text/javascript" src="<?= SITE_URL . 'includes/bootstrap/js/bootstrap.min.js' ?>"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>js/jquery-ui-1.10.3.custom.min.js"></script>

</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="navibar-container">
            <div class="">
                <ul class="nav">
                    <li class="">
                        <a href="<?= SITE_URL ?>"><?= SITE_TITLE ?></a>
                    </li>
                    <li class="">
                        <a class="new_post" href="<?= ADMIN_VIEW_URL . '../write_log.php' ?>"> 新建</a>
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <ul class="sf-menu">
                    <li><a href="#" title="">设置</a>
                        <ul>
                            <li><a href="#">编辑个人资料</a>
                            </li>
                            <li><a href="#">注销</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
    <div class="bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav affix-top span2">
            <li class="active"><a href="<?= ADMIN_VIEW_URL . '../admin_log.php' ?>">文章</a></li>
            <li><a href="<?= ADMIN_VIEW_URL . '../admin_term.php' ?>">分类</a></li>
            <li class="dropdown-submenu">
                <a href="#">主题</a>
                <ul class="dropdown-menu">
                    <li><a href="<?= ADMIN_VIEW_URL . '../admin_theme.php' ?>">主题</a></li>
                    <li><a href="<?= ADMIN_VIEW_URL . '../admin_nav.php' ?>">导航</a></li>
                </ul>
            </li>
            <li><a href="<?= ADMIN_VIEW_URL . 'admin_link.php' ?>">收藏链接</a></li>
        </ul>
    </div>