<?php

$id = $_POST['id'];
$name = $_POST['name'];
$capacity = $_POST['capacity'];

$venue = new Venue();
$venue->setIdVenue($id);
$venue->setName($name);
$venue->setCapacity($capacity);

if($venue->update()) {
	header('Location: venues.php?success=update');
}
else {
	header('Location: venues.php?error=update');
}