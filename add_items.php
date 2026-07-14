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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['item_name'] && $_POST['category'] && $_POST['price'] && $_POST['quantity'] != ''){
         $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        
        $sql = "INSERT INTO items (item_name, category, price, quantity) VALUES ('$item_name', '$category', '$price', '$quantity')";
        
        if (mysqli_query($conn, $sql)) {
            $item_id = mysqli_insert_id($conn);
            //audit
            $action="Inserted an item";
            $target="Item Table";
            $data=$category.' (ID = '.$item_id.')';
            $sqlaudit = "INSERT INTO audit_log (user, user_name, action, target, data) VALUES ('$user', '$user_name', '$action', '$target', '$data')";
            mysqli_query($conn,$sqlaudit);
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
                $allowed = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif',);
                $max_size = 2 * 1024 * 1024; 
                $file_type = $_FILES['photo']['type'];
                $file_size = $_FILES['photo']['size'];

                if(!in_array($file_type, $allowed)) {
                    $message = "Invalid file; Only image file is accepted.";
                    $type = "danger";
                } elseif($file_size > $max_size) {
                    $message = "Image file is too large (2MB max).";
                    $type = "danger";
                } else {            
                    $upload_dir = "admin/uploads/";
                    if(!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
                    
                    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                    
                    $filename = $item_id . "." . $ext;
                    
                    $destination = $upload_dir . $filename;
                    
                    if(move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
                        $photo = $filename;
                    } else {
                        $message = "File upload failed.";
                        $type = "danger";
                    }
                }
            }
            header('Location: items.php');
            exit;
        }
        else {
            $message = "Error: " . mysqli_error($conn);
            $type = "danger";
        }
    }
    else{
        $message = "Error: Please fill out all fields";
        $type = "danger";
    }
   
}
require 'header.php';
?>
<div class="container">
    <a href="manage_items.php" class="btn btn-primary" style="margin-top:2rem;">Back</a>
    <div class="register_card" style="max-width:500px; margin-top:1rem; margin-bottom:1.5rem;">
        <h2 style="margin-top:1rem; margin-bottom:1rem;">Add New Item</h2>
        <?php if ($message): ?>
            <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
       <form action="add_items.php" method="POST" class="register_form" enctype="multipart/form-data" novalidate>
            <div class="input">                   
                <input type="text" name="item_name" placeholder="Item Name" value="<?php echo isset($item_name) ? htmlspecialchars($item_name) : ''; ?>" required>
            </div>
            <select name="category" style="width:100%; padding:1rem 3rem; background:var(--container-color); border:1px solid var(--border-color); border-radius:50px; color:var(--text-light); font-family:var(--body-font); font-size:1rem;" required>
                <option value="">-- Select Category --</option>
                <option value="Tote Bags" style="color:var(--title-color);">Tote Bags</option>
                <option value="Crossbody Bags" style="color:var(--title-color);">Crossbody Bags</option>
                <option value="Sling Bags" style="color:var(--title-color);">Sling Bags</option>
           </select>     
            <div class="input">               
                <input type="text" name="price" placeholder="Price" required>
            </div>
            <div class="input">                   
                <input type="text" name="quantity" placeholder="Quantity" required>
            </div>
            <div style="position:relative; display:flex; align-items:center; width:100%; padding:1rem 1.2rem; background:var(--container-color); border:1px dashed var(--border-color); border-radius:8px;color:var(--text-light); font-size:.875rem; cursor:pointer; margin-bottom:1rem;">
                <input type="file" name="photo" accept="image/*" onchange="document.getElementById('fileText').innerText = this.files.length ? this.files[0].name : 'Click to upload or drag and drop'" style="position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; margin-left:3rem;">
                <div style="display:flex; align-items:center; gap:.8rem; color:var(--text-light); font-size:.875rem; pointer-events:none;">
                    <span id="fileText">Click to upload or drag and drop</span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary register_btn">Add</button>
        </form>
    </div>
</div>
<?php require 'footer.php'; ?>