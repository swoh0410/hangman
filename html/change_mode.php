<?php
	require_once '../includes/session.php';
	require_once 'game_function.php';
		require_once './SessionInfo.php';
	start_session();
	if(isset($_POST['mode'])){ 
		$infoDto = $_SESSION['info_dto'];
		//var_dump($infoDto);
		$infoDto->setMode($_POST['mode']);
		
		if ($infoDto->getMode() === 'solo_game') { // solo_game 시작을 클릭했을때
			reset_correct_answer();
			header("Location: index.php");
		} else if ($infoDto->getMode() === 'lobby') { //리셋했을때
			
			header("Location: index.php");
		}else if($infoDto->getMode() === 'dual_game'){ // dual_game 클릭 했을때 
		
			start_dual_game();
				echo '111';
		
			header("Location: index.php");
		}
	}
	
	$infoDto.refresh();
	if (isset($_POST['user_input'])){ //'a'입력시
		$user_input = $_POST['user_input'];
		$infoDto.play();
	} 
	
	
?>
