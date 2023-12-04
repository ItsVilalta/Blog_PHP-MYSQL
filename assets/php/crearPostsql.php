<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = $_POST['titol'] ?? '';
    $descripcio = $_POST['descripcio'] ?? '';
    $usuari_id = $_SESSION['usuari_id'] ?? 0;
    $categoria = $_POST['categoria'] ?? 0;
    $img = $_FILES['imatge'] ?? [];

    // Valida si esta buit
    if (empty($titol)) {
        $_SESSION['errors']['titol'] = 'El títol és obligatori.';
    }

    if (empty($descripcio)) {
        $_SESSION['errors']['descripcio'] = 'La descripció és obligatòria.';
    }

    // Comprova si s'ha pujat un fitxer
    if (!empty($img)) {
        $img_tmp = $_FILES['imatge']['tmp_name'];
        $img_path = "../posts/imgs/" . $img['name'];
        $img_path_sql = "assets/posts/imgs/" . $img['name'];

        // Mou el fitxer pujat a la ubicació desitjada
        move_uploaded_file($img_tmp, $img_path);
    }

    if (!empty($_SESSION['errors'])) {
        header("Location: ../../crearPosts.php");
        die();
    }

    $verificacio_user_cat = "SELECT id FROM usuaris WHERE id = ? AND ? IN (SELECT id FROM categories)";
    $sql_verificacio_user_cat = $db->prepare($verificacio_user_cat);
    $sql_verificacio_user_cat->bind_param("ii", $usuari_id, $categoria);
    $sql_verificacio_user_cat->execute();
    $sql_verificacio_user_cat->store_result();

    if ($sql_verificacio_user_cat->num_rows > 0) {
        $sql = "INSERT INTO entrades (usuari_id, categoria_id, titol, descripcio, img, data) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iisss", $usuari_id, $categoria, $titol, $descripcio, $img_path_sql);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Entrada creada correctament.";
            header("Location: ../../index.php");
            die();
        } else {
            echo "Error en crear l'entrada: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: usuari_id o categoria_id no vàlids.";
    }

    $sql_verificacio_user_cat->close();
    $db->close();
}
?>