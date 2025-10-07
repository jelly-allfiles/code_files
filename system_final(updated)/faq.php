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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <title>FAQ</title>
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

/* Container Styles */
.container-faq {
    width: 100%;
    max-width: calc(100% - 120px); 
    min-height: 150%;
}

/* Header Styles */
.container-booking h1 {
    text-align: center;
    color: black;
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

    .sidebar {
      width: 250px;
      height: 100vh;
      background: #D1AA8C;
      color: #1f0e01;
      padding-top: 20px;
      transition: left 0.3s ease;
      z-index: 1000;
      min-height: 170%;
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

.faq-item {
    border-bottom: 1px solid #ddd;
}

.faq-item:last-child {
    border-bottom: none;
}

.faq-question {
    background: #81431E;
    color: #fff;
    padding: 10px 20px;
    font-weight: bold;
    font-size: 1.1em;
    margin: 20px 100px;
    cursor: pointer;
    text-align: center;
}

summary {
    list-style: none;
}

.faq-answer {
    padding: 10px 15px;
    display: none;
    justify-content: center;
    text-align: center;
}

details[open] .faq-answer {
    display: block;
}
       

        @media (max-width: 768px) {
            .faq-container {
                width: 95%;
            }

            .faq-question {
                font-size: 1em;
                padding: 12px 16px;
            }

            .faq-answer {
                font-size: 0.9em;
                padding: 12px 16px;
            }
        }

        @media (max-width: 480px) {
            .faq-question {
                font-size: 0.9em;
            }

            .faq-answer {
                font-size: 0.85em;
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

<div class="container-faq"> 
<div class="content">
<div class="notif">
    <i class="fa-solid fa-envelope" ></i>
</div>
<div class="notif1">
    <i class="fa-solid fa-bell"></i>
</div>
    <h1 style="margin-top: 50px;">Frequently Asked Questions</h1>

  <details class="faq-item">
    <summary class="faq-question">What vaccines should my pet get?</summary>
    <div class="faq-answer">
      <p>Core vaccines protect pets from critical diseases like rabies and distemper.</p>
      <p>Non-core vaccines depend on lifestyle and local laws.</p>
      <p>Puppies/kittens begin vaccinations at 6-8 weeks and complete by 14-16 weeks.</p>
    </div>
  </details>

  <details class="faq-item">
    <summary class="faq-question">How often should I bring my pet to the vet?</summary>
    <div class="faq-answer">
      <p>Dogs and cats require annual checkups; older pets (6+ years) may need biannual visits.</p>
       <p> Puppies and kittens need frequent visits for vaccination boosters.</p>
       <p>Sick or chronic conditions require more frequent visits.</p>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">What should I feed my pet?</summary>
    <div class="faq-answer">
      <p>Consider age, weight, and dietary needs when choosing food. Options may include dry, wet, and raw diets; transitioning takes 10 days to avoid digestive issues.</p>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">Does my pet really need vaccines?</summary>
    <div class="faq-answer">
      <p>Yes, pets immune systems age faster than humans, so vaccines are crucial for lasting protection.</p>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">How often should I deworm my pet?</summary>
    <div class="faq-answer">
      <p>Adult Pets: 2-3 times a year.</p>
      <p>Puppies and Kittens: Every 2 weeks from 2-12 weeks of age.</p>
      <p>Outdoor Pets: May require more frequent deworming.</p>
      <p>New Animals: Deworm immediately upon arrival, repeat in two weeks, and then begin an adult regimen. </p>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">What are the signs of a sick pet?</summary>
    <div class="faq-answer">
      <p>Changes in appetite, level of energy, behavior, grooming, urination/defecation, breathing, and physical appearance.</p>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">Why does my pet eat grass?</summary>
    <div class="faq-answer">
      <p>Pets may indicate dietary needs or self-treatment for sickness. Sudden excessive grass-eating warrants a vet visit.</p>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">How often should I give my pet a bath?</summary>
    <div class="faq-answer">
      <p>For Cats:</p>
      <ul>
          <li>Monthly baths, but lifestyle may require exceptions.</li>
       </ul>
       <p>For Dogs:</p>
       <ul>
           <li>Monthly baths; over-bathing may dry their skin.</li>
        </ul>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">What grooming products should I use?</summary>
    <div class="faq-answer">
      <p>Use pet-safe shampoos and breed-appropriate brushes. Add nail clippers, detanglers, or ear-cleaning solutions if needed.</p>
    </div>
  </details>
  
  <details class="faq-item">
    <summary class="faq-question">Do I need a specific type of leash for my pet?</summary>
    <div class="faq-answer">
      <p>Yes, match the leash type to pet size, strength, and behavior. Retractable leashes offer flexibility; training leashes help with manners.</p>
    </div>
  </details>
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
</div>
</body>
</html>