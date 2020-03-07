<?php
$params = array('name'=>'str', 'capacity'=>'int');
$path = 'venues.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$venue = new Venue();
$venue->setName($_POST['name']);
$venue->setCapacity($_POST['capacity']);

$newId = $venue->insert();

if($newId > 0) {
	header('Location: ' . $path . '?success=insert');
}
else {
	header('Location: ' . $path . '?error=insert');
}
