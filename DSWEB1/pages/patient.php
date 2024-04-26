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
    padding: 10px 15px;
}

.navbar-brand {
    color: #fff !important;
}

.navbar-nav .nav-link {
    color: #fff !important;
    margin-right: 10px;
}

table {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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

.btn-primary {
    background-color: #007bff !important;
    border-color: #007bff !important;
    color: #fff !important;
}

.form-control, .custom-select, textarea {
    margin-bottom: 15px;
}

.main-form button {
    display: block;
    width: 100%;
}

.custom-select {
    width: 100%; 
    padding: 10px; 
    border-radius: 5px; 
    border: 1px solid #ced4da; 
    background-color: #fff; 
    color: #495057; 
    font-size: 1rem; 
    transition: border-color 0.3s; 
}

.custom-select:hover {
    border-color: #80bdff; 
}

.custom-select:focus {
    border-color: #007bff; 
    outline: none; 
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

    </style>
    <title>Patient</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Patient Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#patients">Modifier mes coordonnées</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#rendezvous">Rendez-vous</a>
                </li>
                
                
                

            </ul>
            <div class="d-flex ms-auto">
            <form method="POST" action="">
                    <button class="btn btn-outline-success" type="submit" name="logout">Se déconnecter</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<div id="patients"></div>



<div class="page-section">
      <div class="container">
        <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

        <form class="main-form" action="rendezvous.php" method="POST">
          <div class="row mt-5">
            <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
              <input type="text" class="form-control" placeholder="Full name" name="nom">
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <input type="text" class="form-control" placeholder="Email address.." name="email">
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
              <input type="date" class="form-control" name="date">
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
              <select name="choix" id="departement" class="custom-select">
                <option value="general">General Health</option>
                <option value="cardiology">Cardiology</option>
                <option value="dental">Dental</option>
                <option value="neurology">Neurology</option>
                <option value="orthopaedics">Orthopaedics</option>
              </select>
            </div>
            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
              <input type="text" class="form-control" placeholder="Number.." name="num">
            </div>
            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
              <textarea name="msg" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3 wow zoomIn" name="envoyer">Submit Request</button>
        </form>
      </div>
    </div> 
    <div class="container mt-5">
        <h2>Changer le mot de passe</h2>
        <form id="changePasswordForm" action="" method="POST">
            <div class="form-group">
                <label for="current_password">Mot de passe actuel:</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nouveau mot de passe:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le nouveau mot de passe:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Script PHP -->
    <?php
   

    // Vérifiez si l'utilisateur est connecté
    if (!isset($_SESSION['email'])) {
        header("Location:localhost/DSWEB1/pages/index.html");
        exit;
    }

    // Connexion à la base de données
    $servername = "localhost";
    $dbname = "projet web";
    $username = "hamza";
    $password = "hamza1234";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion: " . $conn->connect_error);
    }

    // Vérifiez si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtenez les entrées utilisateur
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_SESSION['email'];

        // Vérifiez si les nouveaux mots de passe correspondent
        if ($new_password !== $confirm_password) {
            echo "Les nouveaux mots de passe ne correspondent pas.";
            exit;
        }

        // Préparez la requête SQL pour obtenir le mot de passe actuel
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Vérifiez le mot de passe actuel
        if (password_verify($current_password, $row['password'])) {
            // Hachez le nouveau mot de passe
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Préparez la requête SQL pour mettre à jour le mot de passe
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $new_hashed_password, $email);

            // Exécutez la mise à jour et vérifiez les résultats
            if ($update_stmt->execute()) {
                echo "Le mot de passe a été changé avec succès.";
            } else {
                echo "Erreur lors de la mise à jour du mot de passe.";
            }
            
            $update_stmt->close();
        } else {
            // Le mot de passe actuel est incorrect
            echo "Le mot de passe actuel est incorrect.";
        }

        $stmt->close();
    }

    // Fermez la connexion à la base de données
    $conn->close();
    ?>
</body>
</html> 