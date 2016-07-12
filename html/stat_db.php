<?php
require_once '../includes/session.php';

function get_data(){
	$conn = get_connection ();
	$select_query = sprintf('SELECT total, win, draw, lose, win_rate FROM hangman.stats WHERE user_account_id = %d', 1);
	$result = mysqli_query($conn, $select_query);
	$returnValue = array();
	if($result == false) {
		echo 'cannot read stat data from DB!';
		mysqli_error($conn);
	}else{
		while($row = mysqli_fetch_assoc($result)) {
				print_r($row);
				echo "gewgwe";
				$returnValue = $row;
		}			
	}
	mysqli_close($conn);
	
	return $returnValue;
}

function set_win_rate(){
	
}


?>