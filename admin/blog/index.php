<?php

$rootPath = '../../';
$modals_id = [];
require_once $rootPath . "includes/functions/login.php";
require_once $rootPath . "class/Blog/PostTypeTable.php";
require_once $rootPath . "class/Blog/BreadcrumbBlog.php";

redirect_if_not_connected($rootPath . 'pages/login.php');

$db_tables = [
    'posts' => [
        'fields' => ['id', 'title'],
        'order_by' => 'id DESC',
        'singular' => 'post',
        'main_field' => 'title',
    ],
];

$index = new PostTypeTable($db_tables, $rootPath);
$index->getPostTypeTable();

require $rootPath . 'includes/footer.php';
