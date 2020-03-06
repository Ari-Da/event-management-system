<?php
	if(!isset($_SESSION['user'])) {
		header("Location: " . HTTP_URL . "index.php");
	}

	include 'templates/nav.php';
	include 'templates/edit_event.php';
	include 'templates/add_event.php';
	include 'templates/add_session.html';

	switch($role) {
		case 1: //Admin
		case 4: $events = Event::getAllEvents(); // Super admin
				break;
		case 2: $manager_events = new Manager_event(); // Manager
				$manager_events->setManager($_SESSION['user']['id']);
				$events = $manager_events->getEvents();
				break;

		default: $events = array();
	}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Manage events/sessions/attendees</title>
</head>

<body>
	<?php 
		getMessage();
	?>
	<div class="table-responsive">
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col"></th>
		      <th scope="col">Name</th>
		      <th scope="col">Start date</th>
		      <th scope="col">End date</th>
		      <th scope="col">Number of participants</th>
		      <th scope="col">Venue</th>
		      <th scope="col"></th>
		      <th scope="col" colspan="2"><button type="button" class="btn btn-warning" data-type="event" data-toggle="modal" data-target="#addEvent">Add an Event</button></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($events) > 0) {
		  		foreach($events as $event) { 
		  			if($role == 2) {
			  			$info = new Event();
			  			$info->setIdEvent($event->getEvent());
			  			$info = $info->getEvent();
			  		}
			  		else {
			  			$info = $event;
			  		}
		  			
		  			$venue = new Venue();
		  			$venue->setIdVenue($info->getVenueId());
		  			$venueName = $venue->getVenue()->getName();
		  			$sessions = $info->getSessions();
		  	?>
		  	<thead>
			    <tr class="table-warning">
			      <th>
			      	<button type="button" class="btn btn-warning icon" data-toggle="modal" data-target="#addSession" data-event="<?=$info->getIdEvent() ?>" data-max="<?=$info->getNumberallowed() ?>" data-name="<?=$info->getName() ?>">
			      		<i class="fas fa-plus-square fa-lg"></i>
			      	</button>
			      </th>

			      <th><?=$info->getName() ?></th>
			      <th><?=$info->getDateStart() ?></th>
			      <th><?=$info->getDateEnd() ?></th>
			      <th><?=$info->getNumberallowed() ?></th>
			      <th><?=$venueName ?></th>

			      <th>
			      	<button type="button" class="btn btn-warning icon" onclick="loadAttendeeModal(<?=$info->getIdEvent()?>,'event')">
			      		<i class="fas fa-users fa-lg"></i>
			      	</button>
			      </th>

			      <th>
			      	<button type="button" class="btn btn-warning icon" data-toggle="modal" data-type="event" data-target="#editEvent" data-details="<?=$info->toArray() ?>">
			      		<i class="fas fa-edit fa-lg"></i>
			      	</button>
			      </th>		 

			      <th>
			      	<form method="post" action="delete_event.php?type=event">
			      		<input type="hidden" name="id" value="<?=$info->getIdEvent() ?>" />
			      		<button type="submit" class="btn btn-warning icon">
			      			<i class="fas fa-trash-alt fa-lg"></i>
			      		</button>
			      	</form>
			      </th>

			      
			    </tr>
			 </thead>
			<?php 
				if(count($sessions) > 0) {
					foreach($sessions as $session) {
			?>
		    <tr class="sub">
		      <td></td>
		      <td><?=$session->getName() ?></td>
		      <td><?=$session->getStartdate() ?></td>
		      <td><?=$session->getEnddate() ?></td>
		      <td><?=$session->getNumberallowed() ?></td>
		      <td></td>

		       <td>
		      	<button type="button" class="btn btn-warning icon" onclick="loadAttendeeModal(<?=$session->getIdSession()?>,'session')">
		      		<i class="fas fa-users fa-lg"></i>
		      	</button>
		      </td>

		      <td>
		      	<button type="button" class="btn btn-warning icon" data-toggle="modal" data-type="session" data-target="#editEvent" data-details="<?=$session->toArray() ?>">
		      		<i class="fas fa-edit fa-lg"></i>
		      	</button>
		      </td>

		      <td>
		      	<form method="post" action="delete_event.php?type=session">
		      		<input type="hidden" name="id" value="<?=$session->getIdSession() ?>" />
		      		<button type="submit" class="btn btn-warning icon">
		      			<i class="fas fa-trash-alt fa-lg"></i>
		      		</button>
		      	</form>
		      </td>
		    </tr>
			<?php
						} // foreach session
					} // if count session
				}// foreach event 
			} // if count event
			 else {
			 	echo '<tr><td colspan="6"><h3>No events found!</h3></td></tr>';
			 }
			?>
		  </tbody>
		</table>
	</div>


	<div class="modal fade" id="attendees" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	
	    </div>
	  </div>
	</div>

	<script src="../../js/animate.js"></script>
	<script src="../../js/relativePath.js"></script>
	<script src="../../js/loadAttendeeModal.js"></script>

</body>

<?php
include 'templates/footer_manager.html';
?>
