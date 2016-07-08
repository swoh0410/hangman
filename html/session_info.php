<?php
class session_info {
  private $id;
  private $status;
  private $answer ;
  private $current;

  //session_info 생성자
  function __construct($info_array){ 
		$id = $infoArray['id'];
		$status = $infoArray['status'];
		$answer = $infoArray['answer'];
		$current = $infoArray['current'];
	}
  
  // id GETTER
  public function getId($id) {
    if (property_exists($this, $id)) {
      return $this->$id;
    }
  }
  
  // id SETTER
  public function setId($id, $value) {
    if (property_exists($this, $id)) {
      $this->$id = $value;
    }
    return $this;
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
  public function getId($answer) {
    if (property_exists($this, $answer)) {
      return $this->$answer;
    }
  }
  
  // answer SETTER
  public function setId($answer, $value) {
    if (property_exists($this, $answer)) {
      $this->$answer = $value;
    }
    return $this;
  }
  
   // current GETTER
  public function getId($current) {
    if (property_exists($this, $current)) {
      return $this->$current;
    }
  }
  
  // current SETTER
  public function setId($current, $value) {
    if (property_exists($this, $current)) {
      $this->$current = $value;
    }
    return $this;
  }
}

?>