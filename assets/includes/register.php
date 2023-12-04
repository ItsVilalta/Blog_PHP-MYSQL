<?php
include 'connect.php';
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $cognom = $_POST['cognom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $data = $_POST['data'] ?? '';


    if (empty($nom) || !preg_match("/^[a-zA-ZÀ-ÿ ]*$/", $nom)) {
        $errors['nom'] = "Nom incorrecte";
    }
    if (empty($cognom) || !preg_match("/^[a-zA-ZÀ-ÿ ]*$/", $cognom)) {
        $errors['cognom'] = "Cognom incorrecte";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email incorrecte";
    }
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
        $errors['password'] = "Password ha de tenir almenys 8 caràcters, una lletra minúscula, una lletra majúscula i un número";
    }
    if (count($errors) === 0) {
        $psswd_segura = password_hash($password, PASSWORD_DEFAULT);

        $data = date("Y-m-d ");

        $query = "INSERT INTO usuaris (nom, cognom, email, password, data) VALUES ('$nom', '$cognom', '$email', '$psswd_segura', '$data')";
        $result = mysqli_query($db, $query);


        if ($result) {
            echo "Dades insertades amb èxit a la base de dades.";
        } else {
            echo "Error en inserir dades a la base de dades: " . mysqli_error($db);
        }
    }
}
?>
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
        <div class="title">
            Registre
        </div>
        <form method="post" action="#">
            <div class="field">
                <input type="text" name="nom" required>
                <label>Nom</label>
            </div>
            <?php if (isset($errors['nom'])): ?>
                <br><span style="color: red;">
                    <?php echo $errors['nom']; ?>
                </span><br>
            <?php endif; ?>
            <div class="field">
                <input type="text" name="cognom" required>
                <label>Cognom</label>
            </div>
            <?php if (isset($errors['cognom'])): ?>
                <br><span style="color: red;">
                    <?php echo $errors['cognom']; ?>
                </span><br>
            <?php endif; ?>
            <div class="field">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <?php if (isset($errors['email'])): ?>
                <br><span style="color: red;">
                    <?php echo $errors['email']; ?>
                </span><br>
            <?php endif; ?>
            <div class="field">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <?php if (isset($errors['password'])): ?>
                <br><span style="color: red;">
                    <?php echo $errors['password']; ?>
                </span><br>
            <?php endif; ?>
            <div class="field">
                <input type="submit" value="Registrar">
            </div>
            <div class="signup-link" id="signupLinkContainer">
                <span id="signupText">Ja tens compte? </span><a href="index.php" id="signupLink"
                    onclick="swapContent('login-content', 'register-content');">Iniciaar Sessio</a>
            </div>
        </form>
    </div>
</div>