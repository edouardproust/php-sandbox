<?php

$rootPath = '../../';
require_once $rootPath . "includes/functions/login.php";
require_once $rootPath . 'class/PDO/BlogPDO.php';
require_once $rootPath . 'class/Blog/BreadcrumbBlog.php';

redirect_if_not_connected($rootPath . 'pages/login.php');

// Start editing

$pt_singular = 'author';
$pt_plural = 'authors';
$main_field = 'name';
$prepare_vars = 'name, bio';
$has_upload = true;
$picture_field_name = 'picture';
if(isset($_POST['name'], $_POST['bio'])) {
    $execute_command = [
        // "picture" and "id" lines are automatically added by the script (so don't add them here)
        'name' => $_POST['name'],
        'bio' => $_POST['bio']
    ];
}
$index_redirection = 'index-cat-auth.php';

// Stop editing

require './parts/edit-queries.php'; // SQL Queries
require './parts/' . strtolower($pt_singular) . '-form.php'; // Form (Edit & Add new)

require $rootPath . 'includes/footer.php';