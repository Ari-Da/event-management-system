<?php

include 'templates/banner.php';

if(isset($_POST['login'])) {
	include 'templates/login.html';
}
else if(isset($_POST['signup'])) {
	include 'templates/signup.html';
}


