<?php

function formatDate($date) {
	return date("M j, Y G:i", strtotime($date));
}