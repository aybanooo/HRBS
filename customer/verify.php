<?php
	if (isset($GET['verification'])) {
		//process verification
		$verification = $_GET['verification'];

		//connect to database
		$mysqli = NEW MySQLi('localhost','root','','test');

		//result
		$resultSet = $mysqli->query("SELECT verified, verification FROM accounts WHERE verified = 0 AND verification = '$verification' LIMIT 1");

		if ($resultSet-> num_rows == 1) {
			//validate the email
			$update = mysqli->query("UPDATE ACCOUNTS SET verified = 1 WHERE verification = '$verification' LIMIT 1");

			if ($update) {
				echo "Your account has been validated";
			} else {
				echo $mysqli->error;
			}
		} else {
			echo "This account is invalid or already verified."
		}

	} else {
		die("Something went wrong");
	}
?>
