<?php
// Include the configuration file
include 'config.php';

// Initialize variables
$email = "";
$password = "";
$user_type = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_type = $_POST["user_type"];

    // You should perform input validation and sanitation here.

    // Replace 'users' with your actual table name
    $sql = "SELECT * FROM `users` WHERE `email` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Verify the hashed password
            if ($row['password'] == $password && $row["user_type"] == $user_type) 
            {
                // Password is correct and user type matches
                // Start a session and store user information if needed
                session_start();
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];

                // Redirect to a protected page or display a success message
                header("Location: index.html");
                exit();
            } else {
                // Password is incorrect or user type doesn't match
                echo "Incorrect user";
            }
        } else {
            // User with the provided email doesn't exist
            echo "Invalid email or password";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

