<?php
$dirname = dirname($_SERVER['SCRIPT_NAME']);
$parts = explode("/", $dirname);
$relative_dir_path = "";

for($i = 0; $i <= 4; $i++) {
	$relative_dir_path .= $parts[$i] . "/";
}

// var_dump($relative_dir_path);

define("HTTP_URL", "http://$_SERVER[HTTP_HOST]" . $relative_dir_path);

spl_autoload_register(function ($class) {
	include "classes/$class.class.php";
});

session_set_cookie_params(4 * 3600);
session_name('user');
session_start();


function startAttendeeSession($a) {
	session_regenerate_id();
	$_SESSION['user']['id'] = $a->getIdAttendee();
	$_SESSION['user']['name'] = $a->getName();
	$_SESSION['user']['role'] = $a->getRole();
}

function getMessage() {
	$info = '';
	if(isset($_GET['error'])) {
		$info = '<p class="info error">Could not ';

		switch($_GET['error']) {
			case 'update': $info .= 'edit'; break;
			case 'delete': $info .= 'delete'; break;
			case 'insert': $info .= 'insert'; break;
		}

		$info .= ' successfully!</p>';
	}
	else if(isset($_GET['success'])) {
		$info = '<p class="info success"> ';

		switch($_GET['success']) {
			case 'update': $info .= 'Editting'; break;
			case 'delete': $info .= 'Deletion'; break;
			case 'insert': $info .= 'Insertion'; break;
		}

		$info .= ' was successful!</p>';
	}

	echo $info;
}

function formatDateForView($date) {
	return date("M j, Y G:i", strtotime($date));
}

function formatDateForDb($date) {
	return date("y-m-d G:i:s", strtotime($date));
}

