<?php
// Variables para almacenar los mensajes de error y éxito
$error = $exit = '';

// Comprueba si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nom = test_input($_POST["nom"]);
    $email = test_input($_POST["email"]);
    $missatge = test_input($_POST["missatge"]);

    // Adreça de correu electrònic del destinatari
    $destinatari = "destinatari@example.com";

    // Assumpte del correu electrònic
    $assumpte = "Missatge de contacte de $nom";

    // Cos del missatge
    $cos_missatge = "Nom: $nom\nEmail: $email\nMissatge: $missatge";

    // Intenta enviar el correu electrònic
    $exit = mail($destinatari, $assumpte, $cos_missatge);

    // Verifica si l'enviament ha estat un èxit o un error
    if ($exit) {
        $exit = 'El teu missatge s\'ha enviat amb èxit!';
    } else {
        $error = 'Hi ha hagut un problema en enviar el teu missatge. Si us plau, intenta-ho més tard.';
    }
}

// Función para limpiar los datos del formulario
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<?php include "assets/includes/header.php" ?>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/mainmenu.css">
<link rel="stylesheet" href="assets/css/form.css">
<link rel="stylesheet" href="assets/css/creaEntradesCategories.css">
<link rel="stylesheet" href="assets/css/posts.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/loader.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container-Post">
    <div class="main-box-Post">
        <h1>Formulari de Contacte</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form"
            enctype="multipart/form-data">
            <div class="container-post">
                <div class="container__item">
                    <input type="text" id="nom" name="nom" class="form__field" placeholder="Nom" />
                </div>
                <div class="container__item">
                    <input type="email" id="email" name="email" class="form__field" placeholder="Correu electrònic" />
                </div>
                <div class="container__item">
                    <textarea id="missatge" name="missatge" class="form__field" rows="5"
                        placeholder="Missatge"></textarea>
                </div>
                <div class="container__item">
                    <button type="submit" class="btn btn--primary boto">Envia</button>
                </div>
            </div>
        </form>

        <div class="errors-LR">
            <span style="color: red;">
                <?php echo $error; ?>
            </span>
        </div>
        <div class="success-message">
            <span style="color: green;">
                <?php echo $exit; ?>
            </span>
        </div>
    </div>
</div>