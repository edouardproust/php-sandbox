<?php

$rootPath = '../';
require_once $rootPath . 'class/Post.php';
require_once $rootPath . 'class/PDO/BlogPDO.php';
require_once $rootPath . 'class/Blog/BreadcrumbBlog.php';

$pictures_folder_root = $rootPath . 'assets/img/';
$featured_images_folder = $pictures_folder_root . 'uploads/blog/featured_image/';
$author_picture_folder = $pictures_folder_root . 'uploads/blog/authors/';

$pdo = new BlogPDO($rootPath . 'data/blog.db');
$error = null;
$isset_author = false;
try {
    $query = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
    $query->execute([
        'id' => $_GET['id']
    ]);
    $query->setFetchMode(PDO::FETCH_CLASS, 'Post');
    $post = $query->fetch();

    if (isset($post->author)) { // retrieve author
        $query = $pdo->query("SELECT name FROM authors WHERE name LIKE '" . $post->author . "'");
        $author = $query->fetch();
        if (!empty($author)) {
            $isset_author = true;
            $query = $pdo->query("SELECT * FROM authors WHERE name = '" . $author->name . "'");
            $author = $query->fetch();
        }
    }
} catch (PDOException $e) {
    $error = 'PDO error: ' . $e->getMessage();
}
empty($error) ? $title = htmlentities($post->title) : $title = "Post";

$bc_post = new BreadcrumbBlog(
    [
        "Blog" => '/blog',
        ucfirst($post->category) => '/blog/index.php?cat=' . Post::cat_name_format($post->category)
    ],
    $title
);

?>

<?php require $rootPath . 'includes/header.php' ?>

<?php if (!empty($error)) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else : ?>
    <div class="pb-3">
        <!-- post header -->
        <?php if (!empty($post->featured_image)) : ?>
            <div class="card text-white border-0">
                <img class="card-img" style="max-height:18rem; object-fit: cover;" src="<?= $featured_images_folder . $post->featured_image ?>" alt="<?= $title ?>" />
                <div class="card-img-overlay d-flex flex-column justify-content-center" style="background-color: #00000060">
                    <div>
                    </div>
                    <div>
                        <h1><?= htmlentities($post->title) ?></h1>
                        <div class="small text-capitalize"><?= isset($post->date) ? $post->getDate('long') : ''  ?> - By <?= isset($post->author) ? ucwords(htmlentities($post->author)) : ''  ?></div>
                        <?php if (isset($post->category)) : ?>
                            <a href="./index.php?cat=<?= Post::cat_name_format($post->category) ?>">
                                <div class="badge bg-light text-dark pb-1 mt-3">
                                    <?= Post::cat_name_format($post->category) ?>
                                </div>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <h1><?= $title ?></h1>
            <div class="small"><?= isset($post->date) ? $post->getDate('long') : ''  ?> - By <?= isset($post->author) ? $post->author : ''  ?></div>
            <hr>
        <?php endif; ?>

        <!-- breadcrumb -->
        <div class="small text-muted my-2"><?= $bc_post->show_breadcrumb() ?></div>
        <hr>

        <div class="mt-4">
            <!-- post content -->
            <p class="lead mt-5"><?= isset($post->introduction) ? htmlentities($post->introduction) : ''  ?></p>
            <div class="my-5">
                <?= isset($post->content) ? nl2br(htmlentities($post->content)) : ''  ?>
            </div>
        </div>
        <div>
            <!-- post footer-->
            <?php if ($isset_author) : ?>
                <hr>
                <div class="card bg-light mt-5" style="max-width: 30rem;">
                    <!-- author box -->
                    <div class="card-header small text-muted text-capitalize">About <?= ucwords(htmlentities($author->name)) ?></div>
                    <div class="media card-body align-items-center">
                        <img class="mr-3" style="border-radius:100%; width: 4rem; height:auto" src="<?= !empty($author->picture) ? $author_picture_folder . $author->picture : $pictures_folder_root . 'avatar-default.png'  ?>" />
                        <div class="media-body">
                            <?= !empty($author->bio) ? htmlentities($author->bio) : 'I am a contributor to the blog. From time to time, i share my expertise with you through an article.' ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>




<?php endif ?>

<?php require $rootPath . 'includes/footer.php' ?>