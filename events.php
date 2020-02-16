<?php

include 'templates/banner.php';
include 'classes/Event.class.php';

$e = new Event();
$events = $e->getAllEvents();

include 'templates/events.html';

?>