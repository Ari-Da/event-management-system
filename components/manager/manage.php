<?php
	if(!isset($_SESSION['user'])) {
		header("Location: " . HTTP_URL . "index.php");
	}

	include 'templates/nav.php';
	include 'templates/edit_event.html';
	include 'templates/add_event.html';
	include 'templates/add_session.html';

	$manager_events = new Manager_event();
	$manager_events->setManager($_SESSION['user']['id']);
	$events = $manager_events->getEvents();

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Manage</title>
</head>

<body>
	<?php 
		getMessage();
	?>

	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">Name</th>
	      <th scope="col">Start date</th>
	      <th scope="col">End date</th>
	      <th scope="col">Number of participants</th>
	      <th scope="col">Venue</th>
	      <th scope="col" colspan="2"><button type="button" class="btn btn-warning" data-type="event" data-toggle="modal" data-target="#addEvent">Add an Event</button></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php if(count($events) > 0) {
	  		foreach($events as $event) { 
	  			$e = new Event();
	  			$e->setIdEvent($event->getEvent());
	  			$info = $e->getEvent();
	  			// var_dump($info);
	  			$venue = new Venue();
	  			$venue->setIdVenue($info->getVenueId());
	  			$venueName = $venue->getVenue()->getName();
	  			$sessions = $e->getSessions();
	  	?>
	  	<thead class="thead-light">
		    <tr>
		      <th scope="col"><?=$info->getName() ?><button type="button" class="icon" data-toggle="modal" data-target="#addSession" data-event="<?=$info->getIdEvent() ?>" data-max="<?=$info->getNumberallowed() ?>"><i class="far fa-plus-square fa-lg"></i></button></th>
		      <th scope="col"><?=$info->getDateStart() ?></th>
		      <th scope="col"><?=$info->getDateEnd() ?></th>
		      <th scope="col"><?=$info->getNumberallowed() ?></th>
		      <th scope="col"><?=$venueName ?></th>
		      <th scope="col"><button type="button" class="btn btn-warning" data-toggle="modal" data-type="event" data-target="#editEvent" data-details="<?=$e->toArray() ?>">Edit</button></th>
		      <th scope="col">
		      	<form method="post" action="delete_event.php?type=event">
		      		<input type="hidden" name="id" value="<?=$e->getIdEvent() ?>" />
		      		<button type="submit" class="btn btn-warning">Delete</button>
		      	</form>
		      </th>
		    </tr>
		 </thead>
		<?php 
			if(count($sessions) > 0) {
				foreach($sessions as $session) {
		?>
	    <tr>
	      <th scope="col"><?=$session->getName() ?></th>
	      <th scope="col"><?=$session->getStartdate() ?></th>
	      <th scope="col"><?=$session->getEnddate() ?></th>
	      <th scope="col"><?=$session->getNumberallowed() ?></th>
	      <th scope="col"></th>
	      <th scope="col"><button type="button" class="btn btn-warning" data-toggle="modal" data-type="session" data-target="#editEvent" data-details="<?=$session->toArray() ?>">Edit</button></th>
	      <th scope="col">
	      	<form method="post" action="delete_event.php?type=session">
	      		<input type="hidden" name="id" value="<?=$session->getIdSession() ?>" />
	      		<button type="submit" class="btn btn-warning">Delete</button>
	      	</form>
	      </th>
	    </tr>
		<?php
					}
				}
			} 
		} 
		?>
	  </tbody>
	</table>

	<script src="<?=HTTP_URL ?>js/animate.js"></script>
	<script src="<?=HTTP_URL ?>js/tableTemplate.js"></script>
</body>
