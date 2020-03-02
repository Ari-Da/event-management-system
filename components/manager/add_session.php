<?php

$session = new Session();
$session->setName($_POST['name']);
$session->setDateStart($_POST['start']);
$session->setDateEnd($_POST['end']);
$session->setAllowed($_POST['allowed']);
$session->setEvent($_POST['event']);

$newId = $session->insert();

if($newId > 0) {
	header('Location: manage.php?success=insert');
}
else {
	header('Location: manage.php?error=insert');
}
