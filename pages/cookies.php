<?php 

$age = null;
if ($_GET['action'] === "exit") {
  unset($_COOKIE['birthday']);
  setcookie('birthday', '', time() - 10);
}
if (!empty($_POST['birthday'])) {
  setcookie('birthday', $_POST['birthday']);
  $_COOKIE['birthday'] = $_POST['birthday'];
}
if (!empty($_COOKIE['birthday'])) {
  $birthday = (int)$_COOKIE['birthday'];
  $age = (int)date('Y') - $birthday;
}


$title = 'Restricted content';
require '../includes/header.php';
?>

<p class="lead mb-5">This content is reserved to 18 years old and above users.</p>
    <?= $notice ?>
</div>
<div class="row">

  <?php if ($age >= 18): ?>

    <div class="col-md-12">
      <div class="alert alert-success">You are allowed to watch this content.</div>
    </div>
    <div class="col-md-8">
      <h2>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h2>
      <p>Amet consectetur adipisicing elit. Eum accusantium officia esse eaque. Repellendus, vel facilis. Illum culpa perspiciatis quasi vel, voluptatem placeat earum nobis consequuntur repellat, mollitia, porro nisi.</p>
      <p>Consectetur adipisicing elit. Ipsa id earum, laborum exercitationem beatae a hic tempora aspernatur voluptatibus repellendus corrupti culpa natus tempore laudantium placeat ipsum optio. Reiciendis, possimus.</p>
    </div>
    <div class="col-md-4">
      <a href="cookies.php?action=exit">
        <div class="btn btn-danger float-right">Exit restricted area</div>
      </a>
    </div>

  <?php elseif ($age !== null): ?>

      <div class="col-md-12">
        <div class="alert alert-danger">You are to young to acces this content.</div>
      </div>
      <div class="col-md-4">
        <a href="cookies.php?action=exit">
          <div class="btn btn-success">Change my age</div>
        </a>
      </div>
    </div>

  <?php else: ?>

    <div class="col-md-6 mb-5">
      <h2 class="pb-3">Please verify your age</h2>
      <form action='cookies.php' method='POST'>
        <div class="form-group">
          <label for="birthday"><b>When were you born?</b></label>
          <select class="form-control" name="birthday">
            <?php for ( $year = date('Y') - 8; $year > date('Y') - 120; $year-- ): ?>
              <option value="<?= $year ?>" <?php if ($_POST['birthday'] == $year): ?>selected="true"<?php endif ?>>
                  <?= $year ?>
              </option>
            <?php endfor; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
      </form>
    </div>
    <div class="col-md-6">
      <p><b>Why this content is restricted?</b></p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo cum provident at, aspernatur possimus perferendis a dignissimos mollitia repellendus dolor praesentium hic vero ab, quidem culpa sapiente voluptatum ipsam exercitationem.</p>
    </div>

  <?php endif; ?>

</div>

<?php require '../includes/footer.php'; ?>