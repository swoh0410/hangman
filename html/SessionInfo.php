<?php
require_once '../includes/session.php';
class SessionInfo {
  private $id;
  private $status;
  private $answer ;
  private $current;

  //SessionInfo 생성자
  
  function __construct($info_array){ 
		$id = $infoArray['id'];
		$password = $infoArray['password'];
		$status = $infoArray['status'];
		if(isset(info_array['answer'])){
			$answer = $infoArray['answer'];
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
	public function isMyTurn(){
		$conn = get_connection();
		$select_query = printf ('SELECT turn FROM hangman.game_room WHERE user1 = %d', get_user_id_from_user_name($_SESSION['id']));
		$result = mysqli_query($conn, $select_query);
		if(mysqli_num_rows($result) === 1){ // 찾아온 줄 이 있다면.
			$my_position = 1;
		}else{ // 없다면 유저 2라는 뜻이니까 다시 아이디 찾아오기. 
			$select_query = printf('SELECT turn FROM hangman.game_room WHERE user2 = %d', get_user_id_from_user_name($_SESSION['id']));
			$result = mysqli_query($conn, $select_query); 
			$my_position = 2;
		}
		while(NULL !==($row = mysqli_fetch_assoc($result))) {
			$turn = $row['turn']; 
		}
		
		mysqli_free_result($result);
		
		if($my_position === $turn){
			$turn = true;
		}else{
			$turn = false;
		}
		
		return $turn;
	}
  
  // id GETTER
  public function getId($id) {
    if (property_exists($this, $id)) {
      return $this->$id;
    }
  }
  
   // status GETTER
  public function getStatus($status) {
    if (property_exists($this, $status)) {
      return $this->$status;
    }
  }
  
  // status SETTER
  public function setStatus($status, $value) {
    if (property_exists($this, $status)) {
      $this->$status = $value;
    }
    return $this;
  }
  
   // answer GETTER
  public function getAnswer($answer) {
    if (property_exists($this, $answer)) {
      return $this->$answer;
    }
  }
  
  // answer SETTER
  public function setAnswer($answer, $value) {
    if (property_exists($this, $answer)) {
      $this->$answer = $value;
    }
    return $this;
  }
  
   // current GETTER
  public function getCurrent($current) {
    if (property_exists($this, $current)) {
      return $this->$current;
    }
  }
  
  // current SETTER
  public function setCurrent($current, $value) {
    if (property_exists($this, $current)) {
      $this->$current = $value;
    }
    return $this;
  }
  
    // wrong GETTER
  public function getCurrent($wrong) {
    if (property_exists($this, $wrong)) {
      return $this->$wrong;
    }
  }
  
  // wrong SETTER
  public function setCurrent($wrong, $value) {
    if (property_exists($this, $wrong)) {
      $this->$wrong = $value;
    }
    return $this;
  }
}

     // Winner GETTER
  public function getWinner($current) {
    if (property_exists($this, $current)) {
      return $this->$current;
    }
  }
  
  // Winner SETTER
  public function setWinner($current, $value) {
    if (property_exists($this, $current)) {
      $this->$current = $value;
    }
    return $this;
  }


?>