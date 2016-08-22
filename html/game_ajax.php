<?php
require_once '../includes/session.php'; 
require_once 'SessionInfo.php';
require_once 'game_function.php';
start_session();

echo get_gaming_status();