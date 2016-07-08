<?php
	require_once '../includes/session.php';
	start_session();
	//게임 시작시, 사전에서 불러온 단어가 없을때, 단어 선정.
	
	
	if(isset($_POST['status'])){ 
		
		$status = $_POST['status'];
		
		if ($status === 'solo_game') { //게임시작을 클릭했을때
			reset_correct_answer();
			$_SESSION['status'] = $status;
			header("Location: index.php");
		} else if ($status === 'lobby') { //리셋했을때
			$_SESSION['status'] = $status;
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
	
	
	
	
	
	//테스트용
	//$ans = 'apple';

	/*$ans_array= str_split($ans);
	print_r($ans_array);
	foreach ($ans_array as $key => $value) {
		$see = $value;
		$see = '_ ';
		echo $see;
	}*/
	
	
?>
<!--
	<input type = "button" onclick = <?php ?>>
	<form action="test.php" method="post">
	<input type="text" name="user_input">
	<input type="submit" value="제출">
	<form>
-->