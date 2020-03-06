<?php

$venue = new Venue();
$venue->setName($_POST['name']);
$venue->setCapacity($_POST['capacity']);

$newId = $venue->insert();

if($newId > 0) {
	header('Location: venues.php?success=insert');
}
else {
	header('Location: venues.php?error=insert');
}
