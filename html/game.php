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


//parameters: (답-사전에서 찾아온 단어(array), 입력받는 값 (charater), 아직 공개되지 않은 글자 array)
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