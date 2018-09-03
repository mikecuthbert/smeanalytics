<?php

	//connect to database
		$conn=mysqli_connect  ('213.171.200.84', 'smeanalytics', 'Sm3analytics!', 'sme_site', 3306) or die ('I cannot connect to the central database because: ' . mysqli_error());

		if(!empty($SQL_user)){
			$conn=mysqli_connect  ($SQL_addr, $SQL_user, $SQL_pass, $SQL_db, 3306) or die ('I cannot connect to the database because: ' . mysqli_error());
			}
		mysqli_set_charset($conn, "utf8");
		mysqli_query($conn, "SET NAMES utf8");


?>
