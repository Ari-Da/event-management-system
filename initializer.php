<?php
define("HTTP_URL", "http://$_SERVER[HTTP_HOST]/server-dev/projects/Project 1/event-management-system/");

spl_autoload_register(function ($class) {
	include "classes/$class.class.php";
});

session_set_cookie_params(60 * 60);
session_name('user');
session_start();


function startAttendeeSession($a) {
	session_regenerate_id();
	$_SESSION['user']['id'] = $a->getIdAttendee();
	$_SESSION['user']['name'] = $a->getName();
	$_SESSION['user']['role'] = $a->getRole();
}


