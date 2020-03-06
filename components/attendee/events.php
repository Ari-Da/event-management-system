<?php
	if(!isset($_SESSION['user'])) {
		header("Location: " . HTTP_URL . "index.php");
	}

	include 'templates/nav.php';
	include 'templates/event_modal.html';

	$events = Event::getAllEvents();

	$attendee = new Attendee();
	$attendee->setIdAttendee($_SESSION['user']['id']);
	$attendee_events = $attendee->getEvents();
	$attendee_sessions = $attendee->getSessions();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Events</title>
</head>

<body>
	<div class="container">
		<?php 
		getMessage();

		for ($i = 0; $i < count($events); $i++) { 
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
						<i class="fas fa-calendar-alt"></i><?php echo formatDateForView($events[$i]->getDateStart()) . " - " . formatDateForView($events[$i]->getDateEnd()); ?>
					</p>
				</div>

				<div class="card-body text-dark">
					<p class="card-text sessions">Sessions</p>
					<ul>
						<?php 
					    	foreach ($events[$i]->getSessions() as $session) {
					    		$session_registered = false;
								foreach($attendee_sessions as $s) {
									if($s->getSession() == intval($session->getIdSession())) {
										$session_registered = true;
									}
								}
					    ?>
						<a class="no_underline" data-toggle="modal" data-target="#eventModal" data-details="<?=$session->toArray() ?>" data-type="session" data-registered="<?=($session_registered) ? 1 : 0 ?>">
							<li class="list-group-item"><?=$session->getName() ?>
								<span><?=($session_registered) ? '<i class="fas fa-registered"></i>' : '' ?></span>
							</li>
						</a>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>

	<script src="<?=HTTP_URL ?>js/animate.js"></script>
</body>

<?php
include 'templates/footer_attendee.html';
?>
