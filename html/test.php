<?php
	require_once '../includes/session.php';
	start_session();
	//게임 시작시, 사전에서 불러온 단어가 없을때, 단어 선정.
	
	
	if(isset($_POST['status'])){ 
		
		$status = $_POST['status'];
		
		if ($status === 'solo_game') { //게임시작을 클릭했을때
			get_random_word();
			$_SESSION['status'] = $status;
			$a = implode($_SESSION['current'], ' ');
			echo $a;
			header("Location: index.php?array=$a");
		} else if ($status === 'lobby') { //리셋했을때
			$_SESSION['status'] = $status;
			header("Location: index.php");
		}
	}
	
	if (isset($_POST['user_input'])){ //'a'입력시
		$user_input = $_POST['user_input'];
		$result = check_character ($_SESSION['correct_answer'], 
			$user_input, $_SESSION['current']);
		$_SESSION['current'] = $result;
		
		$a = implode($_SESSION['current'], ' ');
		echo $a;
		header("Location: index.php?array=$a");
	} 
	
	function get_random_word () {//나중에 이름 바꿔야함.
	
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
		$_SESSION['current'] = create_empty_array (count($_SESSION['correct_answer'])); //(_,_,_,_,_)	
	}/*else {
		$a = implode($_SESSION['current'], ' ');
		echo $a;
	}*/
	

	function check_character($ansArray, $character, $unseenArray){ 
	
		foreach($ansArray as $key => $value){
			$char_check_result = $unseenArray;
			if($value === $character){
				$unseenArray[$key] = $character;
				$char_check_result = $unseenArray;
			}
		}
		return $char_check_result;
	}
	
	//(0,0,0,0)
	function create_empty_array ($length){ 
		for($i = 0; $i < $length; $i++){
			$unseenArray[] = '_ ';
		}
		return $unseenArray;
	}
	
	
	
	//테스트용
	//$ans = 'apple';

	/*$ansArray= str_split($ans);
	print_r($ansArray);
	foreach ($ansArray as $key => $value) {
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