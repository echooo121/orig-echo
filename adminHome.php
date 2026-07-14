<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.php');
    die();
}
require 'header.php';
?>
    <div class="container" style = "margin-top: 3rem;">
        <h2 style = "text-align:center;">Welcome back, <b style = "color: var(--accent-color);"><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></b>!</h2>
        <p style = "text-align:center;">Monitor project metrics, manage inventory levels for modular bags, and <br>track user registrations from this central hub.</p>
    </div>
    <div class="container" style = "width: 50%;">
        <div style="margin-top: 3rem;">
            <div class="frontindex-container">
                <a href="users.php" class="admin_card">
                    <span style = "margin-left: 1rem;"><?php include 'admin/assets/users.svg'; ?></span>
                    <span style = "margin-left: 3.5rem; font-size: 20pt;">Users</span>
                </a>
                <a href="items.php" class="admin_card">
                    <span style = "margin-left: 1rem;"><?php include 'admin/assets/items.svg'; ?></span>
                    <span style = "margin-left: 3.5rem; font-size: 20pt;">Items</span>
                </a>
                <a href="audit_log.php" class="admin_card">
                    <span style = "margin-left: 1rem;"><?php include 'admin/assets/audit_log.svg'; ?></span>
                    <span style = "margin-left: 3.5rem; font-size: 20pt;">Audit Log</span>
                </a>
                <a href="logout.php" class="admin_card" style = "background-color: var(--accent-color);">
                    <span style = "margin-left: 1rem;"><?php include 'admin/assets/logout.svg'; ?></span>
                    <span style = "margin-left: 3.5rem; font-size: 20pt;">Logout</span>
                </a>
            </div>
        </div>
    </div>
<?php require 'footer.php'; ?>