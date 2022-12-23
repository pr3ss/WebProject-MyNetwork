function generaSigninForm(loginerror = null) {
    let form = `
    <div class="center">
        <img src="img\logo.jpg" class="avatar"alt="logo">
        <h1>Social-Network</h1>
        <h5>Sign up</h5>
        <form method="post">
            <div class="txt_field">
                <input type="text" required>
                <span></span>
                <label>email</label>
            </div>
            <div class="txt_field">
                <input type="text" required>
                <span></span>
                <label>Nome</label>
            </div>
            <div class="txt_field">
                <input type="text" required>
                <span></span>
                <label>Cognome</label>
            </div>
            <div class="txt_field">
                <input type="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="txt_field">
                <input type="date" required>
                <span>
                </span>
            </div>
            <input type="submit" value="Sign Up">
            <div class="signup_link">
                Already have account? <a href="login.php">Login</a>
            </div>
        </form>
    </div>`;
    return form;
}

const main = document.querySelector("main");


function showSigninForm(){
    let form = generaSigninForm();
    main.innerHTML = form;
}

showSigninForm();



