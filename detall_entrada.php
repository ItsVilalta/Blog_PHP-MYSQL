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
        include 'assets/includes/connect.php';

        // Comprovar si s'ha proporcionat un ID vàlid
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_entrada = $_GET['id'];

            // Consultar la base de dades per obtenir la informació de l'entrada
            $query = "SELECT * FROM entrades WHERE id = $id_entrada";
            $result = mysqli_query($db, $query);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                // Mostrar la informació detallada de l'entrada
                echo '<h1>' . $row['titol'] . '</h1>';

                // Mostrar la imatge
                if (!empty($row['img'])) {
                    echo '<img class="img_detall" src="' . $row['img'] . '" alt="Imatge de l\'entrada">';
                }

                echo '<p>' . $row['descripcio'] . '</p>';
                echo '<p>Data de publicació: ' . $row['data'] . '</p>';

                // Comprovar si l'usuari autenticat és l'autor de l'entrada
                $id_usuari_autenticat = $_SESSION['usuari_id'];
                if ($id_usuari_autenticat == $row['usuari_id']) {
                    echo '<div class="actions-container">';
                    echo '<a href="edita_entrada.php?id=' . $row['id'] . '" class="edit-button boto btn--primary btn">Editar</a>';
                    echo '<a href="elimina_entrada.php?id=' . $row['id'] . '" class="delete-button boto btn--primary btn">Eliminar</a>';
                    echo '</div>';
                }
            } else {
                echo 'No s\'ha trobat cap entrada amb aquest ID.';
            }
        } else {
            echo 'ID d\'entrada no vàlid.';
        }
        ?>

    </div>
</div>