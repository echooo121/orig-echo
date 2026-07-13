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
            <a href="users.php" class="btn btn-secondary">
                View Users
            </a>
        </div>
        <h2 style="margin-top:2rem;">Manage User Roles</h2>
        <p style="margin-left:25rem;">Filter by:</p>
        <form action="manage_users.php" method="POST" style="margin-left:25rem;">
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
                   <th>User Type</th>
                   <th>Change Role</th>
               </tr>
           </thead>
           <tbody>
               <?php
               $sql = "SELECT * FROM users";
               if ($filterType !== 'All') {
                   $safeFilter = mysqli_real_escape_string($conn, $filterType);
                   $sql .= " WHERE user_type = '$safeFilter'";
               }
               $result = mysqli_query($conn, $sql);

               while ($row = mysqli_fetch_assoc($result)) {
                   echo "<tr>";
                   echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['user_type']) . "</td>";
                   echo "<td>
                           <form action='update_role.php' method='POST' style='display:flex; gap:.5rem; justify-content:center;'>
                               <input type='hidden' name='user_id' value='" . htmlspecialchars($row['user_id']) . "'>
                               <select name='new_type'>
                                   <option value='Buyer' " . ($row['user_type']==='Buyer' ? 'selected' : '') . ">Buyer</option>
                                   <option value='Admin' " . ($row['user_type']==='Admin' ? 'selected' : '') . ">Admin</option>
                               </select>
                               <button type='submit' class='btn btn-primary' style='padding:.4rem 1rem;'>Update</button>
                           </form>
                         </td>";
                   echo "</tr>";
               }
               ?>
           </tbody>
        </table>
    </div>
<?php require 'footer.php';?>