<?php
$fname=$id=$email=$room=$phone=$level=$password=$error="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_POST["signup"])){
        require "../dblink.php";
        
        $fname=trim(mysqli_real_escape_string($conn,$_POST["fname"]));
        $id=trim(mysqli_real_escape_string($conn,$_POST["id"]));
        $email=trim(mysqli_real_escape_string($conn,$_POST["email"]));
        $room=trim(mysqli_real_escape_string($conn, $_POST["room"]));
        $phone=trim(mysqli_real_escape_string($conn,$_POST["phone"]));
        $level=trim($_POST["level"]);
        $password=trim(mysqli_real_escape_string($conn,$_POST["password"]));

        $query="SELECT * FROM students WHERE email='$email' OR phoneNos='$phone' OR studentId='$id'";
        $result=mysqli_query($conn,$query);

        if(mysqli_num_rows($result)==0){
            $password= password_hash($password, PASSWORD_DEFAULT);
            $query= "INSERT INTO students (studentId,fullName,email,roomNos,phoneNos,`password`,`level`) VALUES ('$id','$fname' ,'$email','$room','$phone','$password',$level)";

            if (mysqli_query($conn, $query)) {
                header("Location: ../login.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }

        }else{
            $error="ID,phone number or email is taken";
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
    <title>User- Sign Up</title>
    <link rel="stylesheet" href="../css/usersignuppage-styles.css">
</head>
<body>
    <h1>Create Account</h1>
    <p id="first">Please fill in your details</p>
    <form action="" method="POST" onSubmit="return passwordValidate(this)">
    <div id="errorMessage2"><?php echo $error?></div>
        <fieldset>
            <legend>Personal Details</legend>
            <label for="1">Full Name:</label>
            <input type="text" required name="fname" maxlength="45" placeholder="John Macklemore" id="1" value="<?php echo $fname?>">
            <label for="2">Student ID:</label>
            <input type="text" required name="id" maxlength="7" minlength="7" placeholder="23/0988" id="2" value="<?php echo $id?>">
            <label for="3">Email:</label>
            <input type="email" required name="email"  placeholder="macklemorecomplains@gmail.com" id="3" value="<?php echo $email?>">
            <label for="4">Room Nos:</label>
            <input type="text" required name="room"  placeholder="FF12,FF14..." id="4" maxlength="4" value="<?php echo $room?>">
            <label for="5">Phone Nos:</label>
            <input type="tel" required name="phone"  placeholder="=234 909 678 8979" id="5" value="<?php echo $phone?>">
            <label for="6">Level:</label>
            <input type="number" name="level" id="6" step="100" min="100" max="600" placeholder="100" value="<?php echo $level?>">


        </fieldset>
        <fieldset>
            <legend>Create Password</legend>           
            <label for="7">Password:</label>
            <input type="password" required name="password"  id="7" value="<?php echo $password?>" minlength="7">
            <label for="8">Confirm Password:</label>
            <input type="password" required name="confirmPassword"  id="8">
            <div id="errorMessage1"></div>
        </fieldset>
        <input type="checkbox" required  id="terms" class="exception">
        <label for="terms" class="exception">I accept the <a href="#">terms and conditions</a></label>
    
        <input type="submit" value="Sign Up" name="signup">
        <div id="links">
            <a href="../index.php">Home</a>
            <a href="../adminpages/adminsignup.php">are you an admin?</a>
        </div>

    </form>

    <script src="../js/confirmpassworderror.js"></script>
    <script src="../js/alreadyexisterror.js"></script>

</body>
</html>