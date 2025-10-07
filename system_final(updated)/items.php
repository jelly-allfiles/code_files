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
            font-family: 'Arial', sans-serif;
            background-image: linear-gradient(to right bottom, #f6d774, #f6db7e, #f7e089, #f7e493, #f8e89d, #ecdb93, #e0cf89, #d4c27f, #b9a360, #9e8543, #836827, #694c08);
            color: #4b3d2e; 
            margin: 0;
            padding: 0;
            overflow: hidden; 
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
            height: 250px;
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
            <a href="book.php">Book Apppointment</a>
            <a href="items.php">Pet Essentials</a>
            <a href="guidelines.php">Pet Safety</a>
            <a href="contact.php">Contact</a>
            <a class="logout-link" href="logout.php">Logout</a>
    </nav>
    
        <h1>Best Haikyuu Characters</h1>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/food.jpg" alt="Hinata Shoyo" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Hinata Shoyo: A passionate and determined player known for his incredible jumping ability.</p>
                </div>
            </div>
        </div>
        <h1>Foods for Cats and Dogs</h1>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/dog_food_chicken_rice.jpg" alt="Kageyama Tobio" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Dog Food: Chicken & Rice: A balanced meal made with real chicken and rice, providing essential nutrients for your dog's health and energy.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/dog_food_beef_sweet_potato.jpg" alt="Dog Food: Beef & Sweet Potato" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Dog Food: Beef & Sweet Potato: A hearty blend of beef and sweet potatoes, rich in vitamins and minerals to support your dog's immune system.
                    </p>
                </div>
            </div>
        </div> 
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/cat_food_salmon_brown_rice.jpg" alt="Cat Food: Salmon & Brown Rice" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Cat Food: Salmon & Brown Rice: A nutritious formula featuring salmon as the primary ingredient, promoting healthy skin and a shiny coat for your cat.</p>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="photos/cat_food_chicken_peas.jpg" alt="Cat Food: Chicken & Peas" style="width:100%; height:100%; border-radius: 10px;">
                </div>
                <div class="card-back">
                    <p>Cat Food: Chicken & Peas: A protein-rich meal with chicken and peas, designed to support your cat's overall health and vitality.</p>
                </div>
            </div>
        </div>

        <h1>Accessories for Cats and Dogs</h1>
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
                        <img src="photos/dog_collar.jpg" alt="Dog Collar" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Dog Collar: A durable and stylish collar for dogs, available in various sizes and colors, ensuring comfort and safety.</p>
                    </div>
                </div>
            </div>
        <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/cat_scratching_post.jpg" alt="Cat Scratching Post" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Cat Scratching Post: A sturdy scratching post that helps keep your cat's claws healthy while protecting your furniture.</p>
                    </div>
                </div>
        </div>    
        
        <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/dog_leash.jpg" alt="Dog Leash" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Dog Leash: A strong and comfortable leash for walking your dog, designed for maximum control and comfort.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="photos/cat_bed.jpg" alt="Cat Bed" style="width:100%; height:100%; border-radius: 10px;">
                    </div>
                    <div class="card-back">
                        <p>Cat Bed: A cozy and soft bed for cats, providing a perfect spot for them to relax and sleep.</p>
                    </div>
                </div>
            </div>
            
    </div>
</div>
</body>
        
        
</body>
</html>