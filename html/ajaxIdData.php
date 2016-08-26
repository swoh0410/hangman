<?php
require_once '../includes/session.php'; 
require_once 'game_function.php';
require_once 'stat_db.php';
require_once 'SessionInfo.php';
start_session();

$id_data = array();

$user_id = get_user_ids();
if (intval(get_winner_position()) === 1){
	$id_data['winner'] = get_user_name_from_user_id ($user_id[0]);
	$id_data['loser'] = get_user_name_from_user_id ($user_id[1]);
} else if (intval(get_winner_position()) === 2){
	$id_data['winner'] = get_user_name_from_user_id ($user_id[1]);
	$id_data['loser'] = get_user_name_from_user_id ($user_id[0]);
}
$id_data['user_1'] = get_user_name_from_user_id ($user_id[0]);
$id_data['user_2'] = get_user_name_from_user_id ($user_id[1]);
$id_data['user_1_rate'] = get_stats($user_id[0]);
$id_data['user_2_rate'] = get_stats($user_id[1]);
echo json_encode($id_data);