<?php
$fname=$id=$email=$phone=$password=$error="";
session_start();
require "./adminnavbar.php";



if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_POST["signup"])){
        require "../dblink.php";
        
        $fname=trim(mysqli_real_escape_string($conn,$_POST["fname"]));
        $id=trim(mysqli_real_escape_string($conn,$_POST["id"]));
        $email=trim(mysqli_real_escape_string($conn,$_POST["email"]));
        $phone=trim(mysqli_real_escape_string($conn,$_POST["phone"]));
        $password=trim(mysqli_real_escape_string($conn,$_POST["password"]));
        $role=$_POST["role"];

        $query="SELECT * FROM workers WHERE email='$email' OR phoneNos='$phone' OR workerId='$id'";
        $result=mysqli_query($conn,$query);

        if(mysqli_num_rows($result)==0){
            $password= password_hash($password, PASSWORD_DEFAULT);
            $query= "INSERT INTO workers (workerId,fullName,email,phoneNos,`password`,`role`) VALUES ('$id','$fname' ,'$email','$phone','$password','$role')";

            if(mysqli_query($conn, $query)){
                header("Location: ./admindashboard.php");
                exit();
            }


        }else{
            $error="ID,phone number or email is taken";
        }

    mysqli_close($conn);
   }
}
?>

    <main>
    <h1>Create Account</h1>
    <p id="first">Please fill in your details</p>
    <form action="" method="POST" onSubmit="return passwordValidate(this)">
    <div id="errorMessage2"><?php echo $error?></div>
        <fieldset>
            <legend>Personal Details</legend>
            <label for="1">Full Name:</label>
            <input type="text" required name="fname" maxlength="45" placeholder="John Macklemore" id="1" value="<?php echo $fname?>">
            <label for="2">Worker ID:</label>
            <input type="text" required name="id" maxlength="7" minlength="7" placeholder="530988" id="2" value="<?php echo $id?>">
            <label for="3">Email:</label>
            <input type="email" required name="email"  placeholder="macklemorecomplains@gmail.com" id="3" value="<?php echo $email?>">
            <label for="5">Phone Nos:</label>
            <input type="tel" required name="phone"  placeholder="=234 909 678 8979" id="5" value="<?php echo $phone?>">


        </fieldset>
        <fieldset>
            <label for="6">Nature of Work:</label>
            <select name="role" id="6">
                <option value="Electrician" selected>Electrician</option>
                <option value="Plumber">Plumber</option>
                <option value="Aluminum" >Aluminum</option>
                <option value="Carpenter" >Carpenter</option>

            </select>
        </fieldset>
        <fieldset>
            <legend>Create Password</legend>           
            <label for="7">Password:</label>
            <input type="password" required name="password"  id="7" minlength="7" >
            <label for="8">Confirm Password:</label>
            <input type="password" required name="confirmPassword"  id="8">
            <div id="errorMessage1"></div>
        </fieldset>
        <input type="checkbox" required  id="terms" class="exception">
        <label for="terms" class="exception">I accept the <a href="#">terms and conditions</a></label>
    
        <input type="submit" value="Sign Up" name="signup">
        
    </form>
    </main>
    

    <script src="../js/confirmpassworderror.js"></script>
    <script src="../js/alreadyexisterror.js"></script>
</body>
</html>