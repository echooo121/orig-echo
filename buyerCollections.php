<?php 
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}
require('db(be).php');

$filterType = isset($_GET['category']) ? $_GET['category'] : 'All';

require 'header.php';
?>
    <div class="container" style="margin-top:3rem; margin-bottom:3rem;">

        <div style="display:flex; justify-content:center; gap:2rem; margin-bottom:2rem; padding-bottom:1rem; border-bottom:1px solid var(--border-color);">
            <a href="buyerHome.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Home</a>
            <a href="buyerCollections.php" style="font-family:var(--heading-font); font-weight:600; color:var(--primary-color); border-bottom:2px solid var(--primary-color); padding-bottom:.5rem;">Collections</a>
            <a href="buyerCart.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Cart</a>
            <a href="buyerAccount.php" style="font-family:var(--heading-font); font-weight:600; color:var(--text-light);">Account</a>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h2><?php echo $filterType === 'All' ? 'Collections' : htmlspecialchars($filterType); ?></h2>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:2rem;">
            <?php
            $sql = "SELECT * FROM items";
            if ($filterType !== 'All') {
                $safeFilter = mysqli_real_escape_string($conn, $filterType);
                $sql .= " WHERE category = '$safeFilter'";
            }
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 0) {
                echo "<p style='color:var(--text-light); grid-column:1/-1; text-align:center; padding:3rem 0;'>No items found in this category.</p>";
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $item_id = $row['item_id'];
                $extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $image_path = "";
                foreach ($extensions as $ext) {
                    if (file_exists("admin/uploads/" . $item_id . "." . $ext)) {
                        $image_path = "admin/uploads/" . $item_id . "." . $ext;
                        break;
                    }
                }

                echo "<a href='item.php?id=" . htmlspecialchars($item_id) . "' style='background:var(--container-color); border-radius:15px; box-shadow:var(--shadow); overflow:hidden; display:flex; flex-direction:column; transition:var(--transition);'>";

                if ($image_path) {
                    echo "<img src='" . $image_path . "' style='width:100%; height:220px; object-fit:cover;' alt='" . htmlspecialchars($row['item_name']) . "'>";
                } else {
                    echo "<div style='width:100%; height:220px; background:var(--secondary-color); display:flex; align-items:center; justify-content:center; color:var(--text-light); font-size:.85rem;'>No image</div>";
                }

                echo "<div style='padding:1.2rem;'>";
                echo "<span style='display:block; font-family:var(--heading-font); font-weight:600; color:var(--title-color); margin-bottom:.3rem;'>" . htmlspecialchars($row['item_name']) . "</span>";
                echo "<span style='display:block; font-size:.8rem; color:var(--text-light); margin-bottom:.5rem;'>" . htmlspecialchars($row['category']) . "</span>";
                echo "<span style='display:block; font-family:var(--heading-font); font-weight:700; color:var(--accent-color); font-size:1.1rem;'>₱" . htmlspecialchars(number_format($row['price'], 2)) . "</span>";
                echo "</div>";

                echo "</a>";
            }
            ?>
        </div>

    </div>
<?php require 'footer.php'; ?>