<?php
$rootPath = '../../';
require_once $rootPath . "includes/functions/login.php";
require_once $rootPath . "class/PDO/BlogPDO.php";

redirect_if_not_connected($rootPath . 'pages/login.php');

if(isset($_GET['type'])) {
    if(isset($_GET['id'])) {
        echo $post_type = $_GET['type'];
        // Update the following line if new post-types created or in case of post-types reordering
            $post_type === "post" ? $post_type_index = 'index.php' : $post_type_index = 'index-cat-auth.php';
        $pdo = new BlogPDO($rootPath . 'data/blog.db');
        $error = null;
        try {
            if(isset($_GET['id'])) {
                $query = $pdo->prepare("DELETE FROM " . $pdo->pluralize($post_type) . " WHERE id = :id");
                $query->execute([
                    'id' => $_GET['id']
                ]);
                header('Location:./' . $post_type_index . '?type=' . $post_type . '&info=del-success');
            } else {
                //header('Location:./' . $post_type_index . '?info=del-noid');
            }
        } catch (PDOException $e) {
            header('Location:./' . $post_type_index . '?type=' . $post_type . '&info=del-error&msg=' . $e->getMessage());
        }
    } else {
        $error_msg = "The" . $post_type . " was not deleted because no " . $post_type . "'s id was given.";
        header('Location:./' . $post_type_index . '?info=del-error&msg=' . $error_msg);
    }
} else {
    $error_msg = "The item was not deleted because of an unknown item type.";
    header('Location:./index.php?info=del-error&msg=' . $error_msg);
}