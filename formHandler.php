<?php
session_start();

require_once "./signUp.php";  // Use forward slashes for compatibility across systems
require_once "./logIn.php"; 
require_once "./db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    switch ($action) {
        case "signUp":
            $email = $_POST["email"];
            $password = $_POST["password"];
            $first = $_POST["firstName"];
            $second = $_POST["secondName"];

            // Check if the email is unique
            if (uniqueEmail($email, $conn)) {
                // Hash the password before storing it
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO user (firstName, secondName, email, password) VALUES (?, ?, ?, ?)";
                $statement = $conn->prepare($query);
                $statement->bind_param("ssss", $first, $second, $email, $hashed_password);
                
                // Execute the statement and check for success
                if ($statement->execute()) {
                    header("Location: ./loggedIn.php");
                    exit(); // Ensure no further code is executed after header redirect
                } else {
                    // Handle database insertion error
                    $_SESSION["error"] = "Error in registration. Please try again.";
                    header("Location: ./signUp.php");
                    exit();
                }
            } else {
                $_SESSION["error"] = "This email is already in use. Please try another";
                header("Location: ./signUp.php");
                exit();
            }
        

        case "logIn":
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Use prepared statements to prevent SQL injection
            $query = "SELECT password, firstName FROM user WHERE email = ?";
            $statement = $conn->prepare($query);
            $statement->bind_param("s", $email);
            $statement->execute();
            $result = $statement->get_result();  // Get the result set from the statement

            if ($result->num_rows > 0) { // Check if any user was found
                $fetchedUser = $result->fetch_assoc();
                if (password_verify($password, $fetchedUser["password"])) {
                    $_SESSION["name"] = $fetchedUser["firstName"];
                    header("Location: ./loggedIn.php");
                    exit(); // Ensure no further code is executed after header redirect
                } else {
                    $_SESSION["error"] = "Invalid password!";
                    header("Location: ./logIn.php");  // Redirect to login page if password is incorrect
                    exit();
                }
            } else {
                $_SESSION["error"] = "No user found with that email.";
                header("Location: ./logIn.php"); // Redirect if no user found
                exit();
            }
            
    }
}

// Function to check if an email is unique
function uniqueEmail($email, $mysqli) {
    $stmt = $mysqli->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;
    $stmt->close();
    return $num_rows == 0; // Return true if email is unique (not found)
}
?>