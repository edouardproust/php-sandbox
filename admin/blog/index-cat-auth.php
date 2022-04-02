<?php
$rootPath = '../../';
$modals_id = $sections = $tables = [];
require_once $rootPath . "includes/functions/login.php";
require_once $rootPath . "class/Blog/PostTypeTable.php";
require_once $rootPath . "class/Blog/BreadcrumbBlog.php";

redirect_if_not_connected($rootPath . 'pages/login.php');

$db_tables = [
    'categories' => [
        'fields' => ['id', 'name'],
        'order_by' => 'id ASC',
        'singular' => 'category',
        'main_field' => 'name',
    ],
    'authors' => [
        'fields' => ['id', 'name'],
        'order_by' => 'id',
        'singular' => 'author',
        'main_field' => 'name',
    ]
];

$index = new PostTypeTable($db_tables, $rootPath);
$index->getPostTypeTable(false);

require '../../includes/footer.php';