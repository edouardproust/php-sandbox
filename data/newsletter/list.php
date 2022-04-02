<?php
include dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions.php';
?><style>
body { padding: 20px;}
<?php include dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'style.css';
?></style><?php
$newsletter_files = array_diff( scandir(__DIR__), [ '..', '.', '.DS_Store', 'list.php' ] );
?>
<ul>
    <?php foreach ($newsletter_files as $file): 
        $title = date("F j ,Y", strtotime(str_replace('.txt', '', $file)));
        if ($title === date("F j ,Y")) { $title = '<b>Today</b>'; } ?>
        <li><a href="<?= $file ?>"><?= $title ?></li>
    <?php endforeach; ?>
</ul><?php