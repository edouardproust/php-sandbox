<?php 
function root_folder_analytics(): string
{
    return $_SERVER["SCRIPT_NAME"];
}    
function li_active(string $period, int $number): string
{
    $active = '';
    if ((int)$_GET[$period] === $number) {
        $active = "active";
    }
    return $active;
}
function counter_sum(string $period, int $year=2000, int $month=1): int
{
    $views = [];
    $month = str_pad($month, 2, '0', STR_PAD_LEFT); // To be sure the month are 2 digits in the filename
    if($period ==='year') {
        $search = "$year-*";
    } elseif($period ==='month') {
        $search = "$year-$month-*";
    } elseif($period === 'total') {
        $search = "*-*-*";
    } else {
        $search = $period;
    }
    foreach (glob("../data/counter_page-views/$search") as $file ) {
        $views[] = (int)file_get_contents($file);
    }
    return (int)array_sum($views);
}
function breadcrumb_dash(): array
{
    $breadcrumb['total'] = '5 last years';
    if (isset($_GET['year'])) {
        $breadcrumb['year'] = $_GET['year'];
    }
    if (isset($_GET['month'])) {
        $breadcrumb['month'] = date('F',strtotime('01.'.$_GET['month'].'.2000'));
    }
    if(isset($_GET['year'])) { 
        $breadcrumb['total'] = "<a href='{$_SERVER["SCRIPT_NAME"]}'>{$breadcrumb['total']}</a>";
    }
    if(isset($_GET['month'])) { 
        $breadcrumb['year'] = "<a href='{$_SERVER["SCRIPT_NAME"]}?year={$breadcrumb['year']}'>{$breadcrumb['year']}</a>";
    }
    return $breadcrumb;
}