<?php
require_once '../includes/session.php'; 
require_once 'game_function.php';
require_once 'SessionInfo.php';
start_session();

$infoDto = $_SESSION['info_dto'];
$infoDto->refresh();

if (isset($_POST['action'])){
	if ($_POST['action'] === 'start_dual_game'){
		$infoDto -> start_dual_game();
	} else if ($_POST['action'] === 'fetch_status'){
		
	} else if ($_POST['action'] === 'play') {
		$user_input = $_POST['user_input'];
		$infoDto->play($user_input);
	}		
}



$data = array();
$data['correct_answer'] = $infoDto->getCorrectAnswer();
$data['current'] = $infoDto->getCurrent();
$data['wrong'] = $infoDto->getWrong();
$data['mode'] = $infoDto->getMode();
$data['status'] = $infoDto->getGamingStatus();
$data['my_id'] = $infoDto->getId();

if ($data['status'] === 'enemy_turn' && $_POST['action'] === 'fetch_status') {
	$last_turn_change = strtotime (get_last_turn_time());
	$current_time = time();
	$data['time'] = $current_time - $last_turn_change;
	if ($data['time'] > 20) {
		$infoDto->win_game();
	}	
}


echo json_encode($data);
