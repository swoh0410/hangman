<?php
	require_once '../includes/session.php';
	start_session();
	//게임 시작시, 사전에서 불러온 단어가 없을때, 단어 선정.
	
	
	if(isset($_POST['mode'])){ 
		
		$_SESSION['mode'] = $_POST['mode'];
		if ($_SESSION['mode'] === 'solo_game') { // solo_game 시작을 클릭했을때
			reset_correct_answer();
			
			header("Location: index.php");
		} else if ($_SESSION['mode'] === 'lobby') { //리셋했을때
			
			header("Location: index.php");
		}else if($_SESSION['mode'] === 'dual_game'){ // dual_game 클릭 했을때 
			if(start_dual_game()){
				$_SESSION['gaming_status'] = 'waiting';
			}else{
				$_SESSION['gaming_status'] = 'playing';
			}
			header("Location: index.php");
		}
	}
	
	if (isset($_POST['user_input'])){ //'a'입력시
		$user_input = $_POST['user_input'];
		$result = check_character ($_SESSION['correct_answer'], 
			$user_input, $_SESSION['current'],$_SESSION['wrong']);
		$_SESSION['current'] = $result[0];
		$_SESSION['wrong'] = $result[1];
		header("Location: index.php");
	} 
	
	function reset_correct_answer() {
	
		$conn = get_connection ();
		$get_word_query = "SELECT word FROM vocabulary ORDER BY rand() LIMIT 1"; //랜덤으로 단어 하나 불러오는 query.
		$data = mysqli_query ($conn, $get_word_query);
		
		if ($data === false) {
			echo mysqli_error($conn);
			echo "vocabulary DB 에서 데이터를 불러올 수 없습니다.";
			die;
		
		}	
		
		$row = mysqli_fetch_assoc($data);
		$word = $row['word'];
		mysqli_close($conn);
	
	
		$_SESSION['correct_answer'] = str_split($word); //(a,p,p,l,e)
		$current = create_empty_array (count($_SESSION['correct_answer'])); //(_,_,_,_,_)
		
		
		$_SESSION['current'] = $current;
		$_SESSION['wrong'] = array();
			
	}/*else {
		$a = implode($_SESSION['current'], ' ');
		echo $a;
	}*/
	

	function check_character($ans_array, $character, $current, $wrong){ 
		$match_found = false;
		$char_check_result[0] = $current;
		$char_check_result[1] = $wrong;
		foreach($ans_array as $key => $value){
			if($value === $character){
				$current[$key] = $character;
				$char_check_result[0] = $current;
				$match_found = true;
			}
			
		}
		
		if($match_found === false){
			$char_check_result[1][] = $character;
		}
		return $char_check_result;
	}
	
	//(0,0,0,0)
	function create_empty_array ($length){ 
		for($i = 0; $i < $length; $i++){

			$current[] = '';
		}
		return $current;
	}
	
	
	
	function start_dual_game() {
		//빈자리가 있는 방 찾기
		$is_room_created = false;
		$conn = get_connection();
		$room_query = sprintf("SELECT game_room_id FROM game_room WHERE user2_id is NULL;");
		$result = mysqli_query ($conn, $room_query);
		if (mysqli_num_rows($result) > 0) {//대기자가 있는 경우
			$row = mysqli_fetch_assoc($result);
			$room = $row['game_room_id']; //방번호
			$user2_query = sprintf ("UPDATE game_room SET user2_id=%d WHERE game_room_id=%d;", get_user_id_from_user_name($_SESSION['id']), $room);
			//맞는 방번호에 user2_id 업데이트
			mysqli_query ($conn, $user2_query);
			$answer_query = sprintf("SELECT answer, current, wrong FROM game_room WHERE game_room_id=%d;", $room);
			$result = mysqli_query ($conn, $answer_query);
			if($result == false) {
				mysqli_error($conn);
			}	
			while($row = mysqli_fetch_assoc($result)) {
				$_SESSION ['correct_answer'] = explode(' ', $row['answer']);
				$_SESSION ['current'] = explode(' ', $row['current']);
				$_SESSION ['wrong'] = explode(' ', $row['wrong']);
			}			
			//echo '조인';
			$is_room_created = false;
		} else {//없는경우 방생성
			reset_correct_answer(); //단어 생성하기
			$answer = implode($_SESSION['correct_answer'], ' '); //answer 변수 지정
			$current = implode($_SESSION ['current'], ' '); //current 변수지정
			$wrong = implode($_SESSION['wrong'], ' ');
			$create_query = sprintf("INSERT INTO game_room (answer, current, wrong, user1_id) VALUES ('%s', '%s', '%s', %d);", $answer, $current, $wrong, get_user_id_from_user_name($_SESSION['id']));
			//game_room테이블에 answer, current, user1_id INSERT
			mysqli_query($conn, $create_query);
			//echo '방생성';
			$is_room_created = true;
		}
		mysqli_close($conn);
		
		return $is_room_created;
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
	
?>
