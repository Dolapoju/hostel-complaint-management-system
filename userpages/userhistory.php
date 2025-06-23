<?php
session_start();
require "./usernavbar.php";
require_once "../dblink.php";

$query =
    "SELECT c.*, w.fullName 
    FROM complaints c
    LEFT JOIN workers w ON c.workerId = w.workerId
    WHERE c.studentId = '{$_SESSION['id']}' AND c.approved = 1";

$result=mysqli_query($conn,$query);
?>
<section class="table-container">
        <table id="history-table">
            <caption>Complaint History</caption>
            <thead>
                <th>Complaint</th>
                <th>Status</th>
                <th>Worker</th>
                <th>Date Completed</th>
            </thead>
            <tbody>

            <?php
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                <td><?php echo $row["complaint"] ?></td>
                <td><?php echo $row["status"] ?></td>
                <td><?php echo $row["fullName"] ?></td>
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