<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}
require('db(be).php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $item_id => $qty) {
        $qty = (int) $qty;
        if ($qty < 1) {
            unset($_SESSION['cart'][$item_id]);
        } else {
            $_SESSION['cart'][$item_id] = $qty;
        }
    }
    header('Location: buyerCart.php');
    exit;
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    header('Location: cart.php');
    exit;
}

require 'header.php';

$total = 0;
?>
    <div class="container" style="margin-top:3rem; margin-bottom:3rem;">

        <div style="display:flex; justify-content:center; gap:2rem; margin-bottom:2rem; padding-bottom:1rem; border-bottom:1px solid var(--border-color);">
            <a href="buyerHome.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Home</a>
            <a href="buyerCollections.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Collections</a>
            <a href="buyerCart.php" style="font-family:var(--heading-font); font-weight:600; color:var(--primary-color); border-bottom:2px solid var(--primary-color); padding-bottom:.5rem;">Cart</a>
            <a href="buyerAccount.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Account</a>
        </div>

        <h2 style="margin-bottom:2rem;">My Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>

            <div style="text-align:center; padding:4rem 0; color:var(--text-light);">
                <p style="margin-bottom:1.5rem;">Your cart is empty.</p>
                <a href="buyerCollections.php" class="btn btn-primary">Browse Collections</a>
            </div>

        <?php else: ?>

            <form action="buyerCart.php" method="POST">

                <div class="table-wrapper" style="background:var(--container-color); border-radius:15px; box-shadow:var(--shadow); overflow:hidden;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="background:var(--primary-color);">
                                <th style="color:#fff; text-align:left; padding:1rem 1.5rem;">Item</th>
                                <th style="color:#fff; text-align:center; padding:1rem 1.5rem;">Price</th>
                                <th style="color:#fff; text-align:center; padding:1rem 1.5rem;">Quantity</th>
                                <th style="color:#fff; text-align:center; padding:1rem 1.5rem;">Subtotal</th>
                                <th style="color:#fff; text-align:center; padding:1rem 1.5rem;">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $item_id => $qty):
                                $item_id_safe = mysqli_real_escape_string($conn, $item_id);
                                $result = mysqli_query($conn, "SELECT * FROM items WHERE item_id = '$item_id_safe'");
                                $item = mysqli_fetch_assoc($result);

                                if (!$item) continue;

                                $subtotal = $item['price'] * $qty;
                                $total += $subtotal;

                                $extensions = ['jpg', 'jpeg', 'png', 'gif'];
                                $image_path = "";
                                foreach ($extensions as $ext) {
                                    if (file_exists("admin/uploads/" . $item_id . "." . $ext)) {
                                        $image_path = "admin/uploads/" . $item_id . "." . $ext;
                                        break;
                                    }
                                }
                            ?>
                            <tr style="border-bottom:1px solid var(--border-color);">
                                <td style="padding:1rem 1.5rem;">
                                    <div style="display:flex; align-items:center; gap:1rem;">
                                        <?php if ($image_path): ?>
                                            <img src="<?php echo $image_path; ?>" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                        <?php else: ?>
                                            <div style="width:60px; height:60px; background:var(--secondary-color); border-radius:8px;"></div>
                                        <?php endif; ?>
                                        <span style="font-weight:600; color:var(--title-color);"><?php echo htmlspecialchars($item['item_name']); ?></span>
                                    </div>
                                </td>
                                <td style="text-align:center; padding:1rem 1.5rem;">₱<?php echo number_format($item['price'], 2); ?></td>
                                <td style="text-align:center; padding:1rem 1.5rem;">
                                    <input type="number" name="quantities[<?php echo htmlspecialchars($item_id); ?>]" value="<?php echo (int)$qty; ?>" min="1" max="<?php echo (int)$item['quantity']; ?>" style="width:70px; padding:.6rem; border:1px solid var(--border-color); border-radius:50px; text-align:center;">
                                </td>
                                <td style="text-align:center; padding:1rem 1.5rem; font-weight:600; color:var(--accent-color);">₱<?php echo number_format($subtotal, 2); ?></td>
                                <td style="text-align:center; padding:1rem 1.5rem;">
                                    <a href="buyerCart.php?remove=<?php echo htmlspecialchars($item_id); ?>" style="color:var(--accent-color); font-weight:600;" onclick="return confirm('Remove this item from your cart?');">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:2rem;">
                    <button type="submit" name="update_cart" class="btn btn-secondary">Update Cart</button>

                    <div style="text-align:right;">
                        <p style="font-size:1.1rem; color:var(--text-color); margin-bottom:.5rem;">Total: <strong style="color:var(--accent-color); font-size:1.4rem;">₱<?php echo number_format($total, 2); ?></strong></p>
                        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                </div>

            </form>

        <?php endif; ?>

    </div>
<?php require 'footer.php'; ?>