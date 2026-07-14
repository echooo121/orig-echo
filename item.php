<?php 
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}
require('db(be).php');

if (!isset($_GET['id'])) {
    header('Location: collections.php');
    exit;
}

$item_id = mysqli_real_escape_string($conn, $_GET['id']);
$message = "";
$type = "";

if (isset($_GET['added'])) {
    $message = "Item added to cart!";
    $type = "success";
}

$result = mysqli_query($conn, "SELECT * FROM items WHERE item_id = '$item_id'");
$item = mysqli_fetch_assoc($result);

if (!$item) {
    header('Location: buyerCollections.php');
    exit;
}

$extensions = ['jpg', 'jpeg', 'png', 'gif'];
$image_path = "";
foreach ($extensions as $ext) {
    if (file_exists("admin/uploads/" . $item_id . "." . $ext)) {
        $image_path = "admin/uploads/" . $item_id . "." . $ext;
        break;
    }
}

require 'header.php';
?>
    <div class="container" style="margin-top:3rem; margin-bottom:3rem;">

        <a href="buyerCollections.php" class="btn btn-secondary" style="margin-bottom:2rem;">Back to Collections</a>

        <?php if (!empty($message)): ?>
            <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:start;">

            <div>
                <?php if ($image_path): ?>
                    <img src="<?php echo $image_path; ?>" style="width:100%; border-radius:15px; box-shadow:var(--shadow);" alt="<?php echo htmlspecialchars($item['item_name']); ?>">
                <?php else: ?>
                    <div style="width:100%; height:400px; background:var(--secondary-color); border-radius:15px; display:flex; align-items:center; justify-content:center; color:var(--text-light);">No image</div>
                <?php endif; ?>
            </div>

            <div>
                <span style="display:inline-block; background:#F7EAF2; color:var(--accent-color); padding:.4rem 1rem; border-radius:999px; font-size:.8rem; font-weight:600; margin-bottom:1rem;"><?php echo htmlspecialchars($item['category']); ?></span>

                <h1 style="font-size:2rem; margin-bottom:1rem;"><?php echo htmlspecialchars($item['item_name']); ?></h1>

                <p style="font-size:1.8rem; font-weight:700; color:var(--accent-color); font-family:var(--heading-font); margin-bottom:1.5rem;">₱<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></p>

                <p style="color:var(--text-color); margin-bottom:.5rem;">
                    <strong><?php echo (int)$item['quantity'] > 0 ? $item['quantity'] . ' in stock' : 'Out of stock'; ?></strong>
                </p>

                <?php if ((int)$item['quantity'] > 0): ?>
                    <form action="addtocart.php" method="POST" style="margin-top:1.5rem; display:flex; align-items:center; gap:1rem;">
                        <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item_id); ?>">

                        <input type="number" name="quantity" value="1" min="1" max="<?php echo htmlspecialchars($item['quantity']); ?>" style="width:80px; padding:.9rem; border:1px solid var(--border-color); border-radius:50px; text-align:center; font-family:var(--body-font); font-size:1rem;">

                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                <?php else: ?>
                    <button class="btn btn-secondary" disabled style="opacity:.5; cursor:not-allowed;">Out of Stock</button>
                <?php endif; ?>
            </div>

        </div>

    </div>
<?php require 'footer.php'; ?>