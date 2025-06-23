<?php
session_start();
require "./adminnavbar.php";
require_once "../dblink.php";

$query="SELECT 
    c.*, 
    a.fullName AS adminName, 
    s.roomNos, 
    w.fullName AS workerName
FROM 
    complaints c
LEFT JOIN 
    students s ON c.studentId = s.studentId
LEFT JOIN 
    admins a ON c.adminId = a.adminId
LEFT JOIN 
    workers w ON c.workerId = w.workerId
WHERE 
    c.approved = 1";
$result=mysqli_query($conn,$query);
?>
<section class="table-container">
<table id="history-table">
            <caption>Approved History</caption>
            <thead>
                <th>Complaint</th>
                <th>Status</th>
                <th>Date Completed</th>
                <th>Date Added</th>
                <th>Admin</th>
                <th>Room Nos</th>
                <th>Worker Name</th>
            </thead>
            <tbody>

            <?php
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                <td><?php echo $row["complaint"] ?></td>
                <td><?php echo $row["status"] ?></td>
                <td><?php echo $row["dateCompleted"] ?></td>
                <td><?php echo $row["dateAdded"] ?></td>
                <td><?php echo $row["adminName"] ?></td>
                <td><?php echo $row["roomNos"] ?></td>
                <td><?php echo $row["workerName"] ?></td>
                </tr>
                <?php
                }  
            ?>
            </tbody>
        </table>



</section>
</body>
</html>