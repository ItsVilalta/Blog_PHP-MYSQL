<?php
// if (!isset($_SESSION)) {
//     session_start();
// }

include '../includes/connect.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {


        $errors['email'] = "Email incorrecte";
    }

    if (empty($password)) {
        $errors['password'] = "Contrasenya incorrecta";
    }
    if (count($errors) === 0) {
        $query = "SELECT * FROM usuaris WHERE email='$email'";
        $result = mysqli_query($db, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    $_SESSION['logeao'] = $user['nom'];
                    $_SESSION['usuari_id'] = $user['id'];
                } else {
                    $errors['password'] = "Contrasenya incorrecta";
                }
            } else {
                $errors['email'] = "Usuari no trobat";
            }
        } else {
            $errors['error'] = "Error en executar la consulta: " . mysqli_error($db);
        }
    } else {
        $_SESSION['errors'] = $errors;
    }
}

header('Location: ../../index.php');
die();
