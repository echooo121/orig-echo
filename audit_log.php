<?php 
session_start();
require('db(be).php');
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.php');
    die();
}
require 'header.php';

?>
    <div class="container">
        <div style="display:flex;justify-content: space-between; margin-top:3rem;">
            <a href="adminHome.php" class="btn btn-primary">
                Back
            </a>
        </div>
        
        <table style="margin-top: 1.5rem;">
           <thead>
               <tr>
                   <th>User ID</th>
                   <th>Full Name</th>
                   <th>Action</th>
                   <th>Target</th>
                   <th>Data</th>
                   <th>Time</th>
               </tr>
           </thead>
           <tbody>
               <?php
               $sql = "SELECT * FROM audit_log";

               $result = mysqli_query($conn, $sql);
               while ($row = mysqli_fetch_assoc($result)) {
                   echo "<tr>";
                   echo "<td>" . htmlspecialchars($row['user']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['action']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['target']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['data']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['timestamp']) . "</td>";
                   echo "</tr>";
               }
               ?>
           </tbody>
        </table>
    </div>
<?php require 'footer.php';?>
