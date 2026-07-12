<?php require 'registration(be).php'; ?>
<?php require 'header.php'; ?>
    <section class="section register_section">
    <div class="container">
        <div class="register_card">
            <?php if (!empty($message)): ?>
                <p class="form_message <?php echo $type; ?>"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <div class="register_header">
                <h2>Register</h2>
                <p>Create your account to easily manage your orders, shipping details, and gear rewards.</p>
            </div>

            <form action="register.php" method="POST" class="register_form">

                <div class="form_row">
                    <div class="input">
                       
                        <input type="text" name="first_name" placeholder="First Name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>" required>
                    </div>
                    <div class="input">
                        
                        <input type="text" name="last_name" placeholder="Last Name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>" required>
                    </div>
                </div>

                <div class="input">
                    
                    <input type="email" name="email" placeholder="Email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>

                <div class="input">
                    
                    <input type="text" name="address" placeholder="Full Address" value="<?php echo isset($address) ? htmlspecialchars($address) : ''; ?>" required>
                </div>

                <div class="input">
                   
                    <input type="text" name="contact" maxlength="10" pattern="[0-9]{10}" placeholder="Contact no." value="<?php echo isset($contact) ? htmlspecialchars($contact) : ''; ?>" required>
                </div>

                <div class="form_row">
                    <div class="input">
                        
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input">
                        
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary register_btn">Register</button>

                <p class="register_text">
                    Have an account already? <a href="login.php"><b>Login</b></a>
                </p>

            </form>

        </div>
    </div>
</section>
<?php require 'footer.php'; ?>