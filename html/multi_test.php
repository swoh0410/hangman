<?php
	require_once '../includes/session.php';
	require_once 'test.php';
	
	function start_game() {
		//빈자리가 있는 방 찾기
		$conn = get_connection();
		$room_query = sprintf("SELECT game_room_id FROM game_room WHERE user2_id is NULL;");
		$result = mysqli_query ($conn, $room_query);
		if (mysqli_num_rows($result) > 0) {//대기자가 있는 경우
			$row = mysqli_fetch_assoc($result);
			$room = $row['game_room_id']; //방번호
			$user2_query = sprintf ("UPDATE game_room SET user2_id=%d WHERE game_room_id=%d;", get_user_id_from_user_name($_SESSION['id']), $room);
			//맞는 방번호에 user2_id 업데이트
			mysqli_query ($conn, $user2_query);
			//echo '조인';
		} else {//없는경우 방생성
			reset_correct_answer(); //단어 생성하기
			$answer = implode($_SESSION['correct_answer'], ' '); //answer 변수 지정
			$current = implode($_SESSION ['current'], ' '); //current 변수지정
			$create_query = sprintf("INSERT INTO game_room (answer, current, user1_id) VALUES ('%s', '%s', %d);", $answer, $current, get_user_id_from_user_name($_SESSION['id']));
			//game_room테이블에 answer, current, user1_id INSERT
			mysqli_query($conn, $create_query);
			//echo '방생성';
		}
		mysqli_close($conn);
	}

	function get_user_id_from_user_name ($user_name) {//유저 네임으로  pk 찾기	
		$conn = get_connection();
		$id_query = sprintf("SELECT user_account_id FROM user_account WHERE id='%s';", $user_name);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc($result);
		$id = $row['user_account_id'];
		mysqli_close($conn);
		return ($id);
	}
	
	//start_game();
?>