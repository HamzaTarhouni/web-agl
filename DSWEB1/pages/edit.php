<?php

$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";

// Connection
$connection = new mysqli($servername, $username, $password, $dbname);

$email = "";
$nom = "";
$passwordNew = ""; 
$role = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["email"])) {
        header("location:/DSWEB1/pages/admin.php"); 
        
        exit;
    }
    $email = $_GET["email"];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = $connection->query($sql);
    $row = $res->fetch_assoc();

    $nom = $row["nom"];
    $email = $row["email"];
    $password = $row["password"];
    $role = $row["role"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $passwordNew = $_POST["password"];
    $role = $_POST["role"];
    
    if (empty($nom) || empty($email) || empty($role)) {
        $errorMessage = "Veuillez vérifier les champs";
    } else {
        $sql = "UPDATE users SET nom='$nom', password='$passwordNew', role='$role' WHERE email='$email'";
        $res = $connection->query($sql);
        if (!$res) {
            $errorMessage = "Erreur lors de la mise à jour : " . $connection->error;
        } else {
            $successMessage = "Mise à jour effectuée avec succès";
           
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container my-5">
        <h2>Modifier un utilisateur</h2>
        <?php if(!empty($errorMessage)): ?>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong><?php echo $errorMessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>
        
        <?php if(!empty($successMessage)): ?>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong><?php echo $successMessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>
        
        <form action="" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="row mb-3">
                <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-3 col-form-label">Mot de passe</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($password); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="role" class="col-sm-3 col-form-label">Rôle</label>
                <div class="col-sm-6">
                    <select name="role" class="form-select">
                        <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="docteur" <?php if ($role == 'docteur') echo 'selected'; ?>>Docteur</option>
                        <option value="infermier" <?php if ($role == 'infermier') echo 'selected'; ?>>Infirmier</option>
                        <option value="patient" <?php if ($role == 'patient') echo 'selected'; ?>>Patient</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-3">
                    <button type="submit" class="btn btn-primary me-2">Soumettre</button>
                    <a href="/DSWEB1/pages/admin.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>