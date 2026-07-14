<?php 
session_start();
require('db(be).php');
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.php');
    die();
}
require ('header.php'); ?> 
    <div class="container">
        <div style="display:flex;justify-content: space-between; margin-top:3rem;">
            <a href="items.php" class="btn btn-primary">
                Back
            </a>
        </div> 
        <div style="margin-top: 10rem;">
            <div class="frontindex-container" style = "grid-template-columns: repeat(3, 1fr);">
                <a href="add_items.php" class="admin_card">
                    <span style = "margin-left: 1rem;"><?php include 'admin/assets/plus.svg'; ?></span>
                    <span style = "margin-left: 3.5rem; font-size: 20pt;">Add Items</span>
                </a>
                <a href="edit_items.php" class="admin_card">
                    <span style = "margin-left: 1rem;"><?php include 'admin/assets/items.svg'; ?></span>
                    <span style = "margin-left: 3.5rem; font-size: 20pt;">Edit Items</span>
                </a>
                <a href="delete_items.php" class="admin_card">
                    <span style = "margin-left: 1rem;"><?php include 'admin/assets/audit_log.svg'; ?></span>
                    <span style = "margin-left: 3.5rem; font-size: 20pt;">Delete Items</span>
                </a>
            </div>
        </div>
    </div>
<?php require 'footer.php'; ?>