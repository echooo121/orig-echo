<?php 
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}
require 'header.php';?>
     <div class="container" style="margin-top:3rem; background: ">
        <h2 style="text-align:center;">Welcome, <b style="color:var(--accent-color);"><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></b>!</h2>

        <div style="display:flex; justify-content:center; gap:2rem; margin-top:1.5rem; padding-bottom:1rem; border-bottom:1px solid var(--border-color);">
            <a href="buyerHome.php" style="font-family:var(--heading-font); font-weight:600; color:var(--primary-color); border-bottom:2px solid var(--primary-color); padding-bottom:.5rem;">Home</a>
            <a href="buyerCollections.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Collections</a>
            <a href="buyerCart.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Cart</a>
            <a href="buyerAccount.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Account</a>
        </div>

        <h3 style="margin-top:2.5rem; margin-bottom:1.5rem;color:var(--text-light);">Categories</h3>

        <div class="frontindex-container" style="grid-template-columns:repeat(3, 1fr); gap:2rem;">
            <a href="collections.php?category=Tote Bags" class="admin_card" style="background: #ffffff; flex-direction:column; align-items:center; justify-content:center; height:280px; padding:0;color: var(--text-color); font-size:var(--h2-font);text-align:center;">
                <span>
                    <img src=admin/uploads/2.jpg style = "width:300px; height:auto; border-radius: var(--radius-md);">
                    Tote Bags
                </span>
            </a>
            <a href="collections.php?category=Crossbody Bags" class="admin_card" style="background: #ffffff;flex-direction:column; align-items:center; justify-content:center; height:280px; padding:0;color: var(--text-color); font-size:var(--h2-font);text-align:center;">
                <img src=admin/uploads/3.jpg style = "width:300px; height:auto; border-radius: var(--radius-md);">
                <span>Crossbody Bags</span>
            </a>
            <a href="collections.php?category=Sling Bags" class="admin_card" style="background: #ffffff;flex-direction:column; align-items:center; justify-content:center; height:280px; padding:0;color: var(--text-color); font-size:var(--h2-font);text-align:center;">
                <img src=admin/uploads/10.jpg style = "width:300px; height:auto; border-radius: var(--radius-md);">
                <span>Sling Bags</span>
            </a>
        </div>
    </div>
<?php require 'footer.php';?>