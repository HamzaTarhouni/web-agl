<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
       
        <a class="navbar-brand" href="#">Admin Dashboard  </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     
          </ul>
        
          <div class="d-flex ms-auto">
            <button class="btn btn-outline-success" type="submit">Se deconnecter</button>
          </div>
        </div>
      </div>
    </nav>
    <div class="container my-5">
      <h2>Liste des utilisateurs</h2>
      <a class="btn btn-primary" href="create.php" role="button">Ajouter un utilisateur</a>
      <br />
      <table class="table">
        <thead>
          <tr>
            <th>nom</th>
            <th>email</th>
            <th>password</th>
            <th>role</th>
            <th>Action</th>
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
        $sql = "SELECT * FROM `users`"; 
        $result = $conn->query($sql); 
        if (!$result) {
            die("Invalid query" . $conn->error); 
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['nom']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['role']}</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit.php'>modifier</a>
                        <a class='btn btn-danger btn-sm' href='delete.php'>supprimer</a>
                    </td>
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
