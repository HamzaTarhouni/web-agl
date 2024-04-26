<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: http://localhost/DSWEB1/pages/sign in.html");
    exit;
}

$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ConnectionError: ".$conn->connection_error);
}

$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);
if (!$result) {
    die("Invalid query" . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #6c757d !important;
            color: #fff;
        }

        .navbar-brand {
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
        }

        h2 {
            margin-top: 30px;
            color: #495057;
        }

        table {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-outline-success {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: #fff !important;
        }

        .btn-outline-success:hover {
            background-color: #218838 !important;
            border-color: #1e7e34 !important;
        }
    </style>
    <title>Patient</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Doctor Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#patients">Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#infirmiers">Infermiers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#rendezvous">Rendez-vous</a>
                </li>
                
                
                

            </ul>
            <div class="d-flex ms-auto">
            <button class="btn btn-outline-success" type="submit" name="logout">Se déconnecter</button>
            </div>
        </div>
    </div>
</nav>
<div id="patients"></div>
<h2>Liste des patients</h2>
<table class="table">
    <thead>
    <tr>
        <th>nom</th>
        <th>email</th>
    </tr>
    </thead>
    <tbody>
    <?php

$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("ConnectionError: ".$conn->connection_error);
    } else {
        $sql = "SELECT * FROM `users` where role='patient'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Invalid query" . $conn->error);
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "
            <tr>
                <td>{$row['nom']}</td>
                <td>{$row['email']}</td>
            </tr>";
            }
        }
    }
    ?>
    </tbody>
</table>
<div id="infirmiers"></div>
<h2>Liste des infermiers</h2>
<table class="table">
    <thead>
    <tr>
        <th>nom</th>
        <th>email</th>
    </tr>
    </thead>
    <tbody>
    <?php

$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("ConnectionError: ".$conn->connection_error);
    } else {
        $sql = "SELECT * FROM `users` where role='infermier'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Invalid query" . $conn->error);
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "
            <tr>
                <td>{$row['nom']}</td>
                <td>{$row['email']}</td>
            </tr>";
            }
        }
    }
    ?>
    </tbody>
</table>
</div>
<div id="rendezvous"></div>
<h2>Liste des Rendez vous</h2>
<table class="table">
    <thead>
    <tr>
        <th>nom</th>
        <th>tel</th>
        <th>choix</th>
        <th>date</th>
    </tr>
    </thead>
    <tbody>
    <?php
$servername = "localhost";
		$dbname = "projet web";
		$username = "hamza";
		$password = "hamza1234";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("ConnectionError: ".$conn->connection_error);
    } else {
        $sql = "SELECT nom,num,choix,date FROM `rendezvous` ";
        $result = $conn->query($sql);
        if (!$result) {
            die("Invalid query" . $conn->error);
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "
            <tr>
                <td>{$row['nom']}</td>
                <td>{$row['num']}</td>
                <td>{$row['choix']}</td>
                <td>{$row['date']}</td>
            </tr>";
            }
        }
    }
    ?>
    </tbody>
</table>
</div>
</body>
</html>
