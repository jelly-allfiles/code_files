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
            padding: 5px 80px 5px 15px;
            width: 80%;  
            text-align: center;
            backdrop-filter: blur(5px); 
            border-radius: 10px; 
            margin-top: 50px;
        }
        /*Navigation Bar Styles */
        nav {
            background-color: rgba(10, 10, 10, 0.58); 
            padding: 10px; 
            display: flex; 
            justify-content: space-evenly; 
            align-items: center;
            position: fixed; 
            width: 95.5%; 
            top: 5%; 
            border-radius: 10px;
            z-index: 1000; 
        }

        nav a {
            color: rgb(0, 255, 255); 
            text-decoration: none; 
            padding: 10px 15px 15px 5px; 
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
            margin-top: 10%;
        }

        /* Flip Card Styles */
        .card {
            padding: -500%;
            width: 250px; 
            height: 150px;
            perspective: 1000px;
            display: inline-block; 
            margin: 5px; 
            left: -100%;
        }

        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s; 
            transform-style: preserve-3d; 
        }

        .card:hover .card-inner {
            transform: rotateY(180deg); 
        }

        .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden; 
            border-radius: 10px;
        }

        .card-front {
            background-color: rgba(255, 255, 255, 0.1); 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-back {
            background-color: rgba(0, 0, 0, 0.8); 
            color: white; 
            display: flex;
            justify-content: center;
            align-items: center;
            transform: rotateY(180deg); 
            padding: 10px; 
        }

        /* Load More Button */
        .load-more {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: rgb(0, 255, 255);
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .load-more:hover {
            background-color: rgba(0, 255, 255, 0.7);
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
    
        <h1>Best Haikyuu Characters</h1>
        <!-- Initially visible cards -->
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/hinata.jpeg" alt="Hinata Shoyo" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Hinata Shoyo: A passionate and determined player known for his incredible jumping ability.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/kageyama.jpeg" alt="Kageyama Tobio" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Kageyama Tobio: A genius setter with a strong personality and a desire to win.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/Nishinoya.jpeg" alt="Yuu Nishinoya" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Yuu Nishinoya: The energetic libero known for his incredible reflexes.</p>
                </div>
            </div>
        </div> 
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/tsukishima.jpeg" alt="Kei Tsukishima" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Kei Tsukishima: A strategic player known for his analytical skills.</p>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/Tanaka.jpeg" alt="Ryunosuke Tanaka" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Ryunosuke Tanaka: A passionate player known for his fierce spirit and determination.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/Sawamura.jpeg" alt="Daichi Sawamura" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Daichi Sawamura: The reliable captain known for his leadership skills.</p>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/Asahi.jpeg" alt="Asahi Azumane" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Asahi Azumane: A powerful player known for his strong spikes.</p>
                    </div>
                </div>
            </div>
        <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/Sugawara.png" alt="Koshi Sugawara" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Koshi Sugawara: A supportive setter with great teamwork skills.</p>
                    </div>
                </div>
        </div>    
        <!-- Load More Button -->
        <button class="load-more" id="loadMore">Load More</button>
        <br>
        <!-- Hidden cards -->
        <div id="moreCards" style="display: none;">
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/Kuroo.jpeg" alt="Tetsuro Kuroo" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Tetsuro Kuroo: A charismatic captain known for his tactical mind.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/Kenma.jpeg" alt="Kenma Kozume" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Kenma Kozume: A strategic player with a love for video games.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/Oikawa.jpeg" alt="Toru Oikawa" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Toru Oikawa: A talented setter known for his charm and skills.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/Iwaizumi.jpeg" alt="Hajime Iwaizumi" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Hajime Iwaizumi: A dependable vice-captain with a strong sense of loyalty.</p>
                    </div>
                </div>
            </div>
    </div>
</div>

    <script>
        document.getElementById('loadMore').addEventListener('click', function() {
            document.getElementById('moreCards').style.display = 'block';
            this.style.display = 'none'; // Hide the load more button after clicking
        });
    </script>
</body>
        
        
</body>
</html>