<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">

<head>

</head>
<?php if(isset($_GET['array'])){
	$a = $_GET['array'];
	echo "echo : ". $a;
}
?>
<body>
	<div class="solo_game_panel">
		<ul>
			<li>USER 1</li>
		</ul>
		<div class="panel_box">
			<h1></h1>
			<div>
				틀린횟수 : X
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
</body>


<html>