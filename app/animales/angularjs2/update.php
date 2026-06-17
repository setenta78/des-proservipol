<?php
	require_once 'connect.php';
	$data = json_decode(file_get_contents("php://input"));
	$mem_id = $data->mem_id;
	$firstname = $data->firstname;
	$lastname = $data->lastname;
	$conn->query("UPDATE `member` SET `firstname` = '$firstname', `lastname` = '$lastname' WHERE `mem_id` = $mem_id") or die(mysqli_error());
?>