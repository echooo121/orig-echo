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
    
    $column = $_POST['category'];
    $value = mysqli_real_escape_string($conn, $_POST['value']);

    $check = $categoryResult;
    if (mysqli_num_rows($check) === 0) {
        $message = "No item found with that ID.";
        $type = "danger";
    } else {
        if ($column !== 'item_name' && $column !== 'price' && $column !== 'quantity'){
            $message = "Please choose a category";
            $type = "danger";
        }
        else{
            $sql = "UPDATE items SET $column = '$value' WHERE item_id = '$item_id'";

            if (mysqli_query($conn, $sql)) {
                $message = "Item updated successfully.";
                $type = "success";
                //audit
                $action="Edited an item";
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
}
?>
<div class="container">
    <a href="manage_items.php" class="btn btn-primary" style="margin-top:2rem;">Back</a>
    <div class="register_card" style="max-width:500px; margin-top:1.5rem;">
        <h2 style="margin-top:1rem; margin-bottom:1rem;">Edit Item</h2>
        <?php if ($message): ?>
            <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
       <form action="edit_items.php" method="POST" class="register_form" enctype="multipart/form-data" novalidate>
            <div class="input">                   
                <input type="text" name="item_id" placeholder="Item ID" required>
            </div>
            <select name="category" style="width:100%; padding:1rem 3rem; background:var(--container-color); border:1px solid var(--border-color); border-radius:50px; color:var(--text-light); font-family:var(--body-font); font-size:1rem;" required>
                <option value="">-- Select Category --</option>
                <option value="item_name" style="color:var(--title-color);">Item Name</option>
                <option value="price" style="color:var(--title-color);">Item Price</option>
                <option value="quantity" style="color:var(--title-color);">Item Quantity</option>
           </select>     
            <div class="input">               
                <input type="text" name="value" placeholder="Value" required>
            </div>
            <button type="submit" class="btn btn-primary register_btn">Enter</button>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>
```