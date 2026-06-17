<?php
	require_once 'connect.php';
	$data = json_decode(file_get_contents("php://input"));
	$firstname = $data->firstname;
	$lastname = $data->lastname;
	$conn->query("INSERT INTO `member` (firstname, lastname) VALUES('$firstname', '$lastname')") or die(mysqli_error());
?>