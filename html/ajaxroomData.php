<?php
	require_once '../includes/session.php'; 
	require_once 'game_function.php';
	require_once 'SessionInfo.php';
	start_session();
		
	$room_number = $_GET['room_num'];
	$room = waiting_from_room ($room_number);
	echo $room;

	











