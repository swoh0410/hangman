<?php
require_once '../includes/session.php';
require_once 'game_function.php';

function insert_stats() { //이겼을때 stats테이블 insert/update
	$my_id = get_user_ids()[0];
	$enemy_id = get_user_ids()[1];	
	add_stats($my_id, true);
	add_stats($enemy_id, false);	
}

function add_stats($user_id, $is_win) { //이겼을때 stats테이블 insert/update
	$id = $user_id; //id값 지정
	$conn = get_connection ();
	$select_query = sprintf("SELECT COUNT(*) AS num FROM stats WHERE user_account_id=%d;", $id); //유저 id가 테이블에 있는지 확인
	$result = mysqli_query($conn, $select_query);
	$num = mysqli_fetch_assoc($result)['num'];
	if ($is_win === true){
		$match_result = 'win';
	}else {
		$match_result = 'lose';
	}
	 
	if ($num > 0) {// id가 테이블에 있을때
		if ($_SESSION['gaming_status'] === 'win') {
			$update_query = sprintf("UPDATE stats SET total=total+1, %s=%s+1 WHERE 
			user_account_id=%d", $match_result, $match_result, $id); //stats_id가 같은 곳에 total, win update
			mysqli_query($conn, $update_query);			
		} else {
			die('기존 스탯 업테이트 에러');
		}
	} else {//id가 테이블에 없을때
		if ($_SESSION['gaming_status'] === 'win') {
			$insert_query = sprintf("INSERT INTO stats (user_account_id, total, %s) VALUES (%d, 1, 1);", $match_result, $id); //유저 id, total=1, win=1 insert
			mysqli_query($conn, $insert_query);			
		} else {
			//echo $_SESSION['gaming_status'].'<br>';
			die ('신규 스탯 인설트 에러');
		}		
	}
	mysqli_close($conn);
}	





function get_stat_data(){
	$conn = get_connection ();
	$select_query = sprintf('SELECT total, win, lose, win_rate FROM hangman.stats WHERE user_account_id = %d', 29);
	$result = mysqli_query($conn, $select_query);
	$returnValue = array();
	if($result == false) {
		echo 'cannot read stat data from DB!';
		mysqli_error($conn);
	}else{
		while($row = mysqli_fetch_assoc($result)) {
				//print_r($row);
				//echo "gewgwe";
				$returnValue = $row;
		}			
	}
	mysqli_close($conn);
	
	return $returnValue;
}

$stat_array = get_stat_data();
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