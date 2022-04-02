<?php

$rootPath = '../../';
require_once $rootPath . "includes/functions/login.php";
require_once $rootPath . 'class/PDO/BlogPDO.php';
require_once $rootPath . 'class/Blog/BreadcrumbBlog.php';

redirect_if_not_connected($rootPath . 'pages/login.php');

// Start editing

$pt_singular = 'category';
$pt_plural = 'categories';
$main_field = 'name';
$prepare_vars = 'name, description';
$has_upload = false;
$picture_field_name = '';
if(isset($_POST['name'])) {
    $execute_command = [
        // "picture" and "id" lines are automatically added by the script (so don't add them here)
        'name' => $_POST['name'],
        'description' => $_POST['description']
    ];
}
$index_redirection = 'index-cat-auth.php';

// Stop editing

require './parts/edit-queries.php'; // SQL Queries
require './parts/' . strtolower($pt_singular) . '-form.php'; // Form (Edit & Add new)

require $rootPath . 'includes/footer.php';