<?php
require_once '../includes/session.php';
class SessionInfo {
	private $id;
	private $mode;
	private $answer ;
	private $current;
	private $wrong;
	private $turn;
	private $winner;

  //SessionInfo 생성자
  
  function __construct($info_array){ 
		$id = $infoArray['id'];
		$password = $infoArray['password'];
		$mode = $infoArray['mode'];
		$game_status = $infoArray['game_status'];
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
  public function getAnswer(){
      return $answer;
  }
  
  // answer SETTER
  public function setAnswer($answer) {
      $this->$answer = $answer;
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
  }
  
  // Winner SETTER
  public function setWinner($winner){
	  $this -> $winner = $winner;
	}
  }
  
  
  
}
?>