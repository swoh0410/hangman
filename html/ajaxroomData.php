<?php
	require_once '../includes/session.php'; 
	require_once 'game_function.php';
	require_once 'SessionInfo.php';
	start_session();
	$infoDto = $_SESSION['info_dto'];

	
	$room_num = $_POST['room_num'];
	
	$room_data = array();
	$room_data['mode'] = $infoDto->getMode();
	for ($i = 1; $i < $room_num + 1; $i++){
		$room_data[$i] = get_room_data($i);
		
		if ($room_data[$i]['winner'] > 0){
			$infoDto->clear_room($i, false);
		}
	}
	
	echo json_encode($room_data);
	
	











