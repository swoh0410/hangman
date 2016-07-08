﻿<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>2조 PROJECT - HANGMAN GAME</title>
<?php 
	require_once '../includes/session.php'; 
	start_session();
	
?>
</head>
<body>


<div id="wrap">
	<?php include 'header.php'; ?>
	
	<div id="content">							
		<?php 
			if(check_login()){
		?>
				<div id="content_l">
					<?php //require 'solo_game.php'?>
						<?php
							if (isset($_SESSION['status'])){
								
							} else { // 처음 들어옴.
								$_SESSION['status'] = 'lobby'; // 나중에 변경해야함.
								
								//여기서 끝내야함.
							}
							
							
							if($_SESSION['status'] === 'lobby'){
								
						?>
							<form action="test.php" method="post">
								<input type="hidden" value="solo_game" name="status">
								<input type="submit" value="솔로 게임">
							</form>
						<?php							
							}else if($_SESSION['status'] === 'solo_game'){
								require 'solo_game.php';
							} else {
								echo $_SESSION['status'];
							}
						?>
					
				</div>
				
				<div id="content_r">		
					<div id="login">
						<table>
							<tr>
								<td>
									<?php echo $_SESSION['id']; ?> 님 환영합니다!
								</td>
							</tr>
							
							<tr>
								<td>
									<form action="logout.php" method="get">
										<input type="submit" value="로그아웃">
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>	
		<?php		
			} else {				
		?>		
				<div id="content_r">
					<div id="login">
						<form action="login_process.php" method="post">
							<table>
								<tr>
									<th>ID</th>
									<td><input type="text" name="id"></td>
								</tr>
								<tr>
									<th>PW</th>
									<td><input type="password" name="password"></td>
								</tr>
							</table>
							<td rowspan="2"><input type="submit" name="login_btn" value="로그인"></td>
						</form>
						<form action="register_page.php" method="get">
							<input type="submit" value="회원가입">
						</form>
					</div>
				</div>
				<div id="content_l">
					<h1> 로그인을 해주세요! <h1>
				</div>
		<?php } ?>		
	</div>
</div>
<?php include 'footer.php'; ?>

</body>
</html>