<?php
require_once '../includes/session.php'; 
require_once 'game_function.php';
require_once 'SessionInfo.php';
require_once 'logging.php';

start_session();

$infoDto = $_SESSION['info_dto'];
$infoDto->refresh();

if (isset($_POST['action'])){
	if ($_POST['action'] === 'start_dual_game'){
		$infoDto -> start_dual_game2();
	} else if ($_POST['action'] === 'fetch_status'){
		
	} else if ($_POST['action'] === 'play') {
		if(!(isset($_POST['user_input']))) {
			$_POST['user_input'] = '';
		}
		$user_input = $_POST['user_input'];
		//debug_log('char was: '.$user_input);
		$infoDto->play($user_input);	
		//debug_log('finished play');	
		//debug_log('status: '.$infoDto->getGamingStatus());			
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
	$last_turn_change = strtotime(get_last_turn_time());
	$current_time = time();
	$data['time'] = $current_time - $last_turn_change;
	if ($data['time'] > 20) {
		$infoDto -> win_game();
	}
}

echo json_encode($data);
if ($data['status'] == 'win') {
	//debug_log('win: '.json_encode($data));
}

