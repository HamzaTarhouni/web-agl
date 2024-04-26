<?php

$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";

// Connection
$connection = new mysqli($servername, $username, $password, $dbname);

$nom = "";
$email = "";
$role = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if (empty($nom) || empty($email) || empty($role)) {
        $errorMessage = "Veuillez remplir tous les champs";
    } else {

        $sql = "INSERT INTO users (nom, email, role) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $nom, $email, $role);


        if ($stmt->execute()) {
            $successMessage = "Utilisateur ajouté avec succès";
            $nom = "";
            $email = "";
            $role = "";
        } else {
            $errorMessage = "Erreur lors de l'ajout de l'utilisateur : " . $connection->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create.php</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container my-5">
        <h2>Nouvel utilisateur</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong><?php echo $errorMessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong><?php echo $successMessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="row mb-3">
                <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="role" class="col-sm-3 col-form-label">Rôle</label>
                <div class="col-sm-6">
                    <select name="role" class="form-select">
                        <option value="admin" <?php if ($role == 'admin')
                            echo 'selected'; ?>>Admin</option>
                        <option value="docteur" <?php if ($role == 'docteur')
                            echo 'selected'; ?>>Docteur</option>
                        <option value="infermier" <?php if ($role == 'infermier')
                            echo 'selected'; ?>>Infirmier</option>
                        <option value="patient" <?php if ($role == 'patient')
                            echo 'selected'; ?>>Patient</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-3">
                    <button type="submit" class="btn btn-primary me-2">Soumettre</button>
                    <a href="admin.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>