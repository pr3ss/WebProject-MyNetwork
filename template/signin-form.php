<div>
        <h2 style="text-align: center; font-size: 150%;">Sign up</h2>
        <form method="post">
            <p class="text-danger"></p>
            <div class="txt_field">
                <input type="text" id="email" required>
                <span></span>
                <label for="email">email</label>
            </div>
            <div class="txt_field">
                <input type="text" id="username" required>
                <span></span>
                <label for="username">username</label>
            </div>
            <div class="txt_field">
                <input type="text" id="nome" required>
                <span></span>
                <label for="nome">Nome</label>
            </div>
            <div class="txt_field">
                <input type="text" id="cognome" required>
                <span></span>
                <label for="cognome">Cognome</label>
            </div>
            <div class="txt_field">
                <input type="password" id="password" required>
                <span></span>
                <label for="password">Password</label>
            </div>
            <div class="txt_field">
                <label for="data_nascita" style="display: none;">data di nascita</label>
                <input type="date" id="data_nascita" required>
                <span>
                </span>
            </div>
            <div id="divSignin" style="text-align: center;">
                <input type="submit" value="Sign Up">
            </div>
            <div class="signup_link">
                Already have account? <a href="index.php">Login</a>
            </div>
        </form>
</div>