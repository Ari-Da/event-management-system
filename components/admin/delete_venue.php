<?php
$params = array('id'=>'int');
$path = 'venues.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$id = intval($_POST['id']);

$venue = new Venue();
$venue->setIdVenue($id);

if($venue->delete()) {
	header('Location: ' . $path . '?success=delete');
}
else {
	header('Location: ' . $path . '?error=delete');
}