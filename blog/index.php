<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = 'Blog';
require_once '../class/Post.php';
require_once '../class/PDO/BlogPDO.php';

$images_folder = '../assets/img/uploads/blog/featured_image/';
$pdo = new BlogPDO('../data/blog.db');

$error = null;
$message = null;

// Fletch categories
try {
    $query = $pdo->query("SELECT name FROM categories ORDER BY name");
    $categories = $query->fetchAll();
} catch (PDOException $e) {
    $error = 'PDO error: ' . $e->getMessage();
}

// Posts sorting based on category selection
try {
    if (isset($_GET['cat']) && strtolower($_GET['cat']) !== 'all') {
        $cat = strtolower($_GET['cat']);
        $query = $pdo->query("SELECT id, title, content, date, category, featured_image FROM posts WHERE category LIKE '" . $cat . "' ORDER BY id DESC");
        $query2 = $pdo->query("SELECT description FROM categories WHERE name LIKE '" . $cat . "'");
        $posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');
        $this_category = $query2->fetch();
        if (empty($posts)) {
            $message = "No post yet in this category.";
        }
    } else {
        $query = $pdo->query("SELECT id, title, content, date, category, featured_image FROM posts ORDER BY id DESC");
        $posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');
    }
} catch (PDOException $e) {
    $error = 'PDO error: ' . $e->getMessage();
}
?>

<?php require '../includes/header.php' ?>
<?php if (isset($error)) : ?>
    <div class="alert alert-danger mb-3"><?= $error ?></div>
<?php else : ?>
    <div class="d-flex justify-content-center my-5">
        <a href="index.php?cat=all">
            <button type="button" class="btn btn<?= isset($_GET['cat']) && $_GET['cat'] !== "all" ? '-outline' : '' ?>-primary btn-sm mx-1">All categories</button>
        </a>
        <?php foreach ($categories as $category) : ?>
            <a href="index.php?cat=<?= Post::cat_name_format($category->name) ?>">
                <button type="button" class="btn btn<?= !isset($_GET['cat']) || (isset($_GET['cat']) && $_GET['cat'] !== strtolower($category->name)) ? '-outline' : '' ?>-primary btn-sm mx-1"><?= ucfirst($category->name) ?></button>
            </a>
        <?php endforeach ?>
    </div>
    <?= !empty($this_category->description) ? '<p class="lead text-center mb-5">' . $this_category->description . '</p>' : '' ?>
    <?php if (!empty($message)) : ?>
        <p class="text-center py-5 my-5"><?= $message ?></p>
    <?php else : ?>
        <div class="row">
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <?php
                        $has_featured_image = false;
                        if (!empty($post->featured_image)) :
                            $has_featured_image = true; ?>
                            <a href="post.php?id=<?= $post->id ?>">
                                <img class="card-img-top" style="max-height: 200px; object-fit: cover;" src="<?= $images_folder . $post->featured_image ?>" alt="<?= htmlentities($post->title) ?>">
                            </a>
                        <?php endif ?>
                        <div class="card-body">
                            <a href="post.php?id=<?= $post->id ?>">
                                <h2><?= htmlentities($post->title) ?></h2>
                            </a>
                            <div class="mb-4">
                                <span class="small text-muted">
                                    <?= $post->getDate() ?>
                                </span>
                                <a href="./index.php?cat=<?= Post::cat_name_format($post->category) ?>">
                                    <span class="badge bg-light text-dark pb-1 ml-2"><?= ucfirst(htmlentities($post->category)) ?></span>
                                </a>
                            </div>
                            <?= nl2br(htmlentities($post->getExerpt($has_featured_image))) ?>
                            <div>
                                <a href="post.php?id=<?= $post->id ?>">
                                    <button class="btn btn-primary btn-sm mt-4">Read more</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
<?php endif ?>

<?php require '../includes/footer.php'; ?>
