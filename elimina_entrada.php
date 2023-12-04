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
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }

        include 'assets/includes/connect.php';

        // Verifica si l'ID de l'entrada està definit
        if (isset($_GET['id'])) {
            $entrada_id = $_GET['id'];

            // Mostra la pregunta de confirmació
            echo "<h1>Estàs segur que vols eliminar l'entrada?</h1>";

            // Formulari de confirmació amb dos botons
            echo "<form action='#' method='post'>";
            echo "<input type='hidden' name='entrada_id' value='$entrada_id'>";
            echo "<input type='submit' name='eliminar' value='Sí, eliminar' class='boto btn--primary btn'>";
            echo "<a href='index.php' class='boto btn--primary btn'>No, cancel·lar</a>";
            echo "</form>";

            // Processa l'eliminació si s'ha enviat el formulari
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
                // Verifica si l'ID de l'entrada està definit
                if (isset($_POST['entrada_id'])) {
                    // Construeix la consulta per eliminar l'entrada
                    $entrada_id = $_POST['entrada_id'];
                    $query = "DELETE FROM entrades WHERE id = $entrada_id";

                    // Executa la consulta
                    $result = mysqli_query($db, $query);

                    if ($result) {
                        echo "Entrada eliminada amb èxit.";
                        header("Location: index.php");
                    } else {
                        echo "Error en l'eliminació de l'entrada: " . mysqli_error($db);
                    }
                } else {
                    echo "Error: No s'ha proporcionat l'ID de l'entrada.";
                }
            }
        } else {
            echo "Error: No s'ha proporcionat l'ID de l'entrada.";
        }
        ?>
    </div>
</div>