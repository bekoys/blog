<?php
#header.php
if (! isset ( $page_title )) {
    $page_title = SITE_TITLE;
}
//require View::getView('module');
require View::getView('module');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $page_title; ?></title>
    <link href="<?= TEMPLATE_URL . "images/favicon-16.ico"?>" rel="shortcut icon" type='image/vnd.microsoft.icon' />
    <link href="<?= SITE_URL . 'includes/bootstrap/css/bootstrap.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?= TEMPLATE_URL . "style.css"?>" rel="stylesheet" type="text/css" />
    <link href="<?= SITE_URL . 'css/google-code-prettify/' ?>prettify-desert.css" type="text/css" rel="stylesheet"/>
</head>
<body class="post">
    <div class="header">
        <div id="logo">
            <h1><?= SITE_TITLE ?></h1>
            <h2>-- Great just isn't good enough</h2>
        </div>
        <!-- blog_name end -->
        <p id="back-to-top">
            <a href="#top"><span></span></a>
        </p>
        <?= widget_navibar(); ?>
    </div>
    <!-- header end -->

    <div id="content">
