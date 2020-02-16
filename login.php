<?php

session_start();

$name = trim($_POST['name']);
$pass = trim($_POST['pass']);

require_once 'PDO.DB.php';

$db = new DB();

$attendee = $db->login($name, $pass);

if($attendee != null) {
	$_SESSION['attendee']['id'] = $attendee->getIdAttend();
	$_SESSION['attendee']['name'] = $attendee->getName();
	$_SESSION['attendee']['role'] = $attendee->getRole();
}
