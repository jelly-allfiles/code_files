<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    
    <style>
        /* Your existing CSS styles */
        body {
            font-family: sans-serif;
            background-image: url('haikyuu.jpg');
            background-size: cover; 
            background-position: center; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white; 
        }

        /* Container Styles */
        .container {
            background-color: rgba(7, 7, 7, 0.07); 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 90%; 
            max-width: 400px; 
            text-align: center;
            backdrop-filter: blur(5px); 
        }

        /* Heading Styles */
        h1 {
            color: black;
            margin-bottom: 20px;
        }

        /* Input Styles */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: rgb(0, 217, 255);
            outline: none;
        }

        /* Submit Button Styles */
        input[type="submit"] {
            background-color: rgba(0, 255, 255, 0.5);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: rgb(0, 143, 179);
        }

        /* Link Styles */
        a {
            display: block;
            margin-top: 10px;
            color: rgb(194, 194, 194);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Message Styles */
        .error-message {
            color: red;
            margin-top: 10px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
require 'db_connect.php'; // Ensure this is included

function isStrongPassword($password) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 1: Validate Input
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST["password"]) : '';

    // Validate input (e.g., check if it's not empty)
    if (empty($username)) {
        die("Username is required.");
    }

    // Validate password strength
    if (!isStrongPassword($password)) {
        echo "<p class='error-message'>Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.</p>";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Step 2: Prepare a Query
        $sql = "SELECT * FROM users WHERE username = ?";

        // Step 3: Create the Prepared Statement
        $stmt = $pdo->prepare($sql);

        // Step 4: Bind the Parameters to the Prepared Statement
        $stmt->bindParam(1, $username, PDO::PARAM_STR);

        // Step 5: Execute Your Query
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            echo "<p class='error-message'>Username already exists!</p>";
        } else {
            // Step 6: Insert new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $hashedPassword);

            // Step 7: Execute the insert query
            if ($stmt->execute()) {
                // Auto-login after successful registration
                session_start();
                $_SESSION['username'] = $username; // Set session variable
                header("Location: home.php"); // Redirect to a welcome page
                exit();
            } else {
                echo "<p class='error-message'>Error: Could not register user.</p>";
            }
        }
    }
}
?>
        <h1>Register</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Firstname: <input type="text" name="firstname" required><br>
            Lastname: <input type="text" name="lastname" required><br>
            Username: <input type="text" name="username" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Register"><br>
            <a href="login.php">Already have an account? Login</a>
        </form>
    </div>
</body>
</html>