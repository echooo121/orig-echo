<?php 
session_start();
require('db(be).php');
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.php');
    die();
}
require 'header.php';
$filterType = isset($_POST['selectType']) ? $_POST['selectType'] : 'All';
?>
    <div class="container">
        <div style="display:flex;justify-content: space-between; margin-top:3rem;">
            <a href="adminHome.php" class="btn btn-primary">
                Back
            </a>
            <a href="manage_users.php" class="btn btn-secondary">
                Manage Users
            </a>
        </div>
        <p style="margin-left:25rem;">Filter by:</p>
        <form action="users.php" method="POST" style="margin-left:25rem;">
           <select name="selectType">
                <option value="All" <?php echo ($filterType === 'All') ? 'selected' : ''; ?>>All</option>
                <option value="Buyer" <?php echo ($filterType === 'Buyer') ? 'selected' : ''; ?>>Buyer</option>
                <option value="Admin" <?php echo ($filterType === 'Admin') ? 'selected' : ''; ?>>Admin</option>
           </select>
           <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <table style="margin-top: 1.5rem;">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>First Name</th>
                   <th>Last Name</th>
                   <th>Email</th>
                   <th>Address</th>
                   <th>Contact</th>
                   <th>User Type</th>
               </tr>
           </thead>
           <tbody>
               <?php
               $filterType = isset($_POST['selectType']) ? $_POST['selectType'] : 'All';
               $sql = "SELECT * FROM users";

               if ($filterType !== 'All') {
                   $sql .= " WHERE user_type = '$filterType'";
               }
               $_SESSION['filterType'] = $filterType;
               $result = mysqli_query($conn, $sql);
               while ($row = mysqli_fetch_assoc($result)) {
                   echo "<tr>";
                   echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['user_type']) . "</td>";
                   echo "</tr>";
               }
               ?>
           </tbody>
        </table>
    </div>
<?php require 'footer.php';?>
