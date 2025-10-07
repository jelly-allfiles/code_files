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
            padding: 60px 10px;
            width: 500%; 
            max-width: 1000px; 
            text-align: center;
            backdrop-filter: blur(5px); 
            border-radius: 10px; 
            margin-top: 50px;
        }
        
        /*Navigation Bar Styles */
        nav {
            background-color: rgba(10, 10, 10, 0.58); 
            padding: 15px; 
            display: flex; 
            justify-content: space-evenly; 
            align-items: center;
            position: fixed; 
            width: 95%; 
            top: 3%; 
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
            margin-bottom: 5px;
            margin-top: 55px;
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

        /* Merchandise Grid Styles */
        .merch-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); 
            gap: 10px; 
            margin-top: 2px; 
        }

        .merch-item {
            background-color: rgba(255, 255, 255, 0.1); 
            border-radius: 10px; 
            padding: 5px; 
            text-align: center; 
        }

        .merch-item img {
            width: 100%; 
            border-radius: 10px;
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
        <h1>Haikyuu Merch</h1>
        <div class="merch-grid">
            <div class="merch-item">
                <img src="photos/hinata_jersey.jpg" alt="Hinata Shoyo Jersey">
                <p>Hinata Shoyo Jersey</p>
            </div>
            <div class="merch-item">
                <img src="photos/kageyama_jersey.jpg" alt="Kageyama Tobio Jersey">
                <p>Kageyama Tobio Jersey</p>
            </div>
            <div class="merch-item">
                <img src="photos/nishinoya_figure.jpg" alt="Nishinoya Figure">
                <p>Nishinoya Figure</p>
            </div>
            <div class="merch-item">
                <img src="photos/haikyuu_manga.jpg" alt="Haikyuu Manga">
                <p>Haikyuu Manga</p>
            </div>
            <div class="merch-item">
                <img src="photos/haikyuu_keychain.jpg" alt="Haikyuu Keychain">
                <p>Haikyuu Keychain</p>
            </div>
            <div class="merch-item">
                <img src="photos/haikyuu_poster.jpg" alt="Haikyuu Poster">
                <p>Haikyuu Poster</p>
            </div>
            <div class="merch-item">
                <img src="photos/aoba johsai_jacket.jpg" alt="Haikyuu Poster">
                <p>Aoba Johsai Jacket</p>
            </div>
            <div class="merch-item">
                <img src="photos/nekoma_jacket.jpg" alt="Haikyuu Poster">
                <p>Nekoma Jacket</p>
            </div>
            <div class="merch-item">
                <img src="photos/Fukurodani_jacket.jpg" alt="Haikyuu Poster">
                <p>Fukurodani Jacket</p>
            </div>
            <div class="merch-item">
                <img src="photos/shiratorizawa_jacket.jpg" alt="Haikyuu Poster">
                <p>Shiratorizawa Jacket</p>
            </div>
            <div class="merch-item">
                <img src="photos/karasuno_jacket.jpg" alt="Haikyuu Poster">
                <p>Karasuno Jacket</p>
            </div>
        </div>  
    </div>
</body>
</html>