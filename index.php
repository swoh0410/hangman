<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>2조 PROJECT - HANGMAN GAME</title>
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
				<form action="" method="post">
					<table>
						<tr>
							<th>ID</th>
							<td><input type="text" name="user_id"></td>
							<td rowspan="2"><input type="button" name="login_btn" value="로그인"></td>
						</tr>
						<tr>
							<th>PW</th>
							<td><input type="text" name="user_pw"></td>
						</tr>
					</table>
				</form>
				<form action="register_page.php" method="get">
					<input type="submit" value="회원가입">
				</form>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>

</body>
</html>