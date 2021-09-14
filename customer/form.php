<?php
	$error = NULL;

	if (isset($_POST['submit'])) {
		//connect to database
		$mysqli = NEW MySQLi('localhost','root','','test');

		//get form data
		$email = $mysqli->real_escape_string($_POST['email']);

		//query the database
		$resultSet = $mysqli->query("SELECT * FROM accounts WHERE username = '$email' LIMIT 1");

		if ($resultSet->num_rows != 0) {
			//process login
			$row = $resultSet->fetch_assoc();
			$verified = $row['verified'];
			$email = $row['email'];

			if($verified == 1) {
				//continue processing
				echo "your account is verified.";
			} else {
				$error = "This account has not been yet verified. An email was sent to $email";
			}
		}
	}
?>

//html code

<?php
	echo $error;
?>