<?php 
session_start();
if (isset($_SESSION['email'])) {
    if ($_SESSION['user_type'] === 'Admin') {
        header('Location: adminHome.php');
    } else {
        header('Location: buyerHome.php');
    }
    exit;
}
require 'header.php'; ?>
    <section class="frontindex">
        <div class="container frontindex-container">
            <div class="frontindex-content">
                <h1>
                    Pack Smarter.
                    <br>
                    Travel Seamlessly.
                </h1>
                <p>
                    Thoughtfully designed bags that connect,
                    organize, and move with you.
                    
                    Whether you're commuting to work,
                    attending classes,
                    or travelling across the country,
                    Echo System helps you stay organized
                    with premium modular bags built
                    for modern lifestyles.
                </p>
                <div class="frontindex-buttons">
                    <a href="login.php" class="btn btn-primary">
                        Join for Free
                    </a>
                </div>
            </div>
            <div class="frontindex-image">
                <img src="assets/img/landing-page-bag.png" alt="Echo System Travel Bag">
            </div>
        </div>
    </section>
<?php require 'footer.php'; ?>