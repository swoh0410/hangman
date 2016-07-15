<?php
require_once '../includes/session.php';

function get_data(){
	$conn = get_connection ();
	$select_query = sprintf('SELECT total, win, draw, lose, win_rate FROM hangman.stats WHERE user_account_id = %d', 15);
	$result = mysqli_query($conn, $select_query);
	$returnValue = array();
	if($result == false) {
		echo 'cannot read stat data from DB!';
		mysqli_error($conn);
	}else{
		while($row = mysqli_fetch_assoc($result)) {
				print_r($row);
				$returnValue = $row;
		}			
	}
	mysqli_close($conn);
	
	return $returnValue;
}

$stat_array = get_data();
function set_win_rate($stat_array) {

	$total = $stat_array ['total'];
	$win = $stat_array ['win'];
	$win_rate = ($win / $total) * 100;
	
	$conn = db_connect();
	$query = sprintf("UPDATE hangman.stats SET win_rate = %d WHERE user_account_id = %d", $win_rate, $user_account_id);
	mysqli_query($conn, $query);
	mysqli_close($conn);
}


?>