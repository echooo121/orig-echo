<?php
require('db(be).php');

$message = "";
$type = "";

if(isset($_GET['token']) && !empty($_GET['token'])){
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE token = '$token'");

    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if($user['is_confirmed'] == 1) {
            $message = "Your account has already been confirmed.";
            $type = "danger";
        } else {
            mysqli_query($conn, "UPDATE users
                SET is_confirmed = 1, token = NULL
                WHERE token = '$token'
                ");
            $message = "Your account is now successfully confirmed.";
            $type = "success";
        }
    } else {
        $message = "Invalid confirmation link.";
        $type = "danger";
    }
} else {
    $message = "No confirmation token provided.";
    $type = "danger";
}
mysqli_close($conn);

require('header.php'); 
?>
    <div class="container">
        <h2 style = "margin-top: 5rem;">Account Confirmation</h2>
        <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>

        <a href="login.php" class="btn btn-primary">Login</a>
    </div>
<?php require('footer.php'); ?>