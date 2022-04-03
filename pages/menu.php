<?php 
$title = 'Menu';
require '../includes/header.php';
require_once '../data/config.php';

$alert_order = '';
if (!empty($_GET['order'])) {
  $alert_order = <<<HTML
    <div class="alert alert-primary">
      We don't take online orders for now. Come and visit us! Check our opening hours and make a reservation <a href='contact.php'>here</a>.
    </div>
HTML;
}
?>

<p class="lead mb-5">This pizzeria menu was made <b>from a plain text .CSV file</b>. The goal of this exercise was to train on <b>external files reading / writing in PHP</b>. To get this result, the plain content has been filtered and reorder with several PHP procedural functions and then stylized with Bootstrap.</p>
<div class="row">
  <div class="col-md-8 mb-5">
    <h2 class="pb-3">What will you eat today?</h2>
      <?php
      (array)$lines = file(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.csv');
      foreach ($lines as $line) {
        $line = str_getcsv(trim($line, " \t\n\r\0\x0B,"));
        if(count($line) === 1) { ?>
          <hr><h3><?= $line[0] ?></h3><?php
        } else { ?>
          <div class="row">
            <div class="col-md-10">
              <p>
                <b><?= $line[0] ?></b><br>
                <?= $line[1] ?>
              </p>
            </div>
            <div class="col-md-2">
              <b>$<?php echo number_format( end($line), 2, ".", "," ); ?></b>
            </div>
          </div><?php
        }
      }
      ?>
      
    </div>
  <div class="col-md-4">
    <h2 class="pb-3">Made with love</h2>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid pariatur saepe minima eaque in enim. Temporibus sed libero perspiciatis culpa fugit, voluptates ut, explicabo quos rem veritatis aliquam iure vel.</p>
    <?= $alert_order ?>
    <form action='' method='get'>
      <input type="submit" name='order' class="btn btn-primary form-control mt-3" value="Order now" />
    </form>
  </div>
</div>

<?php require '../includes/footer.php'; ?>