<?php
if (!isset($_SESSION)) {
    session_start();
}

include 'connect.php';
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? null;
    $cognom = $_POST['cognom'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;


    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (empty($nom) || !preg_match("/^[a-zA-ZÀ-ÿ ]*$/", $nom)) {
        $errors['nom'] = "Nom incorrecte";
    }
    if (empty($cognom) || !preg_match("/^[a-zA-ZÀ-ÿ ]*$/", $cognom)) {
        $errors['cognom'] = "Cognom incorrecte";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email incorrecte";
    }

    if (count($errors) === 0) {
        // Evitar la injecció SQL escapant les variables
        $nom = mysqli_real_escape_string($db, $nom);
        $cognom = mysqli_real_escape_string($db, $cognom);
        $email = mysqli_real_escape_string($db, $email);

        // Verifica si la clau "user_id" està definida a $_SESSION
        if (isset($_SESSION['usuari_id'])) {
            // Obté l'ID de l'usuari de la sessió
            $usuari_id = $_SESSION['usuari_id'];

            // Construeix la consulta d'actualització
            $query = "UPDATE usuaris SET nom='$nom', cognom='$cognom', email='$email' WHERE id = $usuari_id";

            // Executa la consulta
            $result = mysqli_query($db, $query);

            if ($result) {
                // L'actualització ha estat exitosa

                // Recupera les noves dades de l'usuari
                $query_select = "SELECT * FROM usuaris WHERE id = $usuari_id";
                $result_select = mysqli_query($db, $query_select);

                if ($result_select && mysqli_num_rows($result_select) > 0) {
                    $user_data = mysqli_fetch_assoc($result_select);
                    $user_data['id'] = $_SESSION['usuari_id'];
                    // $user_data['nom'] = $_SESSION['nom'];
                    // $user_data['cognom'] = $_SESSION['cognom'];
                    // $user_data['email'] = $_SESSION['email'];
                    echo "Dades actualitzades amb èxit.";
                    echo "Tanca sessio per veure els canvis";
                } else {
                    echo "Error en la recuperació de les noves dades de l'usuari: " . mysqli_error($db);
                }
            } else {
                echo "Error en l'actualització de les dades: " . mysqli_error($db);
            }
        } else {
            echo "Error: No s'ha trobat l'ID de l'usuari a la sessió.";
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
        <form method="post" action="#">
            <div class="field">
                <input type="text" name="nom"
                    value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required>
                <label>Nom</label>
            </div>
            <?php if (isset($errors['nom'])): ?>
                <br><span style="color: red;">
                    <?php echo $errors['nom']; ?>
                </span><br>
            <?php endif; ?>
            <div class="field">
                <input type="text" name="cognom"
                    value="<?php echo isset($_POST['cognom']) ? htmlspecialchars($_POST['cognom']) : ''; ?>" required>
                <label>Cognom</label>
            </div>
            <?php if (isset($errors['cognom'])): ?>
                <br><span style="color: red;">
                    <?php echo $errors['cognom']; ?>
                </span><br>
            <?php endif; ?>
            <div class="field">
                <input type="email" name="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
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
                <input type="submit" value="Modificar">
            </div>
        </form>
    </div>
</div>