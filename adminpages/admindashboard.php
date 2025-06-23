<?php
session_start();
require "./adminnavbar.php";
require_once "../dblink.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["delete"])){
        $id=$_POST["id"];
        $query="DELETE FROM complaints WHERE complaintId = '$id'";
        mysqli_query($conn, $query);
    }elseif(isset($_POST["approve"])){
        $admin=($_SESSION["id"]);
        $id=$_POST["id"];
        $query="UPDATE complaints SET approved = 1, adminId='$admin' WHERE complaintId=$id";
        mysqli_query($conn, $query);
    }
}


$query = "SELECT c.*, s.fullName,s.roomNos
    FROM complaints c
    LEFT JOIN students s ON c.studentId = s.studentId
    WHERE c.approved = 0";
$result=mysqli_query($conn,$query);
$query2 = "SELECT * FROM complaints WHERE adminId='{$_SESSION['id']}' AND approved=1";
$result2=mysqli_query($conn,$query2);

?>
<section id="quick-view">
        <div id="q1">
            <span><?php echo mysqli_num_rows($result);?></span>
            <p>UnApproved Complaints</p>
        </div>
        <div id="q2">
        <span><?php echo mysqli_num_rows($result2);?></span>
        <p>Approved Complaints</p>
        </div>
</section>
<section class="table-container">
<table id="unapproved-table">
            <caption>Unapproved Complaints</caption>
            <thead>
                <th>Complaint</th>
                <th>Type</th>
                <th>Student</th>
                <th>Room Nos</th>
                <th>Approve</th>
                <th>Delete</th>
                <th>Date Added</th>
            </thead>
            <tbody>

            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                $idd=$row['complaintId']; 
           ?>
                <tr>
                <td><?php echo $row["complaint"] ?></td>
                <td><?php echo $row["type"] ?></td>
                <td><?php echo $row["fullName"] ?></td>
                <td><?php echo $row["roomNos"] ?></td>
                <td><button id="update-button" onclick="showForm('<?php echo $idd ?>')">Approve</button></td>
                <td>
                <button id="delete-button" onclick="showForm2('<?php echo $idd ?>')">Delete</button>
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
    <form method='POST' action='' id="pop-up1">
    <input type='hidden' name='id' id="complaintIdfield">
    <p>Are you sure you want to approve this complaint</p>
    <input type='submit' name='approve' value='Yes'>
    </form>

    <form method='POST' action='' id="pop-up2">
    <input type='hidden' name='id' id="complaintIdfield2">
    <p>Are you sure you want to delete this complaint</p>
    <input type='submit' name='delete' value='delete'>
    </form>
    <script src="../js/pop-upadmin.js"></script>

</body>
</html>