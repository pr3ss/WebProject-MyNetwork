function generaLoginForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
        <h2>Login</h2>
        <p></p>
        <ul>
            <li>
                <label for="username">Username:</label><input type="text" id="username" name="username" />
            </li>
            <li>
                <label for="password">Password:</label><input type="password" id="password" name="password" />
            </li>
            <li>
                <input type="submit" name="submit" value="Invia" />
                <button onclick="showSigninForm()">Signin</button>
            </li>
        </ul>
    </form>`;
    return form;
}

function generaSigninForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
        <h2>Signin</h2>
        <p></p>
        <ul>
            <li>
                <label for="username">Username:</label><input type="text" id="username" name="username" />
            </li>
            <li>
                <label for="password">Password:</label><input type="password" id="password" name="password" />
            </li>
            <li>
                <input type="submit" name="submit" value="Invia" />
                <button onclick="showLoginForm()">Login</button>
            </li>
        </ul>
    </form>`;
    return form;
}


const main = document.querySelector("main");

function showLoginForm(){
    let form = generaLoginForm();
    main.innerHTML = form;
}

function showSigninForm(){
    let form = generaSigninForm();
    main.innerHTML = form;
}

showLoginForm();

