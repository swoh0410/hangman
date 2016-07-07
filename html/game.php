<?php
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



	// 사용자 : 단어입력 - DB에서 제공한 단어와 같은지 비교
	$ans = "apple";
	$wrongInput ="hello";
	$shortInput ="app";
	$longInput ="appleab";
	
	$user_input = $_POST['user_word'];
	$correct_answer = 'apple';
	
	// 사용자가 입력한 단어 : 소문자로 변경 및 space 삭제
	function clean_input ($input_text) {
		$input_text_lower = strtolower($input_text);
		return str_replace(' ','',$input_text_lower);
	}
	
	// 사용자가 입력한 값과, DB에서 제공한 단어를 clean_input 함수를 이용해 같은 형태로 변경한 후 값이 같은지 비교
	function check_input ($correct_answer, $user_input) {
		return clean_input ($correct_answer) === clean_input ($user_input);
	}
	echo '정답은 apple 입니다.<br>';
	echo '단어 : '.$user_input.'<br>결과 : ';
	var_dump(check_input($correct_answer, $user_input));

?>