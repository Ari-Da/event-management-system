<?php 

$id = intval($_POST['id']);

$type = '';
if(isset($_GET['type']))
	$type = $_GET['type'];

if($type == 'event') {
	$obj = new Event();
	$obj->setIdEvent($id);
}
else if($type == 'session') {
	$obj = new Session();
	$obj->setIdSession($id);
}

if($obj != null && $obj->delete()) {
	header('Location: manage.php?success=delete');
}
else {
	header('Location: manage.php?error=delete');
}