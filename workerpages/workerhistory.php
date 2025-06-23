<?php
session_start();
require "./workernavbar.php";
require_once "../dblink.php";

$query="SELECT c.*,s.roomNos, w.fullName
FROM complaints c
LEFT JOIN students s ON c.studentId = s.studentId
LEFT JOIN workers w ON c.workerId = w.workerId
WHERE `type`='{$_SESSION['type']}' AND `status`='completed'";
$result=mysqli_query($conn,$query);


?>


<section class="table-container">
<table id="history-table">
            <caption>Complaint History</caption>
            <thead>
                <th>Complaint</th>
                <th>Status</th>
                <th>RoomNos</th>
                <th>Worker</th>
                <th>Date Added</th>
                <th>Date Completed</th>
            </thead>
            <tbody>

            <?php
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                <td><?php echo $row["complaint"] ?></td>
                <td><?php echo $row["status"] ?></td>
                <td><?php echo $row["roomNos"] ?></td>
                <td><?php echo $row["fullName"] ?></td>
                
                <td><?php echo $row["dateAdded"] ?></td>
                <td><?php echo $row["dateCompleted"] ?></td>
                </tr>
                <?php
                }  
            ?>
            </tbody>
        </table>
</section>


    
</body>
</html>