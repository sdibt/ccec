<?php
	session_start();
	unset($_SESSION['administrator']);
	session_destroy();
	header("Location: ../index.php");
?>