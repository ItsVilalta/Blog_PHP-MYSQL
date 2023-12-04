<?php
if (!isset($_SESSION)) {
    session_start();
}

include 'assets/includes/connect.php';
$errors = array();

// Funció per validar les dades del formulari
function validateFormData($data)
{
    global $errors;

    $titol = $data['titol'] ?? '';
    $descripcio = $data['descripcio'] ?? '';

    if (empty($titol)) {
        $errors['titol'] = "El títol no pot estar buit.";
    }

    if (empty($descripcio)) {
        $errors['descripcio'] = "La descripció no pot estar buida.";
    }

    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validació de les dades del formulari
    $errors = validateFormData($_POST);

    if (count($errors) === 0) {
        // Evitar la injecció SQL escapant les variables
        $titol = mysqli_real_escape_string($db, $_POST['titol']);
        $descripcio = mysqli_real_escape_string($db, $_POST['descripcio']);

        // Verifica si la clau "usuari_id" està definida a $_SESSION
        if (isset($_SESSION['usuari_id'])) {
            // Obté l'ID de l'usuari de la sessió
            $usuari_id = $_SESSION['usuari_id'];

            // Inclou l'ID del post que es vol editar (suposem que està en una variable POST, ajusta-ho si és diferent)
            $id_entrada = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

            // Construeix la consulta d'actualització amb la clàusula WHERE per l'ID de l'usuari i l'ID del post
            $query = "UPDATE entrades SET titol='$titol', descripcio='$descripcio' WHERE usuari_id = $usuari_id AND id = $id_entrada";

            // Executa la consulta
            $result = mysqli_query($db, $query);

            if ($result) {
                // echo "Entrada actualitzada amb èxit.";
                header("Location: index.php");

            } else {
                echo "Error en l'actualització de l'entrada: " . mysqli_error($db);
            }
        } else {
            echo "Error: No s'ha trobat l'ID de l'usuari a la sessió.";
        }
    }
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
        <h1>Modificar Post</h1>

        <form action="#" method="post">
            <div class="container-post">
                <div class="container__item">
                    <input type="text" id="titol" name="titol" class="form__field" required placeholder="Nou titol" />
                    <!-- <label for="titol">Títol</label> -->
                </div>
                <?php if (isset($errors['titol'])): ?>
                    <div class="errors-LR">
                        <br><span style="color: red;">
                            <?php echo $errors['titol']; ?>
                        </span><br>
                    </div>
                <?php endif; ?>
                <div class="container__item">
                    <textarea id="descripcio" name="descripcio" class="form__field" required style="height: 150px;"
                        placeholder="Nova Descripció"></textarea>
                    <!-- <label for="descripcio">Descripció</label> -->
                </div>
                <?php if (isset($errors['descripcio'])): ?>
                    <div class="errors-LR">
                        <br><span style="color: red;">
                            <?php echo $errors['descripcio']; ?>
                        </span><br>
                    </div>
                <?php endif; ?>
                <div class="container__item">
                    <input type="submit" value="Modificar" class="btn btn--primary boto">
                </div>
            </div>
        </form>
    </div>
</div>