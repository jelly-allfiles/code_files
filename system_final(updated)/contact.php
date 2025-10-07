<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: landing.php");
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
            background-image: linear-gradient(to right bottom, #f6d774, #f6db7e, #f7e089, #f7e493, #f8e89d, #ecdb93, #e0cf89, #d4c27f, #b9a360, #9e8543, #836827, #694c08);
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
            color: rgb(0, 255, 255); 
            text-decoration: none; 
            padding: 10px 15px 15px 10px; 
            border-radius: 5px; 
            transition: background-color 0.3s; 
        }


        nav a:hover {
            background-color: rgba(0, 255, 255, 0.5); 
            text-decoration: underline; 
        }

        /* Logout Link Styles */
        .logout-link {
            background-color: rgb(255, 0, 0); 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            transition: background-color 0.3s, color 0.3s; 
        }

        .logout-link:hover {
            background-color: rgb(200, 0, 0); 
            color: white; 
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

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        input, textarea {
            width: 80%; 
            max-width: 400px; 
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.69);
            color: black;
        }

        input[type="submit"] {
            background-color: rgb(0, 255, 255);
            color: black;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: rgba(0, 255, 255, 0.7);
        }

    </style>
</head>
<body>
    
    <div class="container">
        <nav>
            <a href="home.php">Home</a>
            <a href="book.php">Book Apppointment</a>
            <a href="items.php">Pet Essentials</a>
            <a href="guidelines.php">Pet Safety</a>
            <a href="contact.php">Contact</a>
            <a class="logout-link" href="logout.php">Logout</a>
        </nav>
        
        <h1>User Feedback</h1>
        <form action="submit_feedback.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="feedback" rows="4" placeholder="Your Feedback" required></textarea>
            <input type="submit" value="Feedback">
        </form>
    </div>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object
    var formData = new FormData(this);

    // Send the form data using fetch
    fetch('submit_feedback.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Show the response from the PHP script
        this.reset(); // Reset the form
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error sending your feedback. Please try again later.');
    });
});
    </script>
</body>
</html>