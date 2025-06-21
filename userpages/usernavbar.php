<?php
    if(!isset($_SESSION["id"])){
        header("Location:../login.php");
        exit();
    }
    if($_SESSION["role"]!=="Student"){
        exit("Unauthorised Access");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="../css/userdashboard-styles.css">
    <link rel="stylesheet" href="../css/usernavbar-styles.css">
    <link rel="stylesheet" href="../css/userhistory-styles.css">


</head>
<body>
    <header>
        <nav>
            <h2>Comp<span>lainIT</span></h2>
            <ul>
                <li><a href="./userdashboard.php">Dashboard</a></li>
                <li><a href="./userhistory.php">History</a></li>
                
            </ul>
        </nav>
        <div id="div">
            <p><?php echo $_SESSION['name'];?></p>
            <svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 "/></svg>
            <div id="dropdown-content">
                <a href="../logout.php">Logout</a>
            </div>
            
        </div>
        <svg fill=""  viewBox="0 0 15 15"  xmlns="http://www.w3.org/2000/svg" id="hamburger">
                <path clip-rule="evenodd" d="M1.5 3C1.22386 3 1 3.22386 1 3.5C1 3.77614 1.22386 4 1.5 4H13.5C13.7761 4 14 3.77614 14 3.5C14 3.22386 13.7761 3 13.5 3H1.5ZM1 7.5C1 7.22386 1.22386 7 1.5 7H13.5C13.7761 7 14 7.22386 14 7.5C14 7.77614 13.7761 8 13.5 8H1.5C1.22386 8 1 7.77614 1 7.5ZM1 11.5C1 11.2239 1.22386 11 1.5 11H13.5C13.7761 11 14 11.2239 14 11.5C14 11.7761 13.7761 12 13.5 12H1.5C1.22386 12 1 11.7761 1 11.5Z" fill="currentColor" fill-rule="evenodd"/></svg>
        
    </header>
    <div id="menu-overlay"></div>
    <div id="menu">
        <h2>Comp<span>lainIT</span></h2>
        <ul>
            <li><a href="./userdashboard.php" class="nav-link">Dashboard</a></li>
            <li><a href="./userhistory.php" class="nav-link">History</a></li>
            <li><a href="../logout.php" class="nav-link">Logout</a></li>
        </ul>
     </div>
    <script src="../js/userhamburger.js"></script>

    