<?php
session_start();
if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
    $_SESSION['firstname'] = "Guest";
    $_SESSION['lastname'] = "";
}
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointment_pet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and validate form data
$clientName = isset($_POST['clientName']) ? $_POST['clientName'] : null;
$petType = isset($_POST['petType']) ? $_POST['petType'] : null;
$petBreed = isset($_POST['petBreed']) ? $_POST['petBreed'] : null;
$service = isset($_POST['service']) ? $_POST['service'] : null;
$date = isset($_POST['date']) ? $_POST['date'] : null;
$time = isset($_POST['time']) ? $_POST['time'] : null;

// Ensure all fields are filled
if ($clientName && $petType && $petBreed && $service && $date && $time) {
    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO appointments (client_name, pet_type, pet_breed, service, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $clientName, $petType, $petBreed, $service, $date, $time);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Appointment Successful!');</script>";
        echo "<script>window.location.href='appointment.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} 

// Close connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <title>Book Appointment Schedule</title>
    <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Outfit';
    }

    body {
      font-family: Arial, sans-serif;
      background: #F7F0E9;
      height: 100vh;
      overflow-x: hidden;
      display: flex;
    }

    .container{
    flex: 1;
    padding: 20px;
    min-height: 100vh;
    background-color: #F7F0E9;
    box-sizing: border-box;
    position: relative;
    }
    
/* Header Styles */
.container-booking h1 {
    text-align: center;
    color: black;
}

h1 {
    text-align: center;
    color: #81431E;
}

h2 {
    color: #81431E;
    margin-bottom: 10px;
    border-bottom: 2px solid #81431E;
    padding-bottom: 5px;
}

.profile-container {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 20px;
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

    h2 {
    color: #81431E;
    margin-bottom: 10px;
    border-bottom: 2px solid #81431E;
    padding-bottom: 5px;
}

    .sidebar {
      width: 250px;
      height: 100%;
      background: #D1AA8C;
      color: #1f0e01;
      padding-top: 20px;
      transition: left 0.3s ease;
      z-index: 1000;
      min-height: 120%;  
    }

    .sidebar .logo {
      text-align: center;
      font-size: 22px;
      font-weight: bold;
      margin: 20px 0;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin: 10px 0;
    }

    .sidebar ul li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: #1f0e01;
      text-decoration: none;
      transition: background 0.3s;
    }

    .sidebar ul li a:hover {
      background: #ddbea7;
    }

    .sidebar .close-menu {
      display: none;
    }

    .sidebar ul a i {  
            margin-right: 16px;  
     }  

    .dropdown-menu {
      display: none;
      padding-left: 20px;
    }

    .dropdown.open .dropdown-menu {
      display: block;
    }

    .mobile-menu {
      display: none;
      position: absolute;
      top: 15px;
      left: 15px;
      cursor: pointer;
      background: #D1AA8C;
      color: #1f0e01;
      padding: 10px;
      padding-bottom: 5px;
      border-radius: 5px;
    }

    .notif, .notif1 {
    position: absolute;  
    top: 20px;      
    background-color: #fff;
    width: 50px;           /* Fixed width */
    height: 50px;          /* Fixed height */
    border-radius: 50%;    /* Perfect circle */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-size: 24px;  
    cursor: pointer; 
    transition: transform 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notif:hover, .notif1:hover {
    transform: scale(1.1);  
}

.notif {
    right: 20px;
}

.notif1 {
    right: 80px; 
}
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -250px;
      }

      .content {
        padding-top: 90px;
      }

      .sidebar.open {
        left: 0;
      }

      .sidebar .close-menu {
        text-align: right;
        padding-right: 15px;
        cursor: pointer;
        display: block;
      }

      .mobile-menu {
        display: block;
      }
    }

    .content {
      flex: 1;
      padding: 15px;
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
    background-color: #D1AA8C;
    border: none;
    border-radius: 5px; 
    cursor: pointer;
    padding: 10px 15px;
    color: white;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s; 
}

button:hover {
    background-color: #c58859;
    transform: translateY(-1px); 
}

/* Link Styles */
button a {
    color: white; 
    text-decoration: none; 
}

      /* Form Styles */
form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
}

