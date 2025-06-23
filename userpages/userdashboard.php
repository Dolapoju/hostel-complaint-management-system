<?php
session_start();
require "./usernavbar.php";
require_once "../dblink.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["delete"])){
        $id=$_POST["id"];
        $query="DELETE FROM  complaints WHERE complaintId = '$id'";
        mysqli_query($conn, $query);
    }elseif(isset($_POST["submit"])){
        $complaint=trim(mysqli_real_escape_string($conn,$_POST["complaint"]));
        $type=$_POST["type"];
        $id=$_SESSION["id"];

        $query= "INSERT INTO complaints (complaint,studentId,`type`) VALUES ('$complaint','$id','$type')";
        mysqli_query($conn, $query);

    }elseif (isset($_POST["update"])) {
        
        $complaint = trim(mysqli_real_escape_string($conn, $_POST["complaint"]));
        $type = $_POST["type"];
        $complaintId = $_POST["complaintId"];
        $query = "UPDATE complaints SET complaint = '$complaint', `type` = '$type' WHERE complaintId = '$complaintId'";
        mysqli_query($conn, $query);
    }



}
$query = "SELECT * FROM complaints WHERE studentId='{$_SESSION['id']}' AND approved =0";
$result=mysqli_query($conn,$query);
$query2 = "SELECT * FROM complaints WHERE studentId='{$_SESSION['id']}'";
$result2=mysqli_query($conn,$query2);
?>
<section id="quick-view">
        <div id="q1">
            <span><?php echo mysqli_num_rows($result);?></span>
            <p>UnApproved Complaints</p>
        </div>
        <div id="q2">
        <span><?php echo mysqli_num_rows($result2);?></span>
        <p>Complaints made</p>
        </div>
        <div id="q3" onclick="showForm()">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><title/><g id="plus"><line class="cls-1" x1="16" x2="16" y1="7" y2="25"/><line class="cls-1" x1="7" x2="25" y1="16" y2="16"/></g></svg>
        <p>New complaint</p>
        </div>
    </section>
    <section class="table-container">
        <table id="unapproved-table">
            <caption>Unapproved Complaints</caption>
            <thead>
                <th>Complaint</th>
                <th>Status</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Date Added</th>
            </thead>
            <tbody>

            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                $comp=$row['complaint'];
                $idd=$row['complaintId'];
           ?>
                <tr>
                <td><?php echo $row["complaint"] ?></td>
                <td><?php echo $row["status"] ?></td>
                <td><button id="update-button" onclick="showForm2(`<?php echo $comp ?>`,'<?php echo $idd ?>')">Update</button></td>
                <td>
                <button id="delete-button" onclick="showForm3('<?php echo $idd ?>')">Delete</button>
                
                </td>
                <td><?php echo $row['dateAdded'] ?></td>
                </tr>
                <?php
                }

                
            ?>
            </tbody>
        </table>
    </section>
    <div class="overlay" onclick="hideForm()"></div>
    <form action="" method="POST" class="pop-up">
        <label for="20">Complaint:</label>
        <textarea name="complaint" maxlength="1200" id="20" placeholder="Write something..."></textarea>
            <div>
                <label class="options"><input value="Electrician" type="radio" name="type" checked >Electrician</option></label>
                <label class="options"><input value="Plumber" type="radio" name="type">Plumber</option></label>
                <label class="options"><input value="Aluminum" type="radio" name="type">Aluminum</option></label>
                <label class="options"><input value="Carpenter" type="radio" name="type">Carpenter</option></label>
            </div>
        <input type="submit" name="submit" value="Add Complaint">
    </form>
    <form action="" method="POST" class="pop-up2">
        <input type="hidden" name="complaintId" id="complaintIdfield">
        <label for="complaint-field">Complaint:</label>
        <textarea name="complaint" maxlength="1200" id="complaint-field" placeholder="Write something..."></textarea>
        <div>
                <label class="options"><input value="Electrician" type="radio" name="type" checked >Electrician</option></label>
                <label class="options"><input value="Plumber" type="radio" name="type">Plumber</option></label>
                <label class="options"><input value="Aluminum" type="radio" name="type">Aluminum</option></label>
                <label class="options"><input value="Carpenter" type="radio" name="type">Carpenter</option></label>
        </div>
        <input type="submit" name="update" value="Update Complaint">

    </form>
    <form method='POST' action='' class="pop-up3">
    <input type='hidden' name='id' id="complaintIdfield2">
    <p>Are you sure you want to delete this complaint</p>
    <input type='submit' name='delete' value='delete'>
    </form>
    
    <script src="../js/pop-up.js"></script>
</body>
</html>