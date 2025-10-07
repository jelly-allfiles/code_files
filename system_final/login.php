
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "client_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize inputs
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $_POST["password"];

    // Fetch user data
    $stmt = $conn->prepare("SELECT * FROM client WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user["password"])) {
            // Store session details
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $user["username"];
            $_SESSION["firstname"] = $user["firstname"];
            $_SESSION["lastname"] = $user["lastname"];
            $_SESSION["email"] = $user["email"];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username not found!'); window.location.href='login.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <title>Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit';
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('photos/bg.jpg'); 
            background-size: cover; 
            z-index: 1; 
        }

        .container {
            width: 400px;
            background: #FFFFF0;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #81431E;
        }

        .input-box {
            position: relative;
            margin: 15px 0;
        }

        .input-box input {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid #81431E;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fcfcf7;
        }

        .input-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #81431E;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #81431E;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
        background: #C97D60;
        color: white;  
        transition: 0.3s ease-in-out;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .social-icons a {
            display: inline-flex;
            padding: 10px;
            border: 2px solid #81431E;
            border-radius: 50%;
            color: #333;
            text-decoration: none;
            margin: 0 5px;
        }

        .social-icons a:hover {
            background: #eee;
        }

        .switch {
            margin-top: 15px;
            font-size: 14px;
        }

        .switch a {
            color: #81431E;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class="bx bxs-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>
            <button type="submit" class="btn">Login</button>
            <p class="switch">Don't have an account? <a href="register.php">Register</a></p>
        </form>
        <br><p>-- or login with --</p>
        <div class="social-icons">
            <a href="#"><i class="bx bxl-google"></i></a>
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-instagram"></i></a>
        </div>
    </div>

</body>
</html>