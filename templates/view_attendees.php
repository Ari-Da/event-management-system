<?php

$event = $_GET['event'];
$type = $_GET['type'];
$attendees = array();

if($type == 'event') {
	$obj = new Attendee_event();
	$obj->setEvent($event);
	$attendees = $obj->getAttendeesForEvent();
}
else {

}

?>

<div class="modal-header">
	<h5 class="modal-title">List of attendees</h5>
	<button type="button" class="icon"><i class="fas fa-plus-circle fa-lg"></i></button>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<table class="table">
	  <tbody>
	  	<?php 
	  		if(count($attendees) > 0) {
		  		foreach ($attendees as $attendee) {
		 		 	echo '<tr>';
		 		 	$details = new Attendee_event();
		 		 	$details->setAttendee($attendee->getAttendee());
		 		 	$details = $details->getAttendeeDetails();
	  	?>

	  				<td scope='row'><?=$details->getIdAttendee() ?></td>
	  				<td scope='col'><?=$details->getName() ?></td>

	  				<?php if($type == 'event') { ?>
	  				<td scope='col'>
	  					<button type="button" class="btn btn-warning icon" data-toggle="modal" data-type="event" data-target="#editAttendee" data-details="<?=$details->toArray() ?>">
	  						<i class="fas fa-edit fa-lg"></i>
	  					</button>
	  				</td>
	  				<?php } ?>

	  				<td scope='col'>
				      	<form method="post" action="delete_attendee.php?attendee=<?=$details->getIdAttendee() ?>&event=<?=$event ?>&type=<?=($type == 'event') ? 'event' : 'session' ?>">
				      		<button type="submit" class="btn btn-warning icon">
				      			<i class="fas fa-trash-alt fa-lg"></i>
				      		</button>
				      	</form>
	  				</td>

	  	<?php 
	  				

	 		 	echo '</tr>';
	 		 }
 		 }
 		 else {
 		 	echo '<tr><td><h3>No attendees found!</h3></td></tr>';
 		 }
	  		
	  	?>
	  </tbody>
	</table>
</div>
