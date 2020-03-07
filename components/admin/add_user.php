<?php
$params = array('name'=>'str', 'password'=>null, 'role'=>'int');
$path = 'users.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$user = new Attendee();
$user->setName($_POST['name']);
$user->setPassword($_POST['password']);
$user->setRole($_POST['role']);

$newId = $user->insert(false);

if($newId > 0) {
	header('Location: ' . $path . '?success=insert');
}
else {
	header('Location: ' . $path . '?error=insert');
}
