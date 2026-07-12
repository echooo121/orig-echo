<?php require 'header.php'; ?>
    <section class="frontindex">
    <div class="container">
        <div class="frontindex-container">
            <div class="frontindex-image">
                <img src="assets/img/loginpic.png" alt="Login illustration">
            </div>
            <div class="frontindex-content">
                <h3 style="color:var(--accent-color); margin-bottom:.5rem;">Welcome Back to Echo System</h3>
                <p>Your journey starts here. Sign in to seamlessly manage your gear and travel preferences.</p>
                <form action="" method="POST" class="login-form">
                    <div class="input">
                        <i class="ri-user-line"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input">
                        <i class="ri-lock-line"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="login-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            Remember Me
                        </label>
                        <a href="forgot-password.php">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary login-btn">Login</button>
                    <p class="register_text">
                        Dont have an account? <a href="register.php"><strong>Register now</strong></a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </section>
<?php require 'footer.php'; ?>