<?php 
include('connect.php');

if(isset($_POST['verify'])){

	//get form data
	$email = $_POST['email'];

	if ($email == null) {

	} else {
		//form is valid
		//connect to database
		$mysqli = NEW MySQLi('localhost','root','','test');

		//sanitize form data
		$email = $mysqli->real_escape_string($email);

		//generate verification key
		$verification = md5(time().$email);

		echo $verification;

		//insert account into database and encrypt password
		$password = md5($p);

		$insert = $mysqli->query("(customer) VALUES('$data_table_value')"); 

		if ($insert) {
			//send email
			$to = $email;
			$subject = "Email Verification";
			$message = "<a href='link'>";
			$headers = "From";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			mail($to, $subject, $message, $headers);
			header('location');
			echo 'Hello';

		} else {
			echo $mysqli->error;
		}

	}
}
?>