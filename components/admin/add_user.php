<?php

$user = new Attendee();
$user->setName($_POST['name']);
$user->setPassword($_POST['password']);
$user->setRole($_POST['role']);

$newId = $user->insert(false);

if($newId > 0) {
	header('Location: users.php?success=insert');
}
else {
	header('Location: users.php?error=insert');
}
