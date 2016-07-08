<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<head>

</head>

<body>
<p>
<?php 
	$a = implode($_SESSION['current'], ' ');
	echo $a.'<br><br>';
	$b = implode($_SESSION['correct_answer'], ' ');
	echo $b.'<br><br>';
	//if(isset($_SESSION['wrong'])){
	
?>
</p>
<?php 
	$status = 'solo_game';
	$correct_answer = $_SESSION ['correct_answer'];
	$current = $_SESSION ['current'];
	$wrong_input = array('e','p','a','q','j','p','a','q','j');
	
	if ($status === 'solo_game') {
?>
<div id="panel_wrap">
	<div class="solo_game_panel">
		<ul class="user_info">
			<li>USER 1</li>
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

						<li> <input type="text" name="user_input" size="35" autofocus> </li>
						<li> <input type="submit" value  = "Entre"> </li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	<div class="wrong_input">
		<ul>

			<li>틀린답</li>
			<li>&nbsp;</li><br>
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
	} else if ($status === 'game_end') {
?>
	
	<div>
		Game Over
	</div>
	
<?php
	}
?>
	

</div>
</body>
<html>