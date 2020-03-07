<?php 
$params = array('id'=>'int', 'type'=>'str');
$path = 'manage.php';

sanitize($params, $path, true);
validate($params, $path, true);

// Sanitization and validation complete

$id = intval($_GET['id']);

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
	header('Location: ' . $path . '?success=delete');
}
else {
	header('Location: ' . $path . '?error=delete');
}