<?php
// Inicia la sessió si encara no s'ha iniciat
if (!isset($_SESSION)) {
    session_start();
}

// Inclou l'arxiu de connexió a la base de dades
include '../includes/connect.php';

// Inicialitza l'array d'errors
$errors = [];

// Comprova si es fa una petició POST (quan es prem el botó "Crear")
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obté el valor del camp "Nom de Categoria" del formulari
    $nomCategoria = $_POST['nom_categoria'];

    // Validacions
    if (empty($nomCategoria)) {
        $errors['nom_categoria'] = "El camp 'Nom de Categoria' és obligatori.";
    } elseif (!preg_match('/^[a-zA-Z]+$/', $nomCategoria)) {
        $errors['nom_categoria'] = "Només es permeten lletres sense espais ni caràcters especials.";
    }

    // Si no hi ha errors, pots procedir amb la creació de la categoria
    if (empty($errors)) {
        // Escapa els caràcters per evitar la injecció SQL
        $nomCategoria = mysqli_real_escape_string($db, $nomCategoria);

        // Executa la instrucció SQL d'INSERCIÓ
        $sql = "INSERT INTO categories (nombre) VALUES ('$nomCategoria')";

        if (mysqli_query($db, $sql)) {
            // Estableix un missatge de success a la variable de sessió
            $_SESSION['success_message'] = "Categoria creada correctament.";

            // Redirigeix a aquesta mateixa pàgina per evitar el reenviament del formulari
            header('Location: ../../creaCategoria.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    } else {
        // Guarda els errors a la variable de sessió
        $_SESSION['errors'] = $errors;

        // Redirigeix a la pàgina de creació de categories amb els errors
        header('Location: ../../creaCategoria.php');
        exit;
    }
}

// Tanca la connexió a la base de dades
mysqli_close($db);
?>