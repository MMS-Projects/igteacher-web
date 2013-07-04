<?php
session_start();
if(isset($_GET['lang'])){
	$_SESSION['lang'] = $_GET['lang'];
	header('location: '.$_SERVER['HTTP_REFERER']);
	}
?>