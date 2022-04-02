<?php

require_once "../includes/functions/login.php";
redirect_if_not_connected('../pages/login.php');
  
$title = "Analytics";
require_once '../includes/header.php'; 
require_once '../includes/functions/analytics.php'; 
require_once '../includes/functions/counters.php'; // We need to reinclude it (in the footer is too late)
require_once '../class/Blog/BreadcrumbBlog.php';

?>
<p class="lead mb-5">Here are some insights on how many pages has been visited on your website since it was created.</p>

<div class="row">

  <!-- MENU (left) -->

  <div class="col-md-4">
    <div class="list-group mb-4">
      <?php
        for ($year = (int)date('Y'); $year > (int)date('Y') - 5; $year--): ?>
          <a href="?year=<?= $year ?>" class="list-group-item list-group-item-action <?= li_active('year', $year) ?>">
            <b><?= $year ?></b>
          </a><?php 
          if ( isset($_GET['year']) && (int)$_GET['year'] === $year ): // List months
            if ($_GET['year'] !== date("Y")): $m = 12; else: $m = date('m'); endif; 
              // If clicked is the current year, then display ONLY past months
            for( $i=$m ; $i>0 ; $i-- ): ?>
              <a href="?year=<?= $year ?>&month=<?= $i ?>" class="pl-4 list-group-item list-group-item-action <?= li_active('month', $i) ?>">
                <?= $breadcrumb[$year][] = date('F',strtotime('01.'.$i.'.2000')); // To list months in letters ?>
              </a><?php 
            endfor;
          endif;
        endfor; ?>
    </div>
  </div>

  <!-- DATA (right) -->

  <div class="col-md-8">
    <div class="card mb-3">

      <!-- Breadcrumb --> 

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <?php $breadcrumb = breadcrumb_dash(); ?>
          <li class="breadcrumb-item active"><?= $breadcrumb['total'] ?></li>
          <?php if (isset($_GET['year'])): ?>
            <li class="breadcrumb-item active"><?= $breadcrumb['year'] ?></li>
          <?php endif; ?>
          <?php if (isset($_GET['month'])): ?>
            <li class="breadcrumb-item active"><?= $breadcrumb['month'] ?></li>
          <?php endif; ?>
        </ol>
      </nav>

      <!-- Card (year & month)--> 

      <div class="card-body">
        <?php if (!isset($_GET['year'])): ?>
          <div class="row">
            <div class="col-sm mb-3">
              <h3><?= counter_sum('total'); ?></h3>Visited pages
            </div>
            <div class="col-sm">
              <h3><?= counter_sum(date("Y-m-d")); ?></h3>Today
            </div>
          </div>
        <?php elseif (!isset($_GET['month'])) : ?>
          <h3><?= counter_sum('year', $_GET['year']) ?></h3>Visited pages
        <?php endif; ?>
        <?php if (isset($_GET['month'])): ?>
          <h3><?= counter_sum('month', $_GET['year'], $_GET['month']) ?></h3>Visited pages
      </div>

    </div>

    <!-- Table (days) -->

    <div class="card">
      <table class="table">
        <thead class="thead-light">
            <tr>
              <th>Day</th>
              <th>Page views</th>
            </tr>
        </thead>
        <tbody>
          <?php if (counter_sum('month', $_GET['year'], $_GET['month']) > 0 ):
            for ($i=0; $i<31; $i++):
                $day_file = $_GET['year'] . '-' . str_pad($_GET['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT); 
                if (file_exists(counter_page_views_db($day_file))): ?>
                  <tr>
                    <td><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></td>
                    <td><?= counter_page_views_int($day_file); ?></td>
                  </tr>
                <?php endif; ?>
            <?php endfor; ?>
          <?php else: ?>
            <tbody>
              <tr>
                <td colspan="2">No data</td>
              </tr>
            </tbody>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php endif; ?>

  </div>
</div>

<?php require '../includes/footer.php'; ?>