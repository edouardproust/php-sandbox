<?php
$title = "Messages from our guests";
require_once '../includes/header.php';
require_once '../class/Message.php';
require_once '../class/GuestBook.php';

$errors = null;
$success = false;
$guestbook = new GuestBook(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
if(isset($_POST['username'], $_POST['message'])) {
  $message = new Message($_POST['username'], $_POST['message'], new Datetime());
  if ($message->isValid()) {
    $guestbook->addMessage($message);
    $success = true; // Display a success message is successfully added to the 'messages' file (as a JSON string)
    $_POST = []; // Empty the form;
  } else {
    $errors = $message->getErrors();
  }
}
$messages = $guestbook->getMessages();
?>

<p class="lead mb-5">This guestbook system has been realized with <b>object oriented</b> PHP.</p>

<div class="row">

<div class="col-md-6 mb-4">
  <h2 class="mb-4">How was your meal with us?</h2>
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">Invalid form</div>
  <?php endif; ?>
  <?php if ($success): ?>
    <div class="alert alert-success">Thank you for your message!</div>
  <?php endif; ?>
  <form action="" method="post">
    <div class="form-group">
      <label>Your name</label>
      <input type="text" name="username" value="<?= isset($_POST['username']) ? htmlentities($_POST['username']) : '' ?>" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"></input>
      <?php if (isset($errors['username'])): ?>
        <div class="invalid-feedback"><?= $errors['username'] ?></div>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <label>Your message</label>
      <textarea name="message" rows="3" class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>"><?= isset($_POST['message']) ? htmlentities($_POST['message']) : '' ?></textarea>      
      <?php if (isset($errors['message'])): ?>
        <div class="invalid-feedback"><?= $errors['message'] ?></div>
      <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Send a thought</button>
  </form>
  </div>

  <div class="col-md-6">
    <h2 class="mb-4">What they think of us</h2>
    <?php if(!empty($messages)): ?>
      <div>
        <?php foreach ($messages as $message): ?>
          <?= $message->toHTML() ?>
        <?php endforeach ?>
      </div>
    <?php else: ?>
      <p>No message yet. Be the first to write one!</p>
    <?php endif; ?>
  </div>

</div>

<?php require '../includes/footer.php'; ?>