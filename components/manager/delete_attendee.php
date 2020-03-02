<?php

if(isset($_GET['type']) && isset($_GET['event']) && isset($_GET['attendee'])) {
	$attendee = $_GET['attendee'];
	$id = intval($_GET['event']);
	$type = $_GET['type'];

	if($type == 'event') {
		$obj = new Attendee_event();
		$obj->setEvent($id);
		$obj->setAttendee($attendee);
	}
	else if($type == 'session') {
		$obj = new Attendee_session();
		$obj->setSession($id);
		$obj->setAttendee($attendee);
	}

	if($obj != null && $obj->delete()) {
		header('Location: manage.php?success=delete');
	}
	else {
		header('Location: manage.php?error=delete');
	}
} 