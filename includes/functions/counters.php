<?php

// page views

function counter_page_views_db($file): string 
{
    $db = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'counter_page-views' . DIRECTORY_SEPARATOR . $file;
    return $db;
}
function counter_page_views_increment($file): void
{
    if (strpos($_SERVER["SCRIPT_NAME"], 'admin/analytics.php') === false) { // Exclude admin pages
        $db = counter_page_views_db($file);
        if (file_exists($db)) {
            $views = (int)file_get_contents($db);
            $views++;
        } else {
            $views = 1;
        }
        file_put_contents($db, $views);
    }
} 
function counter_page_views_int($file): int
{
    $db = counter_page_views_db($file);
    return (int)file_get_contents($db);
}