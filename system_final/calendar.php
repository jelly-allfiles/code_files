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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
  <title>Calendar Layout</title>
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
      color: #1f0e01;
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

    .calendar-container {
      background: #F7F0E9;
      display: flex;
      padding: 20px;
      gap: 20px;
      width: 100%;
      max-width: 100%;
      flex-wrap: wrap;
    }

    .sidebar1 {
      width: 250px;
      min-width: 200px;
    }

    .sidebar1 h1 {
      font-size: 48px;
      color: #D1AA8C;
    }

    .sidebar1 .date {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .menu-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 0;
      cursor: pointer;
    }

    .menu-item.active {
      color: white;
      background: #D1AA8C;
      border-radius: 8px;
      padding-left: 10px;
    }

    .calendar-content {
      flex: 1;
      min-width: 300px;
      margin-top: 50px;
    }

    .calendar-controls {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .calendar-controls button {
      background: #D1AA8C;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 10px;
    }

    .calendar-day, .calendar-cell {
      text-align: center;
      padding: 10px;
      border-radius: 8px;
    }

    .calendar-day {
      font-weight: bold;
      background: #f2f2f2;
    }

    .calendar-cell {
      background: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    /* Mobile-first styles */
    @media (max-width: 768px) {
      .calendar-container {
        padding: 10px;
      }

      .sidebar1 {
        width: 100%;
        text-align: center;
      }

      .sidebar1 h1 {
        font-size: 36px;
      }

      .sidebar1 .menu-item {
        padding: 8px;
        font-size: 14px;
      }

      .calendar-content {
        width: 100%;
      }

      .calendar-controls {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .calendar-controls button {
        width: 100%;
      }

      .calendar-grid {
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
      }

      .calendar-cell {
        font-size: 14px;
        padding: 8px;
      }
    }

    /* Desktop styles */
    @media (min-width: 769px) {
      .calendar-container {
        flex-direction: row;
      }

      .sidebar1 {
        width: 250px;
      }

      .calendar-controls {
        flex-direction: row;
        justify-content: space-between;
      }
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

  <div class="notif">
    <i class="fa-solid fa-envelope" ></i>
</div>
<div class="notif1">
    <i class="fa-solid fa-bell"></i>
</div>

  <div class="calendar-container">
    <div class="sidebar1">
      <h1 id="currentDay">19</h1>
      <div class="date" id="currentDate">March 2025</div>
      <div class="menu-item active">Calendar</div>
      <div class="menu-item">Events</div>
      <div class="menu-item">Notes</div>
      <div class="menu-item">Reminders</div>
      <div class="menu-item">Documents</div>
      <div class="menu-item">Trash</div>
      <div class="menu-item">Settings</div>
    </div>
    
    <div class="calendar-content">
      <h2>Appointment Calendar</h2>
      <div class="calendar-controls">
        <button onclick="changeMonth(-1)">Previous</button>
        <div id="monthYear"></div>
        <button onclick="changeMonth(1)">Next</button>
      </div>

      <div class="calendar-grid" id="calendarDays"></div>
    </div>
  </div>

  <script>
    const monthNames = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];

    let currentDate = new Date();

    function renderCalendar() {
      const month = currentDate.getMonth();
      const year = currentDate.getFullYear();

      document.getElementById("monthYear").innerText = `${monthNames[month]} ${year}`;
      document.getElementById("currentDate").innerText = `${monthNames[month]} ${year}`;
      document.getElementById("currentDay").innerText = currentDate.getDate();

      const firstDay = new Date(year, month, 1);
      const lastDay = new Date(year, month + 1, 0);

      const calendarDays = document.getElementById("calendarDays");
      calendarDays.innerHTML = "";

      const daysOfWeek = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
      daysOfWeek.forEach(day => {
        const div = document.createElement("div");
        div.classList.add("calendar-day");
        div.innerText = day;
        calendarDays.appendChild(div);
      });

      for (let i = 0; i < firstDay.getDay(); i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("calendar-cell");
        calendarDays.appendChild(emptyCell);
      }

      for (let i = 1; i <= lastDay.getDate(); i++) {
        const dayCell = document.createElement("div");
        dayCell.classList.add("calendar-cell");
        dayCell.innerText = i;
        calendarDays.appendChild(dayCell);
      }
    }

    function changeMonth(offset) {
      currentDate.setMonth(currentDate.getMonth() + offset);
      renderCalendar();
    }

    renderCalendar();

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
