<?php

	function get_user_id_from_user_name ($user_name) {//유저 네임으로  pk 찾기	
		$conn = get_connection();
		$id_query = sprintf("SELECT user_account_id FROM user_account WHERE id='%s';", $user_name);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc($result);
		$id = intval($row['user_account_id']);
		mysqli_close($conn);
		return ($id);
	}
	
	function get_user_name_from_user_id ($user_id) {//pk로 유저 네임 찾기	
		$conn = get_connection();
		$id_query = sprintf("SELECT id FROM user_account WHERE user_account_id=%d;", $user_id);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		mysqli_close($conn);
		return ($id);
	}
	
	function get_gaming_status() {
		$conn = get_connection();
		$room_query = sprintf("SELECT turn, winner FROM game_room2 WHERE game_room_id=%d;", get_my_game_room_id());
		$result = mysqli_query ($conn, $room_query);
		$row = mysqli_fetch_assoc($result);
		$turn = intval($row['turn']);
		$winner = intval($row['winner']);
		
		if ($winner !== 0){//게임이 끝남
			$my_position = get_my_position();
			if ($winner === $my_position) {
				return 'win';
			} else {
				return 'lose';
			}
		} else {
			if ($turn === 0){
				return 'waiting';//대기중
			} else {//진행
				if (is_my_turn()){
					return 'my_turn';
				} else {
					return 'enemy_turn';
				}
			}
		}
		mysqli_close($conn);
	}
	
	function get_my_position() {
		$conn = get_connection();
		$select_query = sprintf ('SELECT user1_id FROM hangman.game_room2 WHERE game_room_id = %d', get_my_game_room_id());
		$result = mysqli_query($conn, $select_query);
		$row = mysqli_fetch_assoc($result);
		$my_id = intval(get_user_id_from_user_name($_SESSION['info_dto']->getId()));
		if(intval($row['user1_id']) === $my_id){
			return 1;
		} else {
			return 2;
		}
		mysqli_close($conn);
	}
	
	function is_my_turn(){
		$conn = get_connection();
		$my_position = get_my_position();				
		$select_query = sprintf ('SELECT turn FROM hangman.game_room2 WHERE game_room_id= %d', get_my_game_room_id());
		$result = mysqli_query($conn, $select_query);
		
		while(NULL !==($row = mysqli_fetch_assoc($result))) {
			$turn = intval($row['turn']); 
		}		
		mysqli_free_result($result);
		if($my_position === $turn){
			
			$turn = true;
			
		}else{
			$turn = false;
		}
		mysqli_close($conn);
		return $turn;
	}
	
	function get_my_game_room_id() {
		if($_SESSION['info_dto']->getMode() === 'solo_game'){
			
		}else{
			if (null !== $_SESSION['info_dto']->getRoomId()) {
				return $_SESSION['info_dto']->getRoomId();
			} else {
				die('방번호 지정 에러');
			}
		}
	}
	
	function get_user_ids(){
		$conn = get_connection();
		$select_query = sprintf ('SELECT user1_id, user2_id FROM hangman.game_room2 WHERE game_room_id= %d', get_my_game_room_id());
		$result = mysqli_query($conn, $select_query);
		$row = mysqli_fetch_assoc($result);
		mysqli_close($conn);
		return array(intval($row['user1_id']), intval($row['user2_id']));
	}
	
	function get_enemy_id() {
		if (get_user_ids()[0] === get_user_id_from_user_name($_SESSION['id'])){
			return get_user_ids()[1];
		} else {
			return get_user_ids()[0];
		}
		mysqli_close($conn);
	}
	
	function get_winner_position(){
		$conn = get_connection();
		$select_query = sprintf ('SELECT winner FROM hangman.game_room2 WHERE game_room_id= %d', get_my_game_room_id());
		$result = mysqli_query($conn, $select_query);
		$row = mysqli_fetch_assoc($result);
		mysqli_close($conn);
		return intval($row['winner']);
	}
	
		

	
	function get_last_turn_time() {
		$conn = get_connection();
		$select_query = sprintf ('SELECT turn_time FROM hangman.game_room2 WHERE game_room_id= %d', get_my_game_room_id());
		$result = mysqli_query($conn, $select_query);
		$row = mysqli_fetch_assoc($result);
		
		return convert_time_string($row['turn_time']);
	}

	function get_start_button($need_num) {
		for ($i = 1; $i < $need_num + 1; $i++) {
			?>
			<tr>
				<td>
					<span><?php echo $i; ?></span>
				</td>
				<td>
					<form action="change_mode.php" method="post">
						<input type="hidden" value="dual_game" name="mode">
						<input id="<?php echo 'join_btn'.$i; ?>" type="button" value="대기 하기" onclick="joinRoom(<?php echo $i; ?>, this.form)">
					</form>
				</td>
				<td>
					<span id="<?php echo 'waiting'.$i; ?>" class="waiting">대기자 : 없음</span>
				</td>
			</tr>
			<?php
		}
	}
	
	function waiting_from_room ($room_num){
		$conn = get_connection();
		$room_query = sprintf("SELECT user1_id FROM game_room2 WHERE game_room_id = %d;", $room_num);
		$result = mysqli_query ($conn, $room_query);
		if (mysqli_num_rows($result) > 0) {
			return false; //대기자 있음
		} else {
			return true; // 대기자 없음
		}
	}
	
	function get_room_data($room_num) {
		$conn = get_connection();
		$room_query = sprintf("SELECT * FROM game_room2 WHERE game_room_id = %d;", $room_num);
		$result = mysqli_query ($conn, $room_query);
		$room = array();
		$row = mysqli_fetch_assoc($result);
		$room['room_id'] = intval($row['game_room_id']);
		$room['user1_id'] = get_user_name_from_user_id($row['user1_id']);
		$room['user2_id'] = get_user_name_from_user_id($row['user2_id']);
		$room['winner'] = intval($row['winner']);
		return $room;
	}
?>
