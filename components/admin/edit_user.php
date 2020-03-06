<?php

$id = $_POST['id'];
$name = $_POST['name'];
$pass = $_POST['password'];
$role = $_POST['role'];

$attendee = new Attendee();
$attendee->setIdAttendee($id);
$attendee->setName($name);
$attendee->setRole($role);

if($pass != '') {
	$attendee->setPassword($pass);
}

if($attendee->update()) {
	header('Location: users.php?success=update');
}
else {
	header('Location: users.php?error=update');
}

