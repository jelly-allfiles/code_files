<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $conn = new mysqli("localhost", "root", "", "client_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"]; 

    
    $passwordValid ='/^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[0-9])(?=.*[A-Za-z]).{8,}$/';

    if (!preg_match($passwordValid,  $password)) {
        
        echo "<script>alert('Password must be at least 8 characters long, include one special character, one number, and one letter.');</script>";
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

       
        $stmt = $conn->prepare("INSERT INTO client (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    }

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
    <title>Registration Form</title>
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
            color: #81431E;
            font-size: 24px;
            margin-top: 0; 
        
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
<div class = "container">
    <div class="form-box register">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type="text" name="firstname" placeholder="First Name" required>
                    <i class=' bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="lastname" placeholder="Last Name" required>
                    <i class=' bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class=' bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <input type="hidden" name="action" value="register">
                <button type="submit" class="btn">Register</button><br>
               <br><p>-- or register with your social platform --</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                </div>
            </form>
        </div>
</div>
<script src="register.php"></script>
</body>
</html>