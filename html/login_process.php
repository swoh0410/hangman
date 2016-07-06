<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
	$id = $_POST["id"];
	$password = $_POST["password"];
	echo "ID: ".$id. "<br> PW: " . $password;
}

?>