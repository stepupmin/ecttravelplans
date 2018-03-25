<?php
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name= $_POST['name'];
	$email= $_POST['email'];
	
	$arrPostData = array();
	$arrPostData['username'] = $username;
	$arrPostData['password'] = $password;
	$arrPostData['name'] = $name;
	$arrPostData['email'] = $email;

	echo $username;
?>