<?php
	function get_connection ($host, $user, $pass, $db) {
		$hostname = $host;
		$username =	$user;
		$password = $pass;
		$dbname = $db;
		$conn = mysqli_connect($hostname, $username, $password, $dbname);
		mysqli_query($conn, "SET NAMES 'utf8'");
		return ($conn);
	}
	
	function convert_time_string($time_string_from_db ) {
		$datetime = date_create($time_string_from_db , timezone_open('UTC'));
		$datetime = date_timezone_set($datetime, timezone_open('Asia/Seoul'));
    return date_format($datetime, 'Y-m-d H:i:s');
	}	

?>