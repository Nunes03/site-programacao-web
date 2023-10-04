<?php
    include "..\database\ConnectionDatabase.php";

    echo(new ConnectionDatabase());

    // $connection = new ConnectionDatabase();

    // $result = $connection.executeQuery('select count(*) from teste;');

    // if($result){
	// 	while($row = mysqli_fetch_array($result)){
	// 		$name = $row["count(*)"];
	// 		echo($name);
	// 	}
	// }
?>