<?php
session_start();
require('db(be).php');
if (isset($_SESSION['email'])) {
    if ($_SESSION['user_type'] === 'Admin') {
        header('Location: adminHome.php');
    } else {
        header('Location: buyerHome.php');
    }
    exit;
}

$message = "";
$type = "";

$savedEmail = $_COOKIE['email'] ?? '';
$savedPassword = $_COOKIE['password'] ?? '';
$rememberMe = isset($_COOKIE['email']);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        if($password === $user['password']){
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['user_id'] = $user['user_id'];

            if ($remember){
                setcookie('email', $email, time() + (86400 * 30));
                setcookie('password', $password, time() + (86400 * 30));
            } else {
                setcookie('email', '', time() - 3600);
                setcookie('password', '', time() - 3600);
            }
            if($user['is_confirmed'] == 1){
                if ($user['user_type'] == 'Admin') {
                    header('Location: adminHome.php');
                    die();
                } else {
                    header('Location: buyerHome.php');
                    die();
                }
            }
            else{
                $message = "Confirm email first to log in";
                $type = "danger";
            }
        } else {
            $message = "Invalid email or password.";
            $type = "danger";
            $savedEmail = $email;
            $savedPassword = $password;
            $rememberMe = $remember;
        }
    } else {
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
                <form action="login.php" method="POST" class="login_form">
                    <div class="input">
                        <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($savedEmail); ?>" required>
                    </div>
                    <div class="input">
                        <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($savedPassword); ?>" required>
                    </div>
                    <div class="login-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" <?php echo $rememberMe ? 'checked' : ''; ?>>
                            Remember Me
                        </label>
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