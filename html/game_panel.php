<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<?php
	require_once '../includes/session.php'; 
	require_once 'game_function.php';
	//start_session();
	$infoDto = $_SESSION['info_dto'];
	$infoDto->refresh();
	//echo "CURRENT: " . implode("",$infoDto->getCurrent()). "<br>";
	$infoDto->setGamingStatus(get_gaming_status());
	//echo $infoDto->getGamingStatus();
	
?>

<?php		
	$displayAnswer = implode(' ', $infoDto->getCorrectAnswer());
	//echo $displayAnswer.'<br><br>';
	//$c = implode($_SESSION['current'], ' ');
	//echo $c.'<br><br>';
	//if(isset($infoDto->getWrong())){
	
?>

<?php 
	// 현재의 상태 - 이 값을 통해서 화면을 표시하면 됨.
	
	$correct_answer = $infoDto->getCorrectAnswer(); // ex) ('a', 'p', 'p', 'l', 'e')
	$current = $infoDto->getCurrent();  // ex) ('a', ' ', ' ', 'l', ' ')
	$wrong = $infoDto->getWrong();  // ex) ('b', 't')
	//$turn = $_SESSION['turn']; // 0이면 내 turn, 1이면 상대방 turn
	$turn = 0;
	$win = true;
	//$wrong_input = array('e','p','a','q','j','p','a','q','j'); // 연습용
	

	if ($infoDto->getMode() === 'dual_game'){ //game_start로 상태 바꿈.
		if ($infoDto->getGamingStatus() === 'waiting') {
?>		

	<div id="panel_wrap">
		<div class="game_panel">
			<ul class="user_info">
				<li class="user_1">USER: <?php echo $infoDto->getId(); ?></li>
				<li class="user_2">상대 PLAYER를 기다리는 중입니다.</li>
			</ul>
			<div class="panel_box">
				<div class="game_waiting">
				상대 PLAYER를 기다리는 중입니다.
				</div>
			</div>
		</div>
	</div>
<?php	}else if ($infoDto->getGamingStatus() === 'my_turn' || 
					$infoDto->getGamingStatus() === 'enemy_turn'){
?>
		<div id="panel_wrap">
		<div class="game_panel">
			<ul class="user_info">
				<li class="user_1">USER: <?php echo get_user_name_from_user_id (get_user_ids()[0]); ?></li>
				<li class="user_2">USER: <?php echo get_user_name_from_user_id (get_user_ids()[1]); ?></li>
			</ul>
			<div class="panel_box">
				<div class="user_output">
					<ul>
					<?php 
						foreach ($current as $key => $value) {
							echo '<li>';
							echo $value;
							echo '</li>';
						}
					?>
					</ul>
				</div>
				<div class="user_input">
					<form action = "change_mode.php" method = "post">
						<ul>
						<?php

							if ($infoDto->getGamingStatus() === 'my_turn') {
								printf ("<li><input type='text' name='user_input' size='35' autofocus></li> ");

								printf ("<li><input type='submit' value='Entre'></li>");
							} else {
								printf ("<li><input type='text' name='user_input' size='35' autofocus='true' disabled></li> ");
								printf ("<li><input type='submit' value='Entre' disabled></li>");
							}
						?>
						</ul>
					</form>
				</div>
			</div>
		</div>
		<div class="wrong_input">
			<ul>
				<li>틀린답</li>
				<?php		
				echo '<li>';			
					echo implode(' ', $infoDto->getWrong());
				echo '</li>';
				?>
			</ul>
		</div>
		
<?php
		}else if($infoDto->getGamingStatus() === 'win' ||
					$infoDto->getGamingStatus() === 'lose') {					
?>
		<div class="user_output">
			<ul>
			<?php 
				foreach ($current as $key => $value) {
					echo '<li>';
					echo $value;
					echo '</li>';
				}
			?>
			</ul>
		</div>
		<div class="panel_box">
			<div class="game_result">
<?php			
			if ($infoDto->getGamingStatus() === 'win') {
?>			
				<?php echo get_user_name_from_user_id (get_user_ids()[0]); ?> <span class="game_win">WIN</span> vs <?php echo get_user_name_from_user_id (get_user_ids()[1]); ?> <span class="game_lose">LOSE</span>
			
<?php
			} else if ($infoDto->getGamingStatus() === 'lose') {
?>
				<?php echo get_user_name_from_user_id (get_user_ids()[1]); ?> <span class="game_lose">LOSE</span> vs <?php echo get_user_name_from_user_id (get_user_ids()[0]); ?> <span class="game_win">WIN</span>
<?php
			}
?>
			</div>
		</div>
		<div class="wrong_input">
			<ul>
				<li>틀린답</li>
				<?php		
				echo '<li>';			
				if(count($infoDto->getWrong()) === 1){
					echo $infoDto->getWrong()[0];
				}else if(count($infoDto->getWrong()) > 1){
					$c = implode(' ',$infoDto->getWrong());
					echo $c;
				}
				echo '</li>';
				?>
			</ul>
		</div>
		<div class="page_btn">
			<ul>				
				<li>
					<form action="change_mode.php" method="post">
						<input type="hidden" value="lobby" name="mode">
						<input type="submit" value="로비">		
					</form>
				</li>
			</ul>
		</div>
<?php
		}
	
	} else if ($infoDto->getMode() === 'solo_game') {
		if($infoDto->getGamingStatus() === 'my_turn'){
			//echo implode(' ', $infoDto->getCorrectAnswer());
?>
	<div id="panel_wrap">
		<div class="game_panel">
			<ul class="user_info_solo">
				<li class="user_1">USER: <?php echo $infoDto->getId(); ?></li>
			</ul>
			<div class="panel_box">
				<div class="user_output">
					<ul>
					<?php 
						foreach ($current as $key => $value) {
							echo '<li>';
							echo $value;
							echo '</li>';
						}
					?>
					</ul>
				</div>
				<div class="user_input">
					<form action = "change_mode.php" method = "post">
					<?php
							printf ("<ul>");
							printf ("<li><input type='text' name='user_input' size='35' autofocus></li> ");
							printf ("<li><input type='submit' value='Entre'></li>");
							printf ("</ul>");							
						
					?>
					</form>
				</div>
			</div>
		</div>
		<div class="wrong_input">
			<ul>
				<li>틀린답</li>
				<?php		
				echo '<li>';			
				echo implode(' ', $infoDto->getWrong());
				echo '</li>';
				?>
			</ul>
		</div>
		<div class="page_btn">
			<ul>
				<li>
					<form action="change_mode.php" method="post">
						<input type="hidden" value="solo_game" name="mode">
						<input type="submit" value="리셋">		
					</form>
				</li>
				<li>
					<form action="change_mode.php" method="post">
						<input type="hidden" value="lobby" name="mode">
						<input type="submit" value="로비">		
					</form>
				</li>
			</ul>
		</div>
<?php
		} else if ($infoDto->getGamingStatus() === 'end'){
			//여기는 솔로게임이 끝났을때
?>

		<div id="panel_wrap">
			<div class="game_panel">
				<ul class="user_info_solo">
					<li class="user_1">USER: <?php echo $infoDto->getId(); ?></li>
				</ul>
				<div class="panel_box">
					<div class="solo_game_over">
					연습게임이 끝났습니다. 계속 하시겠습니까?
					</div>
				</div>
			</div>
		</div>
		<div class="page_btn">
			<ul>
				<li>
					<form action="change_mode.php" method="post">
						<input type="hidden" value="solo_game" name="mode">
						<input type="submit" value="리셋">		
					</form>
				</li>
				<li>
					<form action="change_mode.php" method="post">
						<input type="hidden" value="lobby" name="mode">
						<input type="submit" value="로비">		
					</form>
				</li>
			</ul>
		</div>

<?php		
		} else{
			die('솔로게임 getGamingStatus 에러');
		}
	} 
?>
</div>
</body>
<html>