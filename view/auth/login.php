<form action="./index.php?page=auth-login" method="POST" id="registerForm">

    <div class="form-floating">
        <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email..." />
        <label for="email">Email address</label>
        <div class="invalid-feedback">An email is required.</div>
    </div>

    <div class="form-floating">
        <input class="form-control" name="password" id="password" type="password" placeholder="Enter your password..." />
        <label for="password">Password</label>
        <div class="invalid-feedback">A password is required.</div>
    </div>
    <br />
    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">login</button>
</form>