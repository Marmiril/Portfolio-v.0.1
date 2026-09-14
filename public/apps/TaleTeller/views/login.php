<section class="auth-wrapper">
    <div class="auth-title">
        <h1>Login</h1>
    </div>
    <p id="errorMessage" class="error-message"></p>
    
    <form id="loginForm" class="auth-form">

        <div class="form-field">
            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-field">
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Password">
        </div>

        <div class="btn-group">
            <button type="submit" id="btnLogin" class="btn">Login</button>
            <button type="button" id="btnCancelLogin" class="btn">Cancel</button>
        </div>

    </form>
</section>
