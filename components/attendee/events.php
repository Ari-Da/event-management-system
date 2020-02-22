<?php
	if(!isset($_SESSION['user'])) {
		header('Location: /index.php');
	}

	include 'templates/nav.php';
	include 'templates/event_modal.html';
	include 'utilities.php'; 

	$e = new Event();
	$events = $e->getAllEvents();

	$attendee = new Attendee();
	$attendee->setIdAttendee($_SESSION['user']['id']);
	$attendee_events = $attendee->getEvents();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Events</title>

	<script>
		$(function() {
			$('h5.card-title').hover(
			  function() {
			    $(this).parent().parent().addClass('shadow-lg');
			  }, function() {
			    $(this).parent().parent().removeClass('shadow-lg');
			  }
			);
		});
	</script>
</head>

<body>
	<div class="container">
		<?php for ($i = 0; $i < count($events); $i++) { 
	  		if($i == 0) { ?>
		<div class="card-deck">
			<?php } else if($i % 3 == 0) { ?>
		</div>
		<div class="card-deck">
			<?php } 
				$event_registered = false;
				foreach($attendee_events as $event) {
					if($event->getEvent() == intval($events[$i]->getIdEvent())) {
						$event_registered = true;
					}
				}
			?>
			<div class="card border-dark mb-3">
				<div class="card-header">
					<h5 class="card-title" data-toggle="modal" data-target="#eventModal" data-details="<?=$events[$i]->toArray() ?>" data-type="event" data-registered="<?=($event_registered) ? 1 : 0 ?>"><?php echo $events[$i]->getName(); ?>
						<span><?=($event_registered) ? '<i class="fas fa-registered"></i>' : '' ?></span>
					</h5>
					<p class="card-text">
						<i class="fas fa-map-marker"></i><?php echo $events[$i]->getVenue()->getName(); ?>
					</p>
					<p class="card-text">
						<i class="fas fa-calendar-alt"></i><?php echo formatDate($events[$i]->getDateStart()) . " - " . formatDate($events[$i]->getDateEnd()); ?>
					</p>
				</div>

				<div class="card-body text-dark">
					<p class="card-text sessions">Sessions</p>
					<ul>
						<?php 
					    	foreach ($events[$i]->getSessions() as $session) {
					    ?>
						<a class="no_underline" data-toggle="modal" data-target="#eventModal" data-details="<?=$session->toArray() ?>" data-type="session" data-registered="0">
							<li class="list-group-item"><?php echo $session->getName(); ?></li>
						</a>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
</body>
