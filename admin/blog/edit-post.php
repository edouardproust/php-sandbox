<?php

$rootPath = '../../';
require_once $rootPath . "includes/functions/login.php";
require_once $rootPath . 'class/PDO/BlogPDO.php';
require_once $rootPath . 'class/Blog/BreadcrumbBlog.php';

redirect_if_not_connected($rootPath . 'pages/login.php');

// Start editing

$pt_singular = 'post';
$pt_plural = 'posts';
$main_field = 'title';
$prepare_vars = 'title, introduction, content, date, author, category';
$has_upload = true;
$picture_field_name = 'featured_image';
if(isset($_POST['title'], $_POST['content'])) {
    $execute_command = [
        // "picture" and "id" lines are automatically added by the script (so don't add them here)
        'title' => $_POST['title'],
        'introduction' => $_POST['introduction'],
        'content' => $_POST['content'],
        'date' => time(),
        'author' => $_POST['author'],
        'category' => $_POST['category'],
    ];
}
$index_redirection = 'index.php';

// Stop editing

require './parts/edit-queries.php'; // SQL Queries
require './parts/' . strtolower($pt_singular) . '-form.php'; // Form (Edit & Add new)

require $rootPath . 'includes/footer.php';
