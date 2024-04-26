<?php

$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";
// connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ConnectionError: " . $conn->connect_error);
}

if (isset($_POST['envoyer'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $choix = $_POST['choix'];
    echo $choix;
    $num = $_POST['num'];
    $msg = $_POST['msg'];
    echo $nom;

   
 $sql = "INSERT INTO `rendezvous`(`nom`, `date`, `email`, `choix`, `num`, `msg`) 
            VALUES ('$nom', '$date', '$email', '$choix', '$num', '$msg')";

   
    if ($conn->query($sql) === TRUE) {
        echo "Rendez vous success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
