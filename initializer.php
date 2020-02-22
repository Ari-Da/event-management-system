<?php

spl_autoload_register(function ($class) {
	include "classes/$class.class.php";
});

session_set_cookie_params(2 * 60);
session_name('user');
session_start();