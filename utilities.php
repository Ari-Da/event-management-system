<?php

function formatDateForView($date) {
	return date("M j, Y G:i", strtotime($date));
}

function formatDateForDb($date) {
	return date("y-m-d H:i:s", strtotime($date));
}