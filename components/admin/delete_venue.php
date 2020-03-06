<?php

$id = intval($_POST['id']);

$venue = new Venue();
$venue->setIdVenue($id);

if($venue->delete()) {
	header('Location: venues.php?success=delete');
}
else {
	header('Location: venues.php?error=delete');
}