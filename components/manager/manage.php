<?php
	if(!isset($_SESSION['user'])) {
		header("Location: " . HTTP_URL . "index.php");
	}

	include 'templates/nav.php';
	include 'templates/edit_event.html';
	include 'templates/add_event.html';
	// include 'utilities.php'; 

	$me = new Manager_event();
	$me->setManager($_SESSION['user']['id']);
	$events = $me->getEvents();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Manage</title>
</head>

<body>

	<?php 
		$info = '';
		if(isset($_GET['error'])) {
			$info = '<p class="info error">Could not ';

			switch($_GET['error']) {
				case 'update': $info .= 'edit'; break;
				case 'delete': $info .= 'delete'; break;
				case 'insert': $info .= 'insert'; break;
			}

			$info .= ' successfully!</p>';
		}
		else if(isset($_GET['success'])) {
			$info = '<p class="info success"> ';

			switch($_GET['success']) {
				case 'update': $info .= 'Editting'; break;
				case 'delete': $info .= 'Deletion'; break;
				case 'insert': $info .= 'Insertion'; break;
			}

			$info .= ' was successful!</p>';
		}

		echo $info;
	?>

	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">Name</th>
	      <th scope="col">Start date</th>
	      <th scope="col">End date</th>
	      <th scope="col">Number of participants</th>
	      <th scope="col">Venue</th>
	      <th scope="col"></th>
	      <th scope="col"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addEvent">Add</button></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php if(count($events) > 0) {
	  		foreach($events as $event) { 
	  			$e = new Event();
	  			$e->setIdEvent($event->getEvent());
	  			$info = $e->getEvent();
	  			// var_dump($info);
	  	?>
	  	<thead class="thead-light">
		    <tr>
		      <th scope="col"><?=$info->getName() ?></th>
		      <th scope="col"><?=$info->getDateStart() ?></th>
		      <th scope="col"><?=$info->getDateEnd() ?></th>
		      <th scope="col"><?=$info->getNumberallowed() ?></th>
		      <th scope="col"><?=$info->getVenueId() ?></th>
		      <th scope="col"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editEvent" data-details="<?=$e->toArray() ?>">Edit</button></th>
		      <th scope="col">
		      	<form method="post" action="delete_event.php">
		      		<input type="hidden" name="id" value="<?=$e->getIdEvent() ?>" />
		      		<button type="submit" class="btn btn-warning">Delete</button>
		      	</form>
		      </th>
		    </tr>
		 </thead>
		<?php } } ?>
	  </tbody>
	</table>

	<script src="<?=HTTP_URL ?>js/animate.js"></script>
</body>
