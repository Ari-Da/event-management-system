<?php
$params = array('id'=>'int', 'name'=>'str', 'capacity'=>'int');
$path = 'venues.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$id = $_POST['id'];
$name = $_POST['name'];
$capacity = $_POST['capacity'];

$venue = new Venue();
$venue->setIdVenue($id);
$venue->setName($name);
$venue->setCapacity($capacity);

if($venue->update()) {
	header('Location: ' . $path . '?success=update');
}
else {
	header('Location: ' . $path . '?error=update');
}