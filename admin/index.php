<?php
require_once '../includes/functions/login.php';
redirect_if_not_connected('../pages/login.php');

require_once '../includes/functions/admin_dashboard.php';

$title = greetings(credentials()['username']);
require '../includes/header.php';

?>

<p class="lead mb-4">What do you want to do?</p>
<div class="row pt-3 pb-3">
    <?php foreach(admin_dashboard_tiles() as $tile): ?>
        <div class="col-sm-3" style="align-items: stretch">
            <a href="<?= $tile['link'] ?>" class="link-unstyled">
                <div class="<?= 'card ' . $tile['color'] . ' mb-3'?>">
                    <div class="card-header small"><?= $tile['header'] ?></div>
                    <div class="card-body" style="display:flex; flex-direction:column; justify-content:space-between">
                        <div>
                            <h5 class="card-title"><?= $tile['title'] ?></h5>
                            <p class="card-text small"><?= $tile['text'] ?></p>
                        </div>
                        <div class="<?= 'btn ' . $tile['btn-color'] . ' btn-block mt-3'?>"><?= $tile['button'] ?></div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach ?>
</div>

<?php require '../includes/footer.php'; ?>