<?php

$id = $_GET['id'];
$type = $_GET['type'];

if($type == 'event') {
	$obj = new Attendee_event();
	$obj->setEvent($id);
}
else if($type == 'session') {
	$obj = new Attendee_session();
	$obj->setSession($id);
}

$obj_attendees = $obj->getAttendees();

$attendees = array(); // holds all the registered attendess for the event

foreach ($obj_attendees as $attendee) {
	$attendees[] = $attendee->getAttendeeDetails()->getIdAttendee();
}

$all_attendees = Attendee::getAllAttendees();

$not_registered = array_filter($all_attendees, function($attendee) use($attendees) {
	return !(in_array($attendee->getIdAttendee(), $attendees));
});

// var_dump($not_registered);
?>

<div class="modal-header">
	<h5 class="modal-title">Add an Attendee</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>

<form method="post" action="add_attendee.php">
  <div class="modal-body">
  	<div class="input-group flex-nowrap">
	  <div class="input-group-prepend">
	  	<label for="attendee" class="input-group-text">Name:</label>
	  </div>
  		<select id="attendee" name="attendee" class="form-control" required>
  			<option value="" selected disabled>Choose an attendee</option>
  		<?php foreach ($not_registered as $add) { ?>
  			<option value="<?=$add->getIdAttendee() ?>"><?=$add->getName() ?></option>
  		<?php } ?>	
  		</select>
	</div>

   <?php if($type == 'event') { ?>
   <div class="input-group flex-nowrap">
	  <div class="input-group-prepend">
	  	<label for="paid" class="input-group-text">Paid:</label>
	  </div>
	  <input type="number" class="form-control" id="paid" name="paid" min="1" required />
    </div>
	<?php } ?>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-warning" name="submitBtn" value="">Add</button>
  </div>
  <input type="hidden" id="id" name="id" value="<?=$id ?>"/>
  <input type="hidden" id="type" name="type" value="<?=$type ?>"/>
 </form>
