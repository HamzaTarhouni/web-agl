<?php
session_start();

// Database connection parameters
$servername = "localhost";
$dbname = "projet web";
$username = "hamza";
$password = "hamza1234";

// Establishing a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

// Check if the sign-in form was submitted
if (isset($_POST['signin'])) {
    $email = $_POST['mail'];
    $password = $_POST['pass'];

    // Prepare the SQL statement to retrieve email, password, and role
    $stmt = $conn->prepare("SELECT email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the provided password against the stored password
        if (password_verify($password, $row['password'])) {
            // Set session variables for the authenticated user
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];

            // Redirect the user based on their role using a switch statement
            $role = $row['role'];
            switch ($role) {
                case 'admin':
                    header("Location: /DSWEB1/pages/admin.php");
                    exit;
                case 'docteur':
                    header("Location: /DSWEB1/pages/doctor.php");
                    exit;
                case 'patient':
                    header("Location: /DSWEB1/pages/patient.php");
                    exit;
                case 'infermier':
                    header("Location: /DSWEB1/pages/infermier.php");
                    exit;
                default:
                    echo "Unknown role: " . htmlspecialchars($role);
                    exit;
            }
        } else {
            // Incorrect password
            echo "Mot de passe incorrect.";
        }
    } else {
        // No account found with the provided email
        echo "Aucun compte trouvé avec cet email.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
