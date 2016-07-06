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


<div id="wrap">
	<?php include 'header.php'; ?>
	<div id="content">
		<div id="content_l">
			<form>
				<input type="button" name="start_game" value="게임 참가하기">
			</form>
		</div>
		<div id="content_r">
			<div id="login">
			<?php 
				if(check_login()){
					echo '<table>';
					echo '<td>'.$_GET['id'].'님 환영합니다.</td>';
					
			?>
					<td><form action="logout.php" method="get">
					<input type="submit" value="로그아웃"></td>
					</form></td>
					</tr>
					</table>
					</div>
			<?php		
				} else {				
			?>					
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
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>

</body>
</html>