<?php
	require_once '../includes/session.php';
	
	function start_game() {
		//빈자리가 있는 방 찾기
		$conn = get_connection();
		$room_query = sprintf("SELECT game_room_id FROM game_room WHERE user2_id is NULL;");
		$result = mysqli_query ($conn, $room_query);
		if (mysqli_num_rows($result) > 0) {//대기자가 있는 경우
			$row = mysqli_fetch_assoc($room);
			$room = $row['game_room_id'];
			$user2_query = sprintf ("UPDATE game_room SET user2_id=%d WHERE game_room_id=%d;", get_user_id_from_user_name($_SESSION['id']), $room)
			mysqli_query ($conn, $user2_query);
		} else {//없는경우
			$create_query = sprintf("INSERT INTO game_room (user1_id) VALUES (%d);", get_user_id_from_user_name($_SESSION['id']))
			mysqli_query($conn, $create_query);			
		}
		mysqli_close($conn);
	}

	function get_user_id_from_user_name ($user_name) {//유저 네임으로  pk 찾기	
		$id_query = sprintf("SELECT user_account_id FROM user_account WHERE id='%s';", $user_name);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc($result);
		$id = $row['user_account_id'];		
		return ($id);
	}

?>