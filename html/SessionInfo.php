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
		$select_query = printf ('SELECT turn FROM hangman.game_room WHERE game_room_id = %s', $game_room_id);
		$result = mysqli_query($conn, $select_query);
		
		while(NULL !==($row = mysqli_fetch_assoc($result))) {
			$tableArray[] = $row; 
		}
		
		mysqli_free_result($result);
		return $tableArray;
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