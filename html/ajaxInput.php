<?php
require_once '../includes/session.php'; 
require_once 'game_function.php';
require_once 'SessionInfo.php';
start_session();
$infoDto = $_SESSION['info_dto'];

$infoDto->refresh();
$user_input = $_POST['user_input'];
$infoDto->play($user_input);
