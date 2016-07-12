<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<p>
<?php
	require_once '../includes/session.php'; 
	require_once 'game_function.php';
	//start_session();
	$_SESSION['gaming_status'] = get_game_status();
	echo $_SESSION['gaming_status'];
	
?>

<?php		
	$displayAnswer = implode($_SESSION['correct_answer'], ' ');
	echo $displayAnswer.'<br><br>';
	//$c = implode($_SESSION['current'], ' ');
	//echo $c.'<br><br>';
	//if(isset($_SESSION['wrong'])){
	
?>
</p>
<?php 
	// 현재의 상태 - 이 값을 통해서 화면을 표시하면 됨.
	//$_SESSION['mode'] = 'waiting';
	//$_SESSION['mode'] = 'solo_game';
	//$_SESSION['mode'] = 'dual_game';
	//$_SESSION['mode'] = 'dual_game';
	//$_SESSION['mode'] = 'game_end';
	$correct_answer = $_SESSION ['correct_answer']; // ex) ('a', 'p', 'p', 'l', 'e')
	$current = $_SESSION ['current'];  // ex) ('a', ' ', ' ', 'l', ' ')
	$wrong = $_SESSION['wrong'];  // ex) ('b', 't')
	//$turn = $_SESSION['turn']; // 0이면 내 turn, 1이면 상대방 turn
	$turn = 0;
	$win = true;
	//$wrong_input = array('e','p','a','q','j','p','a','q','j'); // 연습용
	

	if ($_SESSION['mode'] === 'dual_game'){ //game_start로 상태 바꿈.
		if ($_SESSION['gaming_status'] === 'waiting') {
?>		

	<div id="panel_wrap">
		<div class="game_panel">
			<ul class="user_info">
				<li class="user_1">USER: <?php echo $_SESSION['id']; ?></li>
				<li class="user_2">상대 PLAYER를 기다리는 중입니다.</li>
			</ul>
			<div class="panel_box">
				<div class="game_waiting">
				상대 PLAYER를 기다리는 중입니다.
			</div>
		</div>
	</div>
<?php	}else if ($_SESSION['gaming_status'] === 'my_turn' || 
					$_SESSION['gaming_status'] === 'enemy_turn'){
?>
		<div id="panel_wrap">
		<div class="game_panel">
			<ul class="user_info">
				<li class="user_1">USER: <?php echo get_user_ids()[0]; ?></li>
				<li class="user_2">USER: <?php echo get_user_ids()[1]; ?></li>
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
							if ($_SESSION['gaming_status'] === 'my_turn') {
								printf ("<li><input type='text' name='user_input' size='35' autofocus></li> ");
								printf ("<li><input type='submit' value='Entre'></li>");
							} else {
								printf ("<li><input type='text' name='user_input' size='35' autofocus disabled></li> ");
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
				if(count($_SESSION['wrong']) === 1){
					echo $_SESSION['wrong'][0];
				}else if(count($_SESSION['wrong']) > 1){
					$c = implode($_SESSION['wrong'], ' ');
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
		}else  if($_SESSION['gaming_status'] === 'game_end') {
		
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
			if ($win === true) {
?>
			
				PLAYER 1 <span class="game_win">WIN</span> vs PLAYER 2 <span class="game_lose">LOSE</span>
			
<?php
			} else if ($win === false) {
?>
				PLAYER 1 <span class="game_lose">LOSE</span> vs PLAYER 2 <span class="game_win">WIN</span>
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
				if(count($_SESSION['wrong']) === 1){
					echo $_SESSION['wrong'][0];
				}else if(count($_SESSION['wrong']) > 1){
					$c = implode($_SESSION['wrong'], ' ');
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
		}
	
	} else if ($_SESSION['mode'] === 'solo_game') {
?>
	<div id="panel_wrap">
		<div class="game_panel">
			<ul class="user_info_solo">
				<li>USER: <?php echo $_SESSION['id']; ?></li>
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
						if ($turn === 0) {
							printf ("<ul>");
							printf ("<li><input type='text' name='user_input' size='35' autofocus></li> ");
							printf ("<li><input type='submit' value='Entre'></li>");
							printf ("</ul>");
						} else {
							printf ("<ul>");
							printf ("<li><input type='text' name='user_input' size='35' autofocus disabled></li> ");
							printf ("<li><input type='submit' value='Entre' disabled></li>");
							printf ("</ul>");
							echo '<p>상대 PLAYER 차례입니다.</p>';
						}
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
				if(count($_SESSION['wrong']) === 1){
					echo $_SESSION['wrong'][0];
				}else if(count($_SESSION['wrong']) > 1){
					$c = implode($_SESSION['wrong'], ' ');
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
		} 
?>
</div>
</body>
<html>