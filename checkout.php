<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}
require('db(be).php');

if (empty($_SESSION['cart'])) {
    header('Location: buyerCart.php');
    exit;
}

$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'");
$user = mysqli_fetch_assoc($result);

$message = "";
$type = "";

$cart_items = array();
$total = 0;

foreach ($_SESSION['cart'] as $item_id => $qty) {
    $item_id_safe = mysqli_real_escape_string($conn, $item_id);
    $item_result = mysqli_query($conn, "SELECT * FROM items WHERE item_id = '$item_id_safe'");
    $item = mysqli_fetch_assoc($item_result);

    if (!$item) continue;

    $subtotal = $item['price'] * $qty;
    $total += $subtotal;

    $cart_items[] = array(
        'item_id' => $item_id,
        'item_name' => $item['item_name'],
        'price' => $item['price'],
        'quantity' => $qty,
        'subtotal' => $subtotal
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shipping_address = mysqli_real_escape_string($conn, $_POST['shipping_address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    if (empty($shipping_address) || empty($contact)) {
        $message = "Please fill in all shipping details.";
        $type = "danger";
    } else {
        
        foreach ($cart_items as $ci) {
            $ci_id = mysqli_real_escape_string($conn, $ci['item_id']);
            $ci_qty = (int) $ci['quantity'];
            mysqli_query($conn, "UPDATE items SET quantity = quantity - $ci_qty WHERE item_id = '$ci_id'");
        }

        $_SESSION['last_order'] = array(
            'order_id' => "ORD" . time() . rand(100, 999),
            'items' => $cart_items,
            'total' => $total,
            'shipping_address' => $_POST['shipping_address'],
            'contact' => $_POST['contact'],
            'date' => date('F d, Y g:i A')
        );

        // clear cart
        $_SESSION['cart'] = array();

        header('Location: receipt.php');
        exit;
    }
}

require 'header.php';
?>
    <div class="container" style="margin-top:3rem; margin-bottom:3rem;">

        <a href="buyerCart.php" class="btn btn-secondary" style="margin-bottom:2rem;">Back to Cart</a>

        <h2 style="margin-bottom:2rem;">Checkout</h2>

        <?php if (!empty($message)): ?>
            <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <div style="display:grid; grid-template-columns:1.2fr 1fr; gap:3rem; align-items:start;">

            <div class="register_card">
                <h3 style="margin-bottom:1.5rem;">Shipping Details</h3>

                <form action="checkout.php" method="POST" style="display:flex; flex-direction:column; gap:1.2rem;">
                    <div class="input">
                        <input type="text" name="shipping_address" placeholder="Shipping Address" value="<?php echo isset($_POST['shipping_address']) ? htmlspecialchars($_POST['shipping_address']) : htmlspecialchars($user['address']); ?>" required>
                    </div>
                    <div class="input">
                        <input type="text" name="contact" placeholder="Contact Number" value="<?php echo isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) : htmlspecialchars($user['contact']); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-top:1rem;">Place Order</button>
                </form>
            </div>

            <div class="register_card">
                <h3 style="margin-bottom:1.5rem;">Order Summary</h3>

                <?php foreach ($cart_items as $ci): ?>
                <div style="display:flex; justify-content:space-between; padding:.8rem 0; border-bottom:1px solid var(--border-color);">
                    <span><?php echo htmlspecialchars($ci['item_name']); ?> <span style="color:var(--text-light);">x<?php echo $ci['quantity']; ?></span></span>
                    <span style="font-weight:600;">₱<?php echo number_format($ci['subtotal'], 2); ?></span>
                </div>
                <?php endforeach; ?>

                <div style="display:flex; justify-content:space-between; padding-top:1.5rem; margin-top:.5rem;">
                    <span style="font-size:1.2rem; font-weight:700;">Total</span>
                    <span style="font-size:1.2rem; font-weight:700; color:var(--accent-color);">₱<?php echo number_format($total, 2); ?></span>
                </div>
            </div>

        </div>

    </div>
<?php require 'footer.php'; ?>