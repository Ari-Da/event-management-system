<?php

class Session {
	private static $name;
	private static $value;

	public static function initialize() {
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
	}

	public static function setUsername($username) {
		$_SESSION['username'] = $username;
	}
}