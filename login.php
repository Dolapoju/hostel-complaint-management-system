<?php
    session_start();
    if(isset($_SESSION["role"])){
        if($_SESSION["role"]=="Student"){
            header("Location:./userpages/userdashboard.php");
            exit();
        }elseif($_SESSION["role"]=="Worker"){
            header("Location:./workerpages/workerdashboard.php");
            exit();
        }else if($_SESSION["role"]=="Admin"){
            header("Location:./adminpages/admindashboard.php");
            exit();
        }
    }
    
    $id=$password=$error="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["login"])){
            require "./dblink.php";

            function queryselector($role,$id,$conn){
                if($role=="Student"){
                    $query= "SELECT * FROM students WHERE studentId = '$id'";
                    $result=mysqli_query($conn,$query);
                    return $result;
                }elseif($role=="Admin"){
                    $query= "SELECT * FROM admins WHERE adminId = '$id'";
                    $result=mysqli_query($conn,$query);
                    return $result;

                }elseif ($role=="Worker") {
                    $query= "SELECT * FROM workers WHERE workerId = '$id'";
                    $result=mysqli_query($conn,$query);
                    return $result;
                    
                }
            }

            $id=trim(mysqli_real_escape_string($conn,$_POST["id"])); 
            $password=mysqli_real_escape_string($conn,$_POST["password"]);
            $role=$_POST["role"];
            $results=queryselector($role,$id,$conn);
            if(mysqli_num_rows($results)==1){
                $record=mysqli_fetch_assoc($results);
                $hashed_password=$record["password"];
                // $role= $record["role"];
                $name= $record["fullName"];
                if(password_verify($password,$hashed_password)){
                    $_SESSION["id"] = $id;
                    $_SESSION["role"] = $role;
                    $_SESSION["name"] = $name;
                    if($role=="Student"){
                        header("Location: ./userpages/userdashboard.php");
                        exit();
                    }elseif($role=="Admin"){
                        header("Location: ./adminpages/admindashboard.php");
                        exit();
                    }elseif($role=="Worker"){
                        header("Location: ./workerpages/workerdashboard.php");
                        exit();
                    }
                }else{
                $error="Incorrect ID or Password";
                }
            }else{
                $error="Incorrect ID or Password";
            }
            mysqli_close($conn);
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <form action="" method="POST">
        <h1 id="header">Welcome</h1>
        <h2><a href="index.php" id="exception">Comp<span>lainIT</span></a></h2>
        <input type="text" placeholder="ID" name="id" class="underscore" required value='<?php echo "$id"?>'>
        <input type="password" placeholder="Password" name="password" class="underscore" required value='<?php echo "$password"?>'>
        <div id="errorMessage2"><?php echo $error?></div>
        <div id="roles">
            <label><input type="radio" name="role" value="Student" checked>Student</label>
            <label><input type="radio" name="role" value="Admin">Admin</label>
            <label><input type="radio" name="role" value="Worker">Worker</label>
        </div>
        
        <input type="submit" value="LOGIN" name="login">
        <p>Don't have an account?<a href="./userpages/usersignup.php">Sign Up</a></p>

    </form>
    <script src="./js/alreadyexisterror.js"></script>
    
</body>
</html>