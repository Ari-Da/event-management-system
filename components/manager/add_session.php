<?php
$params = array('name'=>'str', 'start'=>'date', 'end'=>'date', 'allowed'=>'int', 'event'=>'int');
$path = 'manage.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$session = new Session();
$session->setName($_POST['name']);
$session->setDateStart($_POST['start']);
$session->setDateEnd($_POST['end']);
$session->setAllowed($_POST['allowed']);
$session->setEvent($_POST['event']);

$newId = $session->insert();

if($newId > 0) {
	header('Location: ' . $path . '?success=insert');
}
else {
	header('Location: ' . $path . '?error=insert');
}
