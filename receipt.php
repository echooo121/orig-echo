<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}

if (!isset($_SESSION['last_order'])) {
    header('Location: buyerHome.php');
    exit;
}

$order = $_SESSION['last_order'];

require 'header.php';
?>
    <div class="container" style="margin-top:3rem; margin-bottom:3rem;">

        <div class="register_card" style="max-width:600px; margin:0 auto;">

            <div style="text-align:center; margin-bottom:2rem;">
                <h2 style="color:var(--accent-color); margin-bottom:.5rem;">Order Receipt</h2>
                <p style="color:var(--text-light);">Thank you for your purchase!</p>
            </div>

            <div style="display:flex; justify-content:space-between; padding-bottom:1rem; margin-bottom:1rem; border-bottom:1px solid var(--border-color);">
                <span style="color:var(--text-light);">Order ID</span>
                <span style="font-weight:600;"><?php echo htmlspecialchars($order['order_id']); ?></span>
            </div>

            <div style="display:flex; justify-content:space-between; padding-bottom:1rem; margin-bottom:1rem; border-bottom:1px solid var(--border-color);">
                <span style="color:var(--text-light);">Date</span>
                <span style="font-weight:600;"><?php echo htmlspecialchars($order['date']); ?></span>
            </div>

            <div style="display:flex; justify-content:space-between; padding-bottom:1rem; margin-bottom:1rem; border-bottom:1px solid var(--border-color);">
                <span style="color:var(--text-light);">Shipping Address</span>
                <span style="font-weight:600; text-align:right;"><?php echo htmlspecialchars($order['shipping_address']); ?></span>
            </div>

            <div style="display:flex; justify-content:space-between; padding-bottom:1.5rem; margin-bottom:1.5rem; border-bottom:1px solid var(--border-color);">
                <span style="color:var(--text-light);">Contact</span>
                <span style="font-weight:600;"><?php echo htmlspecialchars($order['contact']); ?></span>
            </div>

            <h3 style="margin-bottom:1rem;">Items</h3>
            <?php foreach ($order['items'] as $item): ?>
            <div style="display:flex; justify-content:space-between; padding:.6rem 0;">
                <span><?php echo htmlspecialchars($item['item_name']); ?> <span style="color:var(--text-light);">x<?php echo $item['quantity']; ?></span></span>
                <span style="font-weight:600;">₱<?php echo number_format($item['subtotal'], 2); ?></span>
            </div>
            <?php endforeach; ?>

            <div style="display:flex; justify-content:space-between; padding-top:1.5rem; margin-top:1rem; border-top:2px solid var(--border-color);">
                <span style="font-size:1.3rem; font-weight:700;">Total</span>
                <span style="font-size:1.3rem; font-weight:700; color:var(--accent-color);">₱<?php echo number_format($order['total'], 2); ?></span>
            </div>

            <div style="display:flex; justify-content:center; margin-top:2.5rem;">
                <a href="buyerCollections.php" class="btn btn-primary">Continue Shopping</a>
            </div>

        </div>

    </div>
<?php require 'footer.php'; ?>