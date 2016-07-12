<!DOCTYPE html>
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

<?php include 'header.php'; ?>
<div id="wrap">
	<div id="content">							
		<?php 
			if(check_login()){
		?>
				<div id="content_l">
					<?php //require 'solo_game.php'?>
						<?php
							if (isset($_SESSION['status'])){
								// 세션이 있으면 아무 작업도 안함.
							} else { // 처음 들어 오면 세션을 lobby로.
								$_SESSION['status'] = 'lobby';								
							}						
							
							if($_SESSION['status'] === 'lobby'){							
						?>
						<div class="please_start">
							<form action="test.php" method="post">
								<input type="hidden" value="solo_game" name="status">
								<input type="submit" value="솔로 게임">
							</form>
							<form action="test.php" method="post">
								<input type="hidden" value="dual_game" name="status">
								<input type="submit" value="듀얼 게임">
							</form>
						</div>
						<?php							
							}else if($_SESSION['status'] === 'solo_game'){
								require 'solo_game.php';
							} else if($_SESSION['status'] === 'dual_game'){
								require 'solo_game.php';
							}else {
								echo $_SESSION['status'];
								die ('세션 에러');
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
									<td class="login_btn" rowspan="2"><input type="submit" name="login_btn" value="로그인"></td>
								</tr>
								<tr>
									<th>PW</th>
									<td><input type="password" name="password"></td>
								</tr>
							</table>
						</form>
						<form action="register_page.php" method="get">
							<input type="submit" value="회원가입">
						</form>
					</div>
				</div>
				<div id="content_l">
					<div class="please_login">
						<h1> 로그인을 해주세요! </h1>
					</div>
				</div>
		<?php } ?>		
	</div>
</div>
<?php include 'footer.php'; ?>

</body>
</html>