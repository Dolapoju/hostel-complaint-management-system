<?php
    if(!isset($_SESSION["id"])){
        header("Location:../login.php");
        exit();
    }
    if($_SESSION["role"]!=="Worker"){
        exit("Unauthorised Access");
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workers</title>
    <link rel="stylesheet" href="../css/workernavbar-styles.css">
    <link rel="stylesheet" href="../css/workerdashboatrd-styles.css">
    <link rel="stylesheet" href="../css/workerhistory-style.css">


</head>
<body>
<header>
    <nav>
        <h2>Comp<span>lainIT</span></h2>
            <ul>
                <li><a href="./workerdashboard.php">Dashboard</a></li>
                <li><a href="./workerhistory.php">History</a></li>
                
            </ul>
        </nav>
        <div id="div">
            <p><?php echo $_SESSION['name'];?></p>
            <svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 "/></svg>
            <div id="dropdown-content">
                <a href="../logout.php">Logout</a>
            </div>
        </div>
        
    </header>

    