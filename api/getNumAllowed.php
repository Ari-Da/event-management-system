<?php
$id = $_REQUEST["id"];
$max = 1000;

if($id != "0") {
	$max = Venue::getMaxCapacity($id)->getCapacity();
}

echo $max;