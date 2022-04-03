<?php
$pictures_folder = $rootPath . 'assets/img/uploads/blog/featured_image/';
require_once $rootPath . 'class/Modals/Modal.php';

?>
<form action="" method="post">
    <div class="row">
        <div class="col col-md-8">
            <p class="lead mb-5">Fields with an asterisk are mandatory.</p>
            <div class="form-group">
                <label>
                    Category name*
                    <small class="small text-muted form-text">1 or 2 words max. are recommended</small>
                </label>
                <input type="text" name="name" class="form-control" required value="<?= isset($postType)? $postType->name : '' ?>">
                </div>
            <div class="form-group">
                <label>
                    Description
                    <div class="small text-muted">A short text that describes the category's content.</div>
                </label>
                <textarea rows="3" class="form-control" name="description"><?= isset($postType->description) ? $postType->description : '' ?></textarea>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="sticky-top pt-4">
                <div class="d-flex mb-5">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>
                        Publish
                    </button>
                    <?php if(empty($_GET['p']) || $_GET['p'] !== 'add'): ?>
                        <?php $modal_delete = new Modal ($pt_singular . '-del-confirm'); ?>
                        <?php $modal_delete->showModalTrigger($postType->id, 
                        '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>',
                        'button', 'btn btn-outline-danger ml-3') ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</form>
<?php if(empty($_GET['p']) || $_GET['p'] !== 'add'): ?>
    <?php $modal_delete->showModal($postType->id, './delete.php?type=' . $pt_singular . '&id=' . $postType->id); ?>
<?php endif; ?>