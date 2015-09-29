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
<div id="admin_login">
<form class="form-horizontal" action="<?= SITE_URL . 'admin/admin_login.php' ?>" method="post">
    <div class="control-group">
        <label class="control-label" for="inputUser">Email</label>
        <div class="controls">
            <input type="text" name="username" id="inputUser" placeholder="Email">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
            <input type="password" name="password" id="inputPassword" placeholder="Password">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <input name="rememberme" type="checkbox"> Remember me
            </label>
            <button type="submit" name="login_submit" class="btn">Sign in</button>
        </div>
    </div>
</form>
</div>
</body>
</html>