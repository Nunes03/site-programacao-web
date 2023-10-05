<?php
	$hostname = "localhost";

	$username = "root";

	$password = "";

	$databaseName = "uniaservice";

	$mysqli = new mysqli($hostname, $username, $password, $databaseName);
    $result = $mysqli->query('select nome from teste');

    if ($result) {
		while($row = mysqli_fetch_array($result)){
			$name = $row["nome"];
			echo($name);
		}
	}
	
	$mysqli->close();
?>