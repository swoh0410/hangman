<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>2조 PROJECT - HANGMAN GAME</title>
</head>
<body id="wrap">
	<?php include 'header.php'; ?>
	<div id="content">
		<h1>회원 가입</h1>
		<form action="register_process.php" method="post">
			<table>
				<tr>
					<th>ID</th><td><input type="text" name="id"></td>
				</tr>
				<tr>
					<th>PW</th><td><input type="text" name="password"></td>
				</tr>
				<tr>
					<td><input type="submit" value="회원 가입"></td>
				</tr>
			</table>
		</form>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>