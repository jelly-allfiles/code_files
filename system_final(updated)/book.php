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
            padding: 150px 50px;
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
    </style>
</head>
<body>  
<?php
require 'db_connect.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $client_name = $_POST['client_name'];
    $pet_name = $_POST['pet_name'];
    $pet_breed = $_POST['pet_breed'];
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Check doctor availability (this is a placeholder; implement your own logic)
    $isAvailable = true; // Assume the doctor is available for simplicity

    // You would typically check the database for availability here
    // Example: $stmt = $pdo->prepare("SELECT * FROM appointments WHERE date = ? AND time = ?");
    // $stmt->execute([$date, $time]);
    // $isAvailable = $stmt->rowCount() == 0;

    if ($isAvailable) {
        // Insert the appointment into the database
        $stmt = $pdo->prepare("INSERT INTO appointments (client_name, pet_name, pet_breed, service, date, time) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$client_name, $pet_name, $pet_breed, $service, $date, $time]);

        // Send confirmation email
        $to = "root"; // Replace with the client's email
        $subject = "Appointment Confirmation";
        $message = "Your appointment for $service on $date at $time has been confirmed for your pet: $pet_name.";
        $headers = "From: furevermanagement@gmail.com";

        mail($to, $subject, $message, $headers);

        echo "<p>Appointment booked successfully! A confirmation email has been sent to the client.</p>";
    } else {
        echo "<p>Sorry, the selected time is not available. Please choose another time.</p>";
    }
}
?>
        <div class="container"> 
            <nav> 
                <a href="home.php">Home</a> 
            <a href="book.php">Book Appointment</a> 
            <a href="items.php">Pet Essentials</a> 
            <a href="guidelines.php">Pet Safety</a> 
            <a href="contact.php">Contact</a> 
            <a class="logout-link" href="logout.php">Logout</a> 
            </nav> 
         <h1>Book Your Appointment</h1>

        <form id="bookingForm" method="post" action="book_appointment.php">
        <label for="client_name">Client Name:</label>
        <input type="text" name="client_name" id="client_name" required>

        <label for="pet_name">Pet Name:</label>
        <input type="text" name="pet_name" id="pet_name" required>

        <label for="pet_breed">Pet Breed:</label>
        <select name="pet_breed" id="pet_breed" required>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
        </select>

        <label for="service">Select Service:</label>
        <select name="service" id="service" required>
            <option value="consultation">Consultation</option>
            <option value="deworming">Deworming</option>
            <option value="vaccination">Vaccination</option>
            <option value="emergency">Emergency Services</option>
            <option value="anti-rabies">Anti-Rabies Vaccination</option>
            <option value="diagnostic">Diagnostic Test Kits</option>
            <option value="house-call">House Calls</option>
            <option value="surgery">Surgery</option>
        </select>

        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" required>

        <label for="time">Select Time:</label>
        <input type="time" name="time" id="time" required>

        <input type="submit" value="Book Appointment">
    </form>
</div>
<script>
    // Client-side validation can be added here if needed
    document.getElementById('bookingForm').onsubmit = function() {
        // Example: Check if the date is in the past
        const dateInput = document.getElementById('date');
        const selectedDate = new Date(dateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Set time to midnight for comparison

        if (selectedDate < today) {
            alert("Please select a valid date.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    };
</script>
</body>
</html>