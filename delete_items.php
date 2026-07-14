<?php 
session_start();
require('db(be).php');
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.php');
    die();
}
$message = "";
$type = "";
//for audit heh
$user=$_SESSION["user_id"];
$user_name=$_SESSION["first_name"]." ".$_SESSION["last_name"];
$action="";
$target="";
$data="";
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
     //audit item
    $categoryResult = mysqli_query($conn, "SELECT category from items where item_id = $item_id");
    $category_row = mysqli_fetch_assoc($categoryResult);
    $category = $category_row['category'];
    $check = mysqli_query($conn, "SELECT * FROM items WHERE item_id = '$item_id'");

    
    if (mysqli_num_rows($check) === 0) {
        $message = "No item found with that ID.";
        $type = "danger";
    } else {
        $sql = "DELETE FROM items WHERE item_id = '$item_id'";

        if (mysqli_query($conn, $sql)) {
            $message = "Item deleted successfully.";
            $type = "success";
            //audit
            $action="Deleted an item";
            $target="Item Table";
           
            $data=$category.' (ID = '.$item_id.')';
            $sqlaudit = "INSERT INTO audit_log (user, user_name, action, target, data) VALUES ('$user', '$user_name', '$action', '$target', '$data')";
            mysqli_query($conn, $sqlaudit);

        } else {
            $message = "Error: " . mysqli_error($conn);
            $type = "danger";
        }  
    }
}
?>
<div class="container">
    <a href="manage_items.php" class="btn btn-primary" style="margin-top:2rem;">Back</a>
    <div class="register_card" style="max-width:500px; margin-top:1.5rem;">
        <h2 style="margin-top:1rem; margin-bottom:1rem;">Delete Item</h2>
        <?php if ($message): ?>
            <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
       <form action="delete_items.php" method="POST" class="register_form" enctype="multipart/form-data" novalidate>
            <div class="input">                   
                <input type="text" name="item_id" placeholder="Item ID" required>
            </div>
            <button type="submit" class="btn btn-primary register_btn">Enter</button>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>