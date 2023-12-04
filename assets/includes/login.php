<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/mainmenu.css">
<link rel="stylesheet" href="assets/css/form.css">
<link rel="stylesheet" href="assets/css/creaEntradesCategories.css">
<link rel="stylesheet" href="assets/css/posts.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/loader.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="box-login">
    <div class="wrapper">
        <div class="animacio title" id="loginTitle">
            Inici Sessio
        </div>
        <form action="assets/php/loginValidator.php" method="post">
            <div class="field">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="errors-LR">
                <?php if (isset($_SESSION['errors']['email'])): ?>
                    <br><span style="color: red;">
                        <?php echo $_SESSION['errors']['email']; ?>
                    </span><br>
                <?php endif; ?>
            </div>
            <div class="sep-form"></div>
            <div class="field">
                <input type="password" name="password" required>
                <label>Contrasenya</label>
            </div>
            <div class="errors-LR">
                <?php if (isset($_SESSION['errors']['password'])): ?>
                    <br><span style="color: red;">
                        <?php echo $_SESSION['errors']['password']; ?>
                    </span><br>
                <?php endif; ?>
            </div>
            <div class="field">
                <input type="submit" value="Login">
            </div>
            <div class="signup-link" id="signupLinkContainer">
                <span id="signupText">No registrat? </span><a href="indexRegistre.php" id="signupLink">Registrat ara</a>
            </div>
        </form>
    </div>
</div>