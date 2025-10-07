<?php
session_start();
if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
    $_SESSION['firstname'] = "Guest";
    $_SESSION['lastname'] = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Profile</title>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
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
      min-height: 100%;  
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

    .profile-info {
    display: flex;
    background-color:rgba(209, 170, 140,0.2);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    margin: 0 auto;
    width: 100%;
    height: 100%;
  }

  .profile-info p{
    margin-top: 10px;
  }

  /* Profile Photo */
  .profile-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
  }

  .profile-info h2 {
    color: #81431E;
    margin-bottom: 35px;
    border-bottom: 2px solid #81431E;
    padding-bottom: 5px;
    font-size: 1.8em;
  }

  .profile-info p {
    font-size: 1.1em;
    color: #333;
    margin-bottom: 10px;
  }

  .profile-info p strong {
    color: #81431E;
  }

  /* Adjustments for smaller screens */
  @media (max-width: 768px) {
    .profile-info {
      flex-direction: column;  /* Stack the photo and text vertically */
      text-align: center; /* Center text when stacked */
    }

    .profile-photo {
      margin-right: 0;
      margin-bottom: 20px; /* Add some space below the photo when stacked */
    }

    .profile-info h2 {
      font-size: 1.5em;
    }

    .profile-info p {
      font-size: 1em;
    }
  }
    </style>

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

<!-- MAIN CONTENT -->
<div class="content">
<div class="notif">
    <i class="fa-solid fa-envelope" ></i>
</div>
<div class="notif1">
    <i class="fa-solid fa-bell"></i>
</div>

<!-- Profile Information -->
<div class="profile-info">
        <div class="profile-details">
            <h2>Profile Information</h2>
            <img src="photos/girl-profile.jpg" alt="Profile Photo" class="profile-photo">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION["firstname"] . " " . $_SESSION["lastname"]); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($_SESSION["firstname"]); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($_SESSION["lastname"]); ?></p>
            <p><strong>Email:</strong> <?php echo isset($_SESSION["email"]) ? htmlspecialchars($_SESSION["email"]) : 'No email provided'; ?></p>
        </div>
    </div>
</div>

<!-- Scripts -->
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









