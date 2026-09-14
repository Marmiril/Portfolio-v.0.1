<section class="auth-wrapper">
    <div class="auth-title">
        <h1>Register</h1>
    </div>

    <p id="errorMessage" class="error-message"></p>

    <form id="registerForm" class="auth-form">

        <div class="form-field">
            <label for="username"></label><br>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <small class="error-field" data-error-for="username"></small>
        </div>

        <div class="form-field">
            <label for="email"></label><br>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <small class="error-field" data-error-for="email"></small>
        </div>

        <div class="form-field">
            <label for="password"></label><br>
            <input type="password" id="password" name="password" placeholder="Password">
            <small class="error-field" data-error-for="password"></small>
        </div>

        <div class="btn-group">
            <button type="submit" id="btnRegister" class="btn">Register</button>
            <button type="button" id="btnCancelRegister" class="btn">Cancel</button>
        </div>
    </form>

    <p id="errorMessage" style="display:none"></p>
</section>
