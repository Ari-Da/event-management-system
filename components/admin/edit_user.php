<?php
$params = array('id'=>'int', 'name'=>'str', 'password'=>null, 'role'=>'int');
$path = 'users.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

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
	header('Location: ' . $path . '?success=update');
}
else {
	header('Location: ' . $path . '?error=update');
}

