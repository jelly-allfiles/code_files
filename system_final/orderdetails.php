<?php
session_start();
if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
    $_SESSION['firstname'] = "Guest";
    $_SESSION['lastname'] = "";
}

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Assuming you have a cart stored in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle form submission for order details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the order here (e.g., save to database)
    // Clear the cart after processing
    $_SESSION['cart'] = [];
    echo "Order has been placed successfully!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: rgb(235, 199, 182);
    background-size: cover;
    background-position: center;
}


h1 {
    margin: 3%;
    text-align: center;
    color: #81431E;
}

h2 {
    color: #81431E;
    margin-bottom: 10px;
    border-bottom: 2px solid #81431E;
    padding-bottom: 5px;
}

.sidebar {
    width: 250px;
    height: 100vh;
    background-color: rgba(244, 244, 244, 0.47);
    position: fixed;
    left: 0px;
    transition: left 0.3s ease;
    padding: 20px;
    top: 0;
    z-index: 1000;
}

.sidebar.active {
    left: 0;
}

.sidebar-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-container {
  text-align: center;
}

.profile-label {
  cursor: pointer;
}

.profile-picture {
  width: 65px;
  height: 55px;
  border-radius: 55%;
  border: 2px solid #ddd;
  object-fit: cover;
  margin: 0 80px;
  transition: transform 0.3s, box-shadow 0.3s;
}

.profile-picture:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.user-name {
    font-size: 1.5em;
    color: #333;
    margin: 0;
}

.sidebar-menu {
    list-style-type: none;
    padding: 0;
}

.sidebar-menu li {
    margin: 10px 0;
}

.sidebar-menu a {
    text-decoration: none;
    color: #333;
    padding: 10px;
    display: block;
    border-radius: 4px;
}

.sidebar-menu a:hover {
    background-color: #ddd;
}

.dropdown {
    display: none;
}

.sidebar-menu li:hover .dropdown {
    display: block;
} 



/* Right Navbar Styles */
.right-navbar {
    position: fixed; 
    top: 0; 
    right: 30px;
    border-radius: 8px; 
    padding: 10px; 
    z-index: 1000; 
    display: flex;
    
}

/* Button Styles */
.dropbtn {
    background-color: #81431E;  
    color: white;
    border: none; 
    justify-content: space-evenly;
    flex-direction: column;
    margin: 2px;
    padding: 5px 10px; 
    border-radius: 5px; 
    cursor: pointer; 
    width: 100%; 
    text-align: left; 
    transition: background-color 0.3s; 
}

.dropbtn:hover {
    background-color:rgb(235, 199, 182); 
}

/* Dropdown Styles */
.dropdown1 {
    color: white;
    position: relative; 
    margin-bottom: 5px;
}

.dropdown-content {
    background-color: white;
    display: none; 
    position: absolute; 
    top: 30px;
    margin-left: -100px;
    min-width: 130px; 
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 
    z-index: 1; 
    border-radius: 5px; 
}

.dropdown1:hover .dropdown-content {
    display: block; 
}

.dropdown-content a {
    color: black; 
    padding: 12px 16px; 
    text-decoration: none; 
    display: block; 
}

.dropdown-content a:hover {
    background-color: #f1f1f1; 
}


/* Button Styles */
button {
    background-color: #e74c3c; 
    border: none;
    border-radius: 5px; 
    cursor: pointer;
    padding: 10px 15px;
    color: white;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s; 
}

button:hover {
    background-color: #c0392b; 
    transform: translateY(-1px); 
}
/* Link Styles */
button a {
    color: white; 
    text-decoration: none; 
}

/* Main Container Styles */
.container {
    max-width: 950px;
    margin: 50px auto;
    margin-left: 25%;
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
}

form label {
    margin-top: 10px;
}

form input, form select, form textarea {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .sidebar {
        width: 200px;
        margin-left: -200px; /* Hide sidebar */
    }

    .navbar {
        flex-direction: column;
    }

    .container {
        margin-left: 10px; /* Adjust margin for smaller screens */
    }

    .navbar button {
        margin-left: 0;
        width: 100%; /* Full width for buttons */
        text-align: left; /* Align text to left */
    }

    .navbar .dropbtn {
        width: 100%;
        text-align: left;
    }
}

@media (max-width: 480px) {
    .sidebar {
        width: 100%;
        margin-left: -100%; /* Hide sidebar */
    }

    .sidebar-menu li {
        text-align: center; /* Center align text in sidebar */
    }

    .navbar button {
        font-size: 14px; /* Smaller text for mobile */
    }

    .profile-picture {
        width: 60px;
        height: 60px;
    }
}


    </style>
</head>
<body>

        <div class="right-navbar">
                <button class="dropbtn">Messages</button>
                <div class="dropdown1">
                <div class="dropdown-content">
                    <a href="#">Message 1</a>
                    <a href="#">Message 2</a>
                </div>
            </div>
            
                <button class="dropbtn">Notifications</button>
                <div class="dropdown1">  
                    <div class="dropdown-content">
                    <a href="#">Notification 1</a>
                    <a href="#">Notification 2</a>
                    </div>
                </div>
        </div>


    <div class="sidebar" id="sidebar">
    <div class="profile-container">
                <label for="profilePicInput" class="profile-label">
                    <img id="profilePic" src="photos/boy-profile.jpg" alt="Profile Picture" class="profile-picture">
                </label>
                    <h2 class="user-name"><?php echo htmlspecialchars($_SESSION["firstname"] . " " . $_SESSION["lastname"]); ?></h2>
                    <input type="file" id="profilePicInput" accept="image/*" style="display: none;">
            </div>
            <script src="profile.js"></script>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li>
                <a href="appointment.php">Appointment Booking for Services</a>
            </li>
            <li>
                <a href="petscategory.php">Pet</a>
                <ul class="dropdown">
                    <li><a href="healthrecords.php">Health Records Management</a></li>
                </ul>
            </li>
            <li>
                <a href="order-pets.php">Order Pets Essentials</a>
            </li>
            <li>
                <a href="instructions.php">Pets Safety Guidelines</a>
                <ul class="dropdown">
                <li><a href="guidelines.php">Emergency Guidelines: The Do's and Don'ts</a></li>
                </ul>
            </li>
            <li><a href="faq.php">FAQ</a></li>
        </ul>
        <button><a href="logout.php">Logout</a></button>
    </div>


<div class="container">
<h1>Order Details</h1>
<form action="orderdetails.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="orderDetails">Order Details:</label>
    <textarea id="orderDetails" name="orderDetails" readonly></textarea>

    <label for="paymentMethod">Payment Method:</label>
    <select id="paymentMethod" name="paymentMethod" required>
        <option value="Credit Card">Credit Card</option>
        <option value="PayPal">PayPal</option>
        <option value="Cash on Delivery">Cash on Delivery</option>
    </select>

    <label for="totalPrice">Total Price:</label>
    <input type="number" id="totalPrice" name="totalPrice" readonly>

    <div id="order-summary">
        <h2>Your Cart</h2>
        <ul id="cart-items"></ul>
        <p id="total-price"></p>
    </div>

    <button type="submit" onclick="displayCart()">Checkout</button>
</form>
</div>
    <script src="dropdown.js"></script>
  <script src="order-pet.js"></script>
</body>
</html>