<?php
	require_once '../includes/session.php';
	require_once 'game_function.php';
	start_session();
	
	if(isset($_POST['mode'])){ 
		
		$_SESSION['mode'] = $_POST['mode'];
		if ($_SESSION['mode'] === 'solo_game') { // solo_game 시작을 클릭했을때
			reset_correct_answer();
			
			header("Location: index.php");
		} else if ($_SESSION['mode'] === 'lobby') { //리셋했을때
			
			header("Location: index.php");
		}else if($_SESSION['mode'] === 'dual_game'){ // dual_game 클릭 했을때 
		
			start_dual_game();
				echo '111';
		
			header("Location: index.php");
		}
	}
	
	if (isset($_POST['user_input'])){ //'a'입력시
		$user_input = $_POST['user_input'];
		$result = check_character ($_SESSION['correct_answer'], 
			$user_input, get_current_and_wrong()[0], get_current_and_wrong()[1]);
			// 이사이에 DB에서 current와 wrong이 변경됨
		$_SESSION['current'] = get_current_and_wrong()[0];
		$_SESSION['wrong'] = get_current_and_wrong()[1];
		if (implode($_SESSION['correct_answer'], ' ') === implode($_SESSION['current'], ' ')){
			win_game();
		}
		header("Location: index.php");
	} 
	
	
?>
