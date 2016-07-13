<?php
require_once '../includes/session.php';
class SessionInfo {
	private $id;
	private $mode;
	private $correct_answer ;
	private $current;
	private $wrong;
	private $turn;
	private $winner;
	private $user1;
	private $user2;
	private $game_room_id;

  //SessionInfo 생성자
  
  function __construct($info_array){ 
		$id = $infoArray['id'];
		$password = $infoArray['password'];
		$mode = $infoArray['mode'];
		$game_status = $infoArray['game_status'];
		if(isset(info_array['answer'])){
			$correct_answer = $infoArray['answer'];
		}
		if(isset(info_array['current'])){
			$current = $infoArray['current'];
		}
		if(isset(info_array['wrong'])){
			$wrong = $infoArray['wrong'];
		}
		if(isset(info_array['turn'])){
			$turn = $infoArray['turn'];
		}
		if(isset(info_array['winner'])){
			$winner = $inforArray['winner'];
		}
	}
	//isMyTurn
	
  
  // id GETTER
  public function getId() {
      return $this->$id;
  }
  
   // mode GETTER
  public function getMode() {
	return $mode;
  }
  
  // mode SETTER
  public function setMode($mode) {
	$this->$mode = $mode;
  }
  
   // answer GETTER
  public function getCorrectAnswer(){
      return $correct_answer;
  }
  
  // answer SETTER
  public function setCorrectAnswer($answer) {
      $this->$answer = $correct_answer;
  }
  
   // current GETTER
  public function getCurrent() {
      return $current;
  }
  
  // current SETTER
  public function setCurrent($current) {
      $this->$current = $current;
  }
  
    // wrong GETTER
  public function getWrong() {
      return $wrong;
  }
  
  // wrong SETTER
  public function setWrong($wrong) {
      $this->$wrong = $wrong;
  }
  
     // turn GETTER
  public function getTurn () {
	return $turn;
  }
  
  // turn SETTER
  public function setTurn($turn) {
	$this-> $turn = $turn;
  }
  
  // Winner GETTER
  public function getWinner() {
      return $winner;
	}
	
  // Winner SETTER
  public function setWinner($winner){
	  $this -> $winner = $winner;
	}
  }

	public start_dual_game(){
		//빈자리가 있는 방 찾기
		$is_room_created = false;
		$conn = get_connection();
		$room_query = sprintf("SELECT game_room_id FROM game_room WHERE user2_id is NULL;");
		$result = mysqli_query ($conn, $room_query);
		if (mysqli_num_rows($result) > 0) {//대기자가 있는 경우
			$row = mysqli_fetch_assoc($result);
			$room = $row['game_room_id']; //방번호			
			// 방이 다차면 첫번째 플레이어가 할 차례
			$user2_query = sprintf ("UPDATE game_room SET user2_id=%d, turn=1 WHERE game_room_id=%d;", get_user_id_from_user_name(getId()), $room);
			//맞는 방번호에 user2_id 업데이트
			mysqli_query ($conn, $user2_query);
			$answer_query = sprintf("SELECT answer, current, wrong FROM game_room WHERE game_room_id=%d;", $room);
			$result = mysqli_query ($conn, $answer_query);
			if($result == false) {
				mysqli_error($conn);
			}
			$row = mysqli_fetch_assoc($result)
			setCorrectAnswer(explode(' ', $row['answer']));
			setCurrent(explode(' ', $row['current']));
			setWrong(explode(' ', $row['wrong']));
			setRoomId($room);
			//echo '조인';
			$is_room_created = false;
		} else {//없는경우 방생성
			 //단어 생성하기
		setCorrectAnswer(str_split(get_random_word())); 
		$current = create_empty_array (count(getCorrectAnswer()));
		setCurrent($current);
		setWrong(array());			
			
			$answer = implode(getCorrectAnswer(), ' '); //answer 변수 지정
			$current = implode(getCurrent(), ' '); //current 변수지정
			$wrong = implode(getWrong, ' ');
			$create_query = sprintf("INSERT INTO game_room (answer, current, wrong, user1_id) VALUES ('%s', '%s', '%s', %d);", $answer, $current, $wrong, get_user_id_from_user_name($_SESSION['id']));
			//game_room테이블에 answer, current, user1_id INSERT
			mysqli_query($conn, $create_query);
			setRoomId(mysqli_insert_id($conn)); //나중에 setRoomId 만들어야함
			//echo '방생성';
			$is_room_created = true;
		}
		mysqli_close($conn);
		
		return $is_room_created;
	}
  
	public play(){
		refresh();
		if (isset($_POST['user_input'])){ //'a'입력시
			$user_input = $_POST['user_input'];
			$result = check_character (getCorrectAnswer(), 
			$user_input, getCurrent(), getWrong());
		
			if (implode(getCorrectAnswer(), ' ') === implode(getCurrent, ' ')){
				win_game();
			}
		
		// header("Location: index.php"); 사용한 쪽에서 로케이션 해줘야함.
		} 
	}

	public refresh (){
	  if(isset(game_room_id)){
		
		$select_query = sprintf('SELECT answer, current, wrong, turn, winner, user1_id, user2_id from hangman.game_room where game_room_id = %d',$game_room_id);
		$conn = get_connection();
		$result = mysqli_query($conn,$select_query);
		
		if($row = mysqli_fetch_assoc($result)){
			$this -> $answer = $row['answer'];
			$this -> $current = $row['current'];
			$this -> $wrong = $row['wrong'];
			$this -> $turn = $row['turn'];
			$this -> $winner = $row['winner'];
			$this -> $user1_id = $row['user1_id'];
			$this -> $user2_id = $row['user2_id'];
		}else{
			die ('리프레시 할때 데이터 못 가지고 옴.');
		}
	  }
	}
/*
	getMode();
	getCorrectAnswer();
	getCurrent();
	getWrong();
	getTurn();
	getWinner();
	user1
	user2
*/

  
  
}
?>