/* Input and Select Styles */
input[type="text"],
input[type="date"],
input[type="time"],
select {
    padding: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 100%;
}

    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="close-menu">
          <svg onclick="toggleSidebar()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </div>
      
        <div class="profile-container">
          <label for="profilePicInput" class="profile-label">
            <img id="profilePic" src="photos/girl-profile.jpg" alt="Profile Picture" class="profile-picture">
          </label>
          <h2 class="user-name"><?php echo htmlspecialchars($_SESSION["firstname"] . " " . $_SESSION["lastname"]); ?></h2>
          <input type="file" id="profilePicInput" accept="image/*" style="display: none;">
        </div>
      
        <ul>
          <li><a href="dashboard.php"><i class="fas fa-qrcode"></i>Dashboard</a></li>
          <li><a href="appointment.php"><i class="fas fa-calendar-week"></i>Booking</a></li>
          <li><a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a></li>
      
          <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa-solid fa-paw"></i>Pet</a>
            <ul class="dropdown-menu">
              <li><a href="petscategory.php">Pets Breed Category</a></li>
              <li><a href="healthrecords.php">Health Records</a></li>
            </ul>
          </li>
      
          <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa-solid fa-bag-shopping"></i>Order Pet Essentials</a>
            <ul class="dropdown-menu">
              <li><a href="order-pets.php">Pets Foods</a></li>
              <li><a href="order-pets-accesories.php">Accessories</a></li>
              <li><a href="order-pet-medicine.php">Medicine</a></li>
            </ul>
          </li>
      
          <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-heart"></i>Pet Safety Guidelines</a>
            <ul class="dropdown-menu">
              <li><a href="instructions.php">Instruction for Emergency</a></li>
              <li><a href="guidelines.php">Emergency Guidelines</a></li>
            </ul>
          </li>
      
          <li><a href="faq.php"><i class="far fa-question-circle"></i>FAQ</a></li>
          <li><a href="logout.php" ><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
        </ul>
      </div>

<!-- Mobile Menu -->
<div class="mobile-menu" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="4" x2="20" y1="12" y2="12"></line>
      <line x1="4" x2="20" y1="6" y2="6"></line>
      <line x1="4" x2="20" y1="18" y2="18"></line>
    </svg>
  </div>  

<div class="container">
    <div class="notif">
        <i class="fa-solid fa-envelope" ></i>
    </div>
    <div class="notif1">
        <i class="fa-solid fa-bell"></i>
    </div>

        <h1>Book Appointment</h1>
        <br>
        <form id="appointmentForm" action="appointment.php" method="POST">
    <label for="clientName" style="color: black;">Client Name:</label>
    <input type="text" id="clientName" name="clientName" required>
    <br><br>

    <label for="petType" style="color: black;">What Pet Is It?</label>
    <select id="petType" name="petType" required>
        <option value="Cat">Cat</option>
        <option value="Dog">Dog</option>
    </select>
    <br><br>

    <label for="petBreed" style="color: black;">Pet Breed:</label>
    <input type="text" id="petBreed" name="petBreed" required>
    <br><br>

    <label for="service" style="color: black;">Choose a Service:</label>
    <select id="service" name="service" required>
        <option value="Consultation">Consultation</option>
        <option value="Deworming">Deworming</option>
        <option value="5-in-1 Vaccination">5-in-1 Vaccination</option>
        <option value="3-in-1 Vaccination">3-in-1 Vaccination</option>
        <option value="Anti-Rabies Vaccination">Anti-Rabies Vaccination</option>
        <option value="Diagnostic Test Kits">Diagnostic Test Kits</option>
        <option value="Emergency Services">Emergency Services</option>
        <option value="Surgery">Surgery</option>
    </select>
    <br><br>

    <label for="date" style="color: black;">Choose a Date:</label>
    <input type="date" id="date" name="date" required>
    <br><br>

    <label for="time" style="color: black;">Choose a Time:</label>
    <input type="time" id="time" name="time" required>
    <br><br>

    <button type="submit">Book Appointment</button>
</form>

</div>
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("open");
  }

  // Dropdown logic to allow only one open at a time
  document.querySelectorAll(".dropdown-toggle").forEach(item => {
    item.addEventListener("click", function () {
      const parent = this.parentElement;

      // Close other open dropdowns
      document.querySelectorAll(".dropdown").forEach(drop => {
        if (drop !== parent) {
          drop.classList.remove("open");
        }
      });

      // Toggle current one
      parent.classList.toggle("open");
    });
  });
</script>
</body>
</html>
