<?php 
$title = 'Book a table';
require '../includes/header.php';
require_once '../data/config.php';

$reservation_sent = false;
if (!empty($_POST)) {
  $reservation_sent = true;
}
?>

<p class="lead mb-5">You are only one step away from discovering the tastiest pizzas in town.</p>
<div class="row">
  <div class="col-md-4 mb-5">
    <h2 class="pb-3">Opening hours</h2>
     <?php 
      $isOpen = contact_visit(TIMESLOTS);
      contact_visit_alert($isOpen);
      contact_visit_ul(TIMESLOTS, $isOpen);
     ?>
  </div>
  <div class="col-md-8">

    <div class=" mb-5">
      <h2 class="pb-3">Make a reservation</h2>
      <?php if($reservation_sent): ?>
        <div class="alert alert-success">
          Thank you, your reservation has been succesfully made. We can't wait meeting you!<br>
          In case you need to modify or cancel your booking, please call us <b>+1-202-555-0161</b>
        </div>
      <?php endif; ?>

      <form action="" method="post" class="needs-validation">

        <div class="form-row">
          <div class="form-group col">
            <label>Reservation day</label>
            <input type ="date" class="form-control" name="date" required />
            <div class="invalid-feedback">
              Please provide a date for your reservation
            </div>
          </div>
          <div class="form-group col">
            <label>Reservation time</label>
            <input type ="time" class="form-control" name="time" required />
          </div>
          <div class="form-group col">
            <label>Number of seats</label>
            <input type="number" class="form-control" name="guests" placeholder="2" required />
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group col">
            <label>Reservation name</label>
            <input type="text" class="form-control" name="name" placeholder="John Doe" required />
          </div>
          <div class="form-group col">
              <label>Phone number</label>
              <input type="phone" class="form-control" name="phone" placeholder="012-345-678" required />
          </div>
        </div>

        <div class="form-group">
          <label>Message (optionnal)</label>
          <textarea class="form-control" name="message" placeholder="Write us your special needs here"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Book a table</button>
      </form>

    </div>

  </div>
</div>

<?php require '../includes/footer.php'; ?>