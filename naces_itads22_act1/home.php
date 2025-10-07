<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: sans-serif;
            background-image: url('hehe.jpg');
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
            background-color: rgba(7, 7, 7, 0.5); 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 150px 50px;
            width: 500%; 
            max-width: 1000px; 
            text-align: center;
            backdrop-filter: blur(5px); 
            border-radius: 10px; 
        }
        /*Navigation Bar Styles */
        nav {
            background-color: rgba(10, 10, 10, 0.58); 
            padding: 15px; 
            display: flex; 
            justify-content: space-evenly; 
            align-items: center;
            position: fixed; 
            width: 88%; 
            top: 5%; 
            border-radius: 10px;
            z-index: 1000; 
        }

        nav a {
            color: rgb(0, 255, 255); /* Link color */
            text-decoration: none; /* Remove underline */
            padding: 10px 15px 15px 10px; /* Padding around each link */
            border-radius: 5px; /* Rounded corners for links */
            transition: background-color 0.3s; /* Smooth background transition */
        }


        nav a:hover {
            background-color: rgba(0, 255, 255, 0.5); /* Change background on hover */
            text-decoration: underline; /* Underline on hover */
        }

        /* Logout Link Styles */
        .logout-link {
            background-color: rgb(255, 0, 0); /* Red background for logout */
            color: white; /* White text color */
            padding: 10px 20px; /* Padding for logout link */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }

        .logout-link:hover {
            background-color: rgb(200, 0, 0); /* Darker red on hover */
            color: white; /* Keep text color white on hover */
        }

        /* Heading Styles */
        h1 {
            color: white; 
            margin-bottom: 20px;
        }

        /* Link Styles */
        a {
            display: block;
            margin-top: 10px;
            color: rgb(0, 255, 255); /
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="characters.php">Characters</a>
            <a href="merch.php">Merch</a>
            <a href="feedback.php">Feedback</a>
            <a class="logout-link" href="logout.php">Logout</a>
        </nav>
        <h1>Welcome To Haikyuu Web: Together We Fly: Building Connections, One Set at a Time!</h1>
        <h2>your ultimate destination for all things Haikyuu!! Immerse yourself in the vibrant world of volleyball, where passion meets teamwork. 
            Whether you're here to share your love for the series, connect with fellow enthusiasts, or explore exciting merchandise, 
            we believe that together, we can soar to new heights—one set at a time!</h2>
       
    </div>
</body>
</html>