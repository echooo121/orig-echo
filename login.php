<?php
session_start();
require('db(be).php');
$message = "";
$type = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        if($password === $user['password']){
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user['user_type'];

            if ($user['user_type'] == 'Admin') {
                header('Location: admin/adminHome.php');
            } 
            else{
                header('Location: buyer/home.php');
            }
            exit;
        } 
        else{
            $message = "Invalid email or password.";
            $type = "danger";
        }
    } 
    else{
        $message = "Invalid email or password.";
        $type = "danger";
    }
}
?>
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
                <?php if (!empty($message)): ?>
                    <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>
                <?php endif; ?>
                <form action="" method="POST" class="login-form">
                    <div class="input">
                        <input type="text" name="email" placeholder="Email" required>
                    </div>
                    <div class="input">
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