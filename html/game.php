<?php
	require_once '../includes/lib.php'; //서버 연결 함수 있는곳

	function get_random_word () {
		$conn = get_connection ();
		$get_word = "SELECT word FROM vocabulary ORDER BY rand() LIMIT 1"; //랜덤 단어
		$data = mysqli_query ($conn, $get_word);
		if ($data === false) {
			echo mysqli_error($conn);
			die;
		}	
		$row = mysqli_fetch_assoc($data);
		$word = $row['word'];
		mysqli_close($conn);
		return $word;
	}
	
$ans = "apple";

$ansArray= str_split($ans);
print_r($ansArray);
echo "<br>";
$ansLength = count($ansArray);
$unseenArray = Array();

for($i = 0; $i < $ansLength; $i++){
	$unseenArray[] = 0;
}

print_r($unseenArray);
$wrongArray = Array();



$return = check_character($ansArray,'a',$unseenArray);

print_r(check_character($ansArray,'p',$return));


//parameters: (답-사전에서 찾아온 단어(array), 입력받는 값 (charater), 아직 공개되지 않은 글자 array)
//EX : apple이 들어오고 첫턴에 사용자가 p를 입력했다면 
// ('a', 'p', 'p', 'l', 'e'), ('p'), (0, 0, 0, 0, 0) => (0, 'p', 'p', 0, 0)
function check_character($ansArray, $character, $unseenArray){ 
	
	foreach($ansArray as $key => $value){
		$char_check_result = $unseenArray;
		if($value === $character){
			$unseenArray[$key] = $character;
			$char_check_result = $unseenArray;
		}
	}
	return $char_check_result;
}

?>