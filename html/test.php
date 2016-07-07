<?php
	require_once '../includes/lib.php';
	require_once '../includes/session.php';
	start_session();
	
	if (!(isset ($_SESSION['correct_answer']))){ //처음 들어옴
		$_SESSION['correct_answer'] = str_split(get_random_word ()); //(a,p,p,l,e)
		$_SESSION['current'] = create_empty_array (count($_SESSION['correct_answer'])); 
		//(0,0,0,0,0)	
				//print_r ($_SESSION['current']);
	}
	
	if (isset($_POST['user_input'])){
		$user_input = $_POST['user_input'];
		$result = check_character ($_SESSION['correct_answer'], 
			$user_input, $_SESSION['current']);
		$_SESSION['current'] = $result;
		
		$a = implode($_SESSION['current'], ' ');
		echo $a;
	} 
	
	function get_random_word () {
		$conn = get_connection ();
		$get_word = "SELECT word FROM vocabulary ORDER BY rand() LIMIT 1";
		$data = mysqli_query ($conn, $get_word);
		if ($data === false) {
			echo mysqli_error($conn);
			die;
		}	
		$row = mysqli_fetch_assoc($data);
		$word = $row['word'];
		mysqli_close($conn);
		return $word;
	}

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
<form action="test.php" method="post">
<input type="text" name="user_input">
<input type="submit" value="제출">
<form>