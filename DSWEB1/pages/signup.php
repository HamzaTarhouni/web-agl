<?php

$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("ConnectionError: " . $conn->connect_error);
} else {
    if (isset($_POST['signup'])) {
		$nom = $_POST['nom'];
        $email = $_POST['mail'];
        $password = $_POST['pass'];
        $role="patient";
        $check_query = "SELECT email FROM users WHERE email='$email'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo "Email already exists"; 
        } else {
			$pass=password_hash($password,PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (nom, email, password,role) VALUES ('$nom', '$email', '$pass','$role')";
            if ($conn->query($insert_query) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        }
    }
}

?>
