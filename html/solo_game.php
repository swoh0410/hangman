<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<p>
<?php 
	
	$b = implode($_SESSION['correct_answer'], ' ');
	echo $b.'<br><br>';
	//$c = implode($_SESSION['current'], ' ');
	//echo $c.'<br><br>';
	//if(isset($_SESSION['wrong'])){
	
?>
</p>
<?php 
	// 현재의 상태 - 이 값을 통해서 화면을 표시하면 됨.
	//$status = 'waiting';
	$status = 'solo_game';
	//$status = 'dual_game';
	//$status = 'game_end';
	$correct_answer = $_SESSION ['correct_answer']; // ex) ('a', 'p', 'p', 'l', 'e')
	$current = $_SESSION ['current'];  // ex) ('a', ' ', ' ', 'l', ' ')
	$wrong = $_SESSION['wrong'];  // ex) ('b', 't')
	//$turn = $_SESSION['turn']; // 0이면 내 turn, 1이면 상대방 turn
	$turn = 1;
	$win = true;
	//$wrong_input = array('e','p','a','q','j','p','a','q','j'); // 연습용

	if ($status === 'waiting') {
?>
<div id="panel_wrap">
	<div class="solo_game_panel">
		<ul class="user_info">
			<li>USER: <?php echo $_SESSION['id']; ?></li>
			<li>상대 PLAYER를 기다리는 중입니다.</li>
		</ul>
		<div class="panel_box">
			<div class="game_waiting">
			상대 PLAYER를 기다리는 중입니다.
			</div>
		</div>
	</div>
<?php
	} else if ($status === 'dual_game'){
?>
	<div id="panel_wrap">
		<div class="solo_game_panel">
			<ul class="user_info">
				<li>USER: <?php echo $_SESSION['id']; ?></li>
				<li>USER: <?php echo $_SESSION['id']; ?></li>
			</ul>
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
				<form action = "test.php" method = "post">
					<ul>
					<?php
						if ($turn === 0) {
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
				<form action="test.php" method="post">
					<input type="hidden" value="solo_game" name="status">
					<input type="submit" value="리셋">		
				</form>
			</li>
			<li>
				<form action="test.php" method="post">
					<input type="hidden" value="lobby" name="status">
					<input type="submit" value="로비">		
				</form>
			</li>
		</ul>
	</div>
<?php

	} else if ($status === 'solo_game') {
?>
	<div id="panel_wrap">
		<div class="solo_game_panel">
			<ul class="user_info">
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
					<form action = "test.php" method = "post">
						<ul>
						<?php
							if ($turn === 0) {
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
					<form action="test.php" method="post">
						<input type="hidden" value="solo_game" name="status">
						<input type="submit" value="리셋">		
					</form>
				</li>
				<li>
					<form action="test.php" method="post">
						<input type="hidden" value="lobby" name="status">
						<input type="submit" value="로비">		
					</form>
				</li>
			</ul>
		</div>
<?php
		} else  if($status === 'game_end') {
		
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
				<form action="test.php" method="post">
					<input type="hidden" value="solo_game" name="status">
					<input type="submit" value="리셋">		
				</form>
			</li>
			<li>
				<form action="test.php" method="post">
					<input type="hidden" value="lobby" name="status">
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