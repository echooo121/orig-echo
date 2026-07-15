<?php 
session_start();
require('db(be).php');
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.php');
    die();
}
require ('header.php');
$filterType = isset($_POST['selectType']) ? $_POST['selectType'] : 'All';
$extensions = ['jpg', 'jpeg', 'png', 'gif'];
?>
    <div class="container">
        <div style="display:flex;justify-content: space-between; margin-top:3rem;">
            <a href="adminHome.php" class="btn btn-primary">
                Back
            </a>
            <a href="manage_items.php" class="btn btn-secondary">
                Manage Items
            </a>
        </div>
        <p style="margin-left:25rem;">Filter by:</p>
        <form action="items.php" method="POST" style="margin-left:25rem;">
           <select name="selectType">
                <option value="All" <?php echo ($filterType === 'All') ? 'selected' : ''; ?>>All</option>
                <option value="Tote Bags" <?php echo ($filterType === 'Tote Bags') ? 'selected' : ''; ?>>Tote Bags</option>
                <option value="Crossbody Bags" <?php echo ($filterType === 'Crossbody Bags') ? 'selected' : ''; ?>>Crossbody Bags</option>
                <option value="Sling Bags" <?php echo ($filterType === 'Sling Bags') ? 'selected' : ''; ?>>Sling Bags</option>
           </select>
           <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <table style="margin-top: 1.5rem;">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Image</th>
                   <th>Item Name</th>
                   <th>Category</th>
                   <th>Price</th>
                   <th>Quantity</th>
               </tr>
           </thead>
           <tbody>
               <?php
               $filterType = isset($_POST['selectType']) ? $_POST['selectType'] : 'All';
               $sql = "SELECT * FROM items";

               if ($filterType !== 'All') {
                   $sql .= " WHERE category = '$filterType'";
               }
               $_SESSION['filterType'] = $filterType;
               $result = mysqli_query($conn, $sql);
               while ($row = mysqli_fetch_assoc($result)){
                   echo "<tr>";
                   echo "<td>" . htmlspecialchars($row['item_id']) . "</td>";
                   foreach($extensions as $ext) {
                        if(file_exists("admin/uploads/" . $row['item_id'] . "." . $ext)) {
                            echo "<td><img src='admin/uploads/" . htmlspecialchars($row['item_id']) . "." . $ext . "' style='width:100px; height:auto;'></td>";
                            break;
                        }
                    }
                   echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                   echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                   echo "<td>" . "₱".htmlspecialchars($row['price']). "</td>";
                   echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                   echo "</tr>";
               }
               ?>
           </tbody>
        </table>
    </div>
<?php require 'footer.php';?>