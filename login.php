<?php

session_start();

$name = trim($_POST['name']);
$pass = trim($_POST['pass']);

include 'classes/Attendee.class.php';

$attendee = new Attendee();
$attendee->setName($name);
$attendee->setPassword($pass);

if($attendee->login()) {
	$_SESSION['attendee']['id'] = $attendee->getIdAttend();
	$_SESSION['attendee']['name'] = $attendee->getName();
	$_SESSION['attendee']['role'] = $attendee->getRole();
}

header('Location: index.php');
