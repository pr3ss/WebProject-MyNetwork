<div>
    <h2 style="text-align: center; font-size: 150%;">login</h2>
    <?php if(isset($templateParams["signin"]) && $templateParams['signin']): ?>
        <p style="text-align: center; color:green;">Sigin effetuato</p>
    <?php endif; ?>
    <form method="post">
        <p class="text-danger"></p>
        <div class="txt_field">
            <input type="text" id="email" required>
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
            <input type="password" id="password" required>
            <span></span>
            <label>Password</label>
        </div>
        <div id="divLogin" style="text-align: center;">
            <input type="submit" value="Login">
        </div>
        <div class="signup_link">
            Not a member? <a href="signin.php">Signup</a>
        </div>
    </form>
</div>