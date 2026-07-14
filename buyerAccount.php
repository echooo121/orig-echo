<?php 
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}
require('db(be).php');

$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'");
$user = mysqli_fetch_assoc($result);

require 'header.php';
?>
    <div class="container" style="margin-top:3rem; margin-bottom:3rem;">

        <div style="display:flex; justify-content:center; gap:2rem; margin-bottom:2rem; padding-bottom:1rem; border-bottom:1px solid var(--border-color);">
            <a href="buyerHome.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Home</a>
            <a href="buyerCollections.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Collections</a>
            <a href="buyerCart.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Cart</a>
            <a href="account.php" style="font-family:var(--heading-font); font-weight:600; color:var(--primary-color); border-bottom:2px solid var(--primary-color); padding-bottom:.5rem;">Account</a>
        </div>

        <div class="register_card" style="max-width:600px; margin:0 auto;">

            <h2 style="text-align:center; margin-bottom:.5rem;">My Account</h2>
            <p style="text-align:center; color:var(--text-light); margin-bottom:2rem;">Your personal information on file with Echo System.</p>

            <div style="display:flex; flex-direction:column; gap:1.2rem;">

                <div class="input" style="display:flex;justify-content:space-between;cursor:default;">
                    <span style="font-size:1rem; color:var(--text-light); display:block; margin-bottom:.2rem;">First Name:</span>
                    <span style="font-weight:600; color:var(--title-color);"><?php echo ' '.htmlspecialchars($user['first_name']); ?></span>
                </div>

                <div class="input" style="display:flex;justify-content:space-between;cursor:default;">
                    <span style="font-size:1rem; color:var(--text-light); display:block; margin-bottom:.2rem;">Last Name:</span>
                    <span style="font-weight:600; color:var(--title-color);"><?php echo ' '.htmlspecialchars($user['last_name']); ?></span>
                </div>

                <div class="input" style="display:flex;justify-content:space-between;cursor:default;">
                    <span style="font-size:1rem; color:var(--text-light); display:block;">Email:</span>
                    <span style="font-weight:600; color:var(--title-color);"><?php echo ' '.htmlspecialchars($user['email']); ?></span>
                </div>

                <div class="input" style="display:flex;justify-content:space-between;cursor:default;">
                    <span style="font-size:1rem; color:var(--text-light); display:block; margin-bottom:.2rem;">Address:</span>
                    <span style="font-weight:600; color:var(--title-color);"><?php echo ' '.htmlspecialchars($user['address']); ?></span>
                </div>

                <div class="input" style="display:flex;justify-content:space-between;cursor:default;">
                    <span style="font-size:1rem; color:var(--text-light); display:block; margin-bottom:.2rem;">Contact Number:</span>
                    <span style="font-weight:600; color:var(--title-color);"><?php echo ' '.htmlspecialchars($user['contact']); ?></span>
                </div>

                <div class="input" style="display:flex;justify-content:space-between;cursor:default;">
                    <span style="font-size:1rem; color:var(--text-light); display:block; margin-bottom:.2rem;">User ID:</span>
                    <span style="font-weight:600; color:var(--title-color);"><?php echo ' '.htmlspecialchars($user['user_id']); ?></span>
                </div>

            </div>

            <div style="display:flex; justify-content:center; margin-top:2.5rem;">
                <a href="logout.php" class="btn btn-primary" style="background:var(--accent-color); border-color:var(--accent-color);">Logout</a>
            </div>

        </div>

    </div>
<?php require 'footer.php'; ?>