<?php
require 'admin_init.php';
login();
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_POST['term_name'])) {
    Category_Model::getInstance()->addTerm($_POST['term_name'], $_POST['term_description']);
} else if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['term_id']) && isset($_POST['inline_save'])) {
    Category_Model::getInstance()->updateTerm($_GET['term_id'], $_POST['term_name'], $_POST['term_description']);
}

require ADMIN_VIEW_PATH . 'header.php';

$terms = Category_Model::getInstance()->getTermsAll();

require ADMIN_VIEW_PATH . 'admin_term.php';
require ADMIN_VIEW_PATH . 'footer.php';

