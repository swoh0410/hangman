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
//$data['wrong'] = $infoDto->getWrong();
$data['wrong'] = array('a', 'b');
$data['mode'] = $infoDto->getMode();
$data['status'] = $infoDto->getGamingStatus();
$data['user_id'] = $infoDto->getId();
echo json_encode($data);
