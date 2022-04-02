<?php

$col_width = 4;

include 'nav.php';

?>

</div>
</main><!-- /.container -->

<!-- Footer -->
<footer class="bg-light font-small mt-5">

    <!-- Footer Text -->
    <div class="container text-center text-md-left py-5">
        <div class="row">

            <div class="col-md-<?= $col_width ?>">
                <h5>Pages list</h5>
                <ul class="list-unstyled">
                    <?= nav_menu($main_menu); ?>
                </ul>
            </div>

            <div class="col-md-4">
                <h5>Admin</h5>
                <ul class="list-unstyled">
                    <?php require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions/admin_dashboard.php') ?>
                    <?php foreach (admin_dashboard_tiles() as $tile) : ?>
                        <?= admin_menu_item('admin/' . $tile['link'], $tile['header'] . ': ' . $tile['title']) ?>
                    <?php endforeach ?>
                </ul>
                <?= foo_newsletter("</div><div class='col-md-$col_width'>", '') ?>
                <h5>Stats</h5>
                <ul class="list-unstyled">
                    <li>
                        <?php
                        require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions/counters.php');
                        counter_page_views_increment('total');
                        counter_page_views_increment(date("Y-m-d"));
                        ?>
                        <!-- // Display counter snipet -->
                        <b><?= counter_page_views_int('total') ?></b> page view<?php if (counter_page_views_int('total') > 1) : ?>s<?php endif; ?>
                    </li>
                </ul>
            </div>

            <?= foo_newsletter('<div style="display: none">', '') ?>
            <div class="col-md-<?= $col_width ?>">
                <h5>Newsletter</h5>
                <small class="form-text text-muted mb-2">Get awsome discounts and unique recipes straight into your inbox! (We hate spam as much as you do)</small>
                <form action="pages/newsletter.php" method="POST">
                    <div class="form-row mb-2">
                        <div class="col">
                            <input type="text" class="form-control" name="firstname" placeholder="Firstname">
                        </div>
                        <div class="col">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
            <?= foo_newsletter('</div>', '') ?>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</html>