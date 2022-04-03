<?php

$pictures_folder = $rootPath . 'assets/img/uploads/blog/featured_image/';
require_once $rootPath . 'class/FileUpload/ImageUploader.php';
require_once $rootPath . 'class/Modals/Modal.php';

// Fill select lists with authors and categories

$pdo = new BlogPDO('../../data/blog.db');
$error = null;
try {
    $query = $pdo->query("SELECT name FROM categories ORDER BY id ASC");
    $categories = $query->fetchAll();
    $query = $pdo->query("SELECT name FROM authors ORDER BY id ASC");
    $authors = $query->fetchAll();
} catch (PDOException $e) {
    $error = $e->getMessage();
}
if (isset($_FILES["fileToUpload"])) {
    $upload_image = new ImageUploader($_FILES["fileToUpload"], $pictures_folder);
    $upload_image->upload_no_check();
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col col-md-8">
            <p class="lead mb-5">Fields with an asterisk are mandatory.</p>
            <div class="form-group">
                <label>
                    Post title*
                    <small class="small text-muted form-text">60 characters max. are recommended</small>
                </label>
                <input type="text" name="title" class="form-control" required value="<?= $isEdit && isset($postType) ? $postType->title : '' ?>">
            </div>
            <div class="form-group">
                <label>
                    Introduction
                    <div class="small text-muted">This text will be displayed in bigger letters than the content</div>
                </label>
                <textarea rows="3" class="form-control" name="introduction"><?= $isEdit && isset($postType->introduction) ? $postType->introduction : '' ?></textarea>
            </div>
            <div class="form-group">
                <label>
                    Content*
                    <div class="small text-muted">HTML not allowed for security purpose</div>
                </label>
                <textarea rows="15" class="form-control" name="content" required><?= $isEdit && isset($postType) ? $postType->content : '' ?></textarea>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="sticky-top pt-4">
                <button type="submit" class="btn btn-primary btn-block mb-3">
                    <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                    </svg>
                    Publish
                </button>
                <div class="d-flex mb-5">
                    <?php if (empty($_GET['p']) || $_GET['p'] !== 'add') : ?>
                        <a class="flex-grow-1 mr-3" href="<?= '/blog/' . $pt_singular . '.php?id=' . $postType->id ?>">
                            <button type="button" class="btn btn-outline-primary w-100">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z" />
                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                                View
                            </button>
                        </a>
                        <?php $modal_delete = new Modal($pt_singular . '-del-confirm'); ?>
                        <?php $modal_delete->showModalTrigger(
                            $postType->id,
                            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                        Delete',
                            'button',
                            'btn btn-outline-danger flex-grow-1'
                        ) ?>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" class="form-control">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->name ?>" <?= $isEdit && isset($postType->category) && $category->name ===  $postType->category ? 'selected' : '' ?>>
                                <?= ucwords($category->name) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Featured image</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
                    <?php if ($isEdit && isset($postType) && !empty($postType->featured_image)) : ?>
                        <div class="mt-2" style="position: relative">
                            <div style="color: white; padding: 5px 10px; background-color: #00000080; position: absolute; right: 0">
                                <label style="margin:0">
                                    <input type="checkbox" name="file-delete" class="mr-1">
                                    Remove file
                                </label>
                            </div>
                        </div>
                        <img src="<?= $pictures_folder . $postType->featured_image ?>" style="width:100%" />
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <select name="author" class="form-control">
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?= $author->name ?>" <?= $isEdit && isset($postType->author) && $postType->author ===  $author->name ? 'selected' : '' ?>>
                                <?= ucwords($author->name) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
<?php if (empty($_GET['p']) || $_GET['p'] !== 'add') : ?>
    <?php $modal_delete->showModal($postType->id, './delete.php?type=' . $pt_singular . '&id=' . $postType->id); ?>
<?php endif;
