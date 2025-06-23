<?php 
session_start();
require "./workernavbar.php";
require_once "../dblink.php";



if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["complete"])){
        $worker=($_SESSION["id"]);
        $id=$_POST["id"];
        $query="UPDATE complaints SET `status` = 'completed', workerId='$worker' WHERE complaintId=$id";
        mysqli_query($conn, $query);
    }
}
$query = "SELECT `role` FROM workers WHERE workerId='{$_SESSION['id']}'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$_SESSION['type'] = $row[0];

$query = "SELECT c.*,s.roomNos
FROM complaints c
LEFT JOIN students s ON c.studentId = s.studentId
WHERE `type`='{$_SESSION['type']}' AND approved =1 AND `status`='pending'";
$result=mysqli_query($conn,$query);

$query2 = "SELECT * FROM complaints WHERE workerId='{$_SESSION['id']}' AND `status` ='completed'";
$result2=mysqli_query($conn,$query2);
?>


<section id="quick-view">
        <div id="q1">
            <span><?php echo mysqli_num_rows($result);?></span>
            <p>Pending Complaints</p>
        </div>
        <div id="q2">
        <span><?php echo mysqli_num_rows($result2);?></span>
        <p>Complaints Completed</p>
        </div>
    </section>
    <section class="table-container">
        <table id="pending-table">
            <caption>Pending Complaints</caption>
            <thead>
                <th>Complaint</th>
                <th>Status</th>
                <th>Room Nos</th>
                <th>Complete</th>
                <th>Date Added</th>
            </thead>
            <tbody>

            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                $idd=$row['complaintId']; 
           ?>
                <tr>
                <td><?php echo $row["complaint"] ?></td>
                <td><?php echo $row["status"] ?></td>
                
                <td><?php echo $row["roomNos"] ?></td>
                <td><button id="approve-button" onclick="showForm('<?php echo $idd ?>')">Complete</button>
                
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
    <form method='POST' action='' id="pop-up">
    <input type='hidden' name='id' id="complaintIdfield">
    <p>Mark Complaint as completed</p>
    <input type='submit' name='complete' value='Complete'>
    </form>
    
    <script src="../js/pop-upworker.js"></script>
</section>
</body>
</html>