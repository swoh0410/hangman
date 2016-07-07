<?php
	require_once '../includes/lib.php';

	function get_random_word () {
		$conn = get_connection ();
		$get_word = "SELECT word FROM vocabulary ORDER BY rand() LIMIT 1";
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

	echo get_random_word();

?>