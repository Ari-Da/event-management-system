<?php

session_start();
unset($_SESSION['attendee']);
session_destroy();

header('Location: index.php');

?>