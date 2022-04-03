<?php
$title = "Subscribe to our newsletter";
require '../includes/header.php';

?>

  <p class="lead">Please fill in the form below to register to our newsletter and be updated about our new crazy offers and promotions.</p>
  <div class="row mt-5">
    <div class="col-md-6  mb-5">
      <?= newsletter_submit(); ?>
      <form action="newsletter.php" method="POST">
        <div class="form-group">
          <label for="firstname"><b>Firstname</b></label>
          <input type="text" class="form-control" name="firstname" placeholder="John">
        </div>
        <div class="form-group">
          <label for="email"><b>Email address</b></label>
          <input type="email" class="form-control" name="email" placeholder="johndoe@gmail.com">
          <small id="emailInfo" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </form>
    </div>
    <div class="col-md-6">
      <p><b>Instructions:</b></p>
      <ol>
        <li>We created this form to get users' email adresses</li>
        <li>New contacts (firstname + email) are automatically added to a file on the FTP server</li>
        <li>Each day a new file is created inside the "newsletter" forlder. Files' name will be the actual dat: "yyyy-mm-dd.txt" where "yyyy" is the year, "mm" month's number and "dd" the current day's number.</li>
        <li>For now, we don't check if the user is already registered. So, if a user registers twice, then he/she will be added twice to the list.</li>
      </ol>
    </div>
  </div>

<?php require '../includes/footer.php'; ?>