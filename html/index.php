<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.countdown.js"></script>
<title>2조 PROJECT - HANGMAN GAME</title>
<script>
	var roomNumber = 3;
	$(document).ready(function(){
		drawIfNeededForIndex();
	});
	function joinRoom(roomNum, form) {
		var element = document.createElement('input');
		form.appendChild(element);
		element.type = 'hidden';
		element.value = roomNum;
		element.name = 'room_num';
		form.submit();
	}
	
	function ajaxRoomData(roomNum) {
		$.ajax({
			url:'ajaxRoomData.php',
			type: 'POST',
			async: false,
			data : { room_num : roomNum },
			dataType: 'json',
			success : function(result){
				roomData = result;
				//alert('success ' + JSON.stringify(result));
			},
			error: function(xhr) {
				//alert(JSON.stringify(xhr));
			},
		});
		return roomData;
	}
	
	function drawScreenForIndex() {
		for (var i = 1; i < roomNumber + 1; i++){
			if(roomData[i]['user2_id'] == null && roomData[i]['user1_id'] != null) {
				document.getElementById('wating' + i).innerHTML = '대기자 : ' + roomData[i]['user1_id'];
				document.getElementById('join_btn' + i).value = '게임 참가';
				document.getElementById('join_btn' + i).disabled = false;
			} else if (roomData[i]['user2_id'] != null) {
				document.getElementById('wating' + i).innerHTML = '게임 중 : ' + roomData[i]['user1_id'] + ' VS ' + roomData[i]['user2_id'];
				document.getElementById('join_btn' + i).value = '게임 중';
				document.getElementById('join_btn' + i).disabled = true;
			} else if (roomData[i]['user1_id'] == null) {
				document.getElementById('wating' + i).innerHTML = '대기자 : 없음';
				document.getElementById('join_btn' + i).value = '대기 하기';
				document.getElementById('join_btn' + i).disabled = false;
			}
		}
	}
	function drawIfNeededForIndex() {
		ajaxRoomData(roomNumber);
		drawScreenForIndex()
		setTimeout (function() {			
			drawIfNeededForIndex();
		}, 5000);
		
	}
</script>
<?php 
	
	require_once 'SessionInfo.php'; 
	start_session();

	if(isset($_SESSION['info_dto'])){
		$infoDto = $_SESSION['info_dto'];
	}else{
		$info_array = Array();
		$info_array['mode'] = 'lobby';
		$infoDto = new SessionInfo($info_array);
		$_SESSION['info_dto'] = $infoDto;
	}
	//echo $infoDto->getMode().'<br>';
	//echo $infoDto->getGamingStatus();

?>
</head>
<body>

<div id="wrap">

	<div id="content">							
		<?php 
			if(check_login()){
				$infoDto -> setId($_SESSION['id']);
				$infoDto -> setPassword($_SESSION['password']);
		?>
				<div id="content_l">
					<?php //require 'game_panel.php'?>
						<?php					
							if($infoDto->getMode() === 'lobby'){							
						?>
						<div class="please_start">
							<table>
								<tr>
									<td>
										<span>0</span>
									</td>
									<td>
										<form action="change_mode.php" method="post">
											<input type="hidden" value="solo_game" name="mode">
											<input type="submit" value="솔로 게임">
										</form>
									</td>
									<td>
										<span></span>
									</td>
								</tr>
								<?php get_start_button(3); ?>
							</table>
						</div>
						<?php							
							}else if($infoDto->getMode() === 'solo_game'){
								require 'game_panel.html';
							} else if($infoDto->getMode() === 'dual_game'){
								require 'game_panel.html';
							}else {
								echo $infoDto->getMode();
								die ('세션 에러');
							}
						?>
					
				</div>
				<div id="content_r">		
					<div id="login">
						<table>
							<tr>
								<td>
									<?php echo $infoDto->getId(); ?> 님 환영합니다!
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
					<div class="user_stat_box">
						<?php
							// stat 데이터 가져오기
							$pk = get_user_id_from_user_name($infoDto->getId());
							require_once 'stat_db.php';
							$row = get_stats($pk);
							echo '총 '.$row['total'].'번 | ';
							echo '승 : '.$row['win'].' | ';
							echo '패 : '.$row['lose'].' | ';
							echo '승률 : '.$row['win_rate'].'%';
						?>
					</div>
				</div>	
		<?php		
			} else {				
		?>		
				<div id="content_r">
					<div id="login">
						
							<table>
								<form action="login_process.php" method="post">
								<tr>
									<th>ID</th>
									<td><input type="text" name="id" autocomplete="off"></td>
									<td class="login_btn" rowspan="2"><input type="submit" name="login_btn" value="로그인"></td>
								</tr>
								<tr>
									<th>PW</th>
									<td><input type="password" name="password" autocomplete="off"></td>
								</tr>
								</form>
								<form action="register_page.php" method="get">
								<tr>
									<th></th><td><input type="submit" value="회원가입"></td>
								</tr>
								</form>
							</table>
						
						
							
						
					</div>
				</div>
				<div id="content_l">
					
					<span class="please_login"> <h1>로그인을 해주세요!</h1> <span>
					
				</div>
		<?php } ?>		
	</div>
	<div id="footer">
		<span>Copyright © 2016 김종찬<br>All rights reserved</span>
	</div>
</div>

</body>
</html>