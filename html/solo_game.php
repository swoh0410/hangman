<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<head>

</head>
<?php 
	$a = implode($_SESSION['current'], ' ');
	echo $a;
	$b = implode($_SESSION['correct_answer'], ' ');
	echo $b;
	
?>
<body>
<?php 
	$status = 'solo_game';
	$correct_answer = array('a', 'p', 'p', 'l', 'e');
	$current_answer = array('_', 'p', 'p', '_', 'e');
	
	if ($status === 'solo_game') {
?>
<div id="wrap">
	<div class="solo_game_panel">
		<ul class="user_info">
			<li>USER 1</li>
		</ul>
		<div class="panel_box">
			<div class="user_output">
				<ul>
				<?php 
					foreach ($current_answer as $key => $value) {
				?>
					<li>a</li>
				<?php
					}
				?>
				</ul>
			</div>

			<div class="user_input">
				<form action = "test.php" method = "post">
					<ul>
						<li><input type="text" name="user_input"></li>
						<li> <input type="submit" value  = "Entre"> </li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	<div class="wrong_answer">
		<ul>
			<li>틀린답</li>
			<li>&nbsp;</li>
		</ul>
	</div>
	
<?php
	} else if ($status === 'game_end') {
?>
	
	<div>
		Game Over
	</div>
	
<?php
	}
?>
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

</div>
</body>
<html>