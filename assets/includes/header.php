<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<div class="container-menu">
    <div class="main-box-menu">
        <nav>
            <a href="index.php">Inici</a>
            <a href="#">Apartat1</a>
            <a href="#">Apartat2</a>
            <a href="#">Apartat3</a>
            <a href="#">Apartat4</a>
            <a href="#">Apartat5</a>
            <a href="contacte.php">Contacte</a>
        </nav>
    </div>

    <?php
    // if (!isset($_SESSION)) {
    //     session_start();
    // }
    if (isset($_SESSION["logeao"])) {
        $nom_usuari = $_SESSION["logeao"];
    ?>

        <div class="info-user">
            <div>
                <h2 onclick="menuUser('<?php echo $nom_usuari; ?>')" class='nom_usuari'>
                    <?php echo $nom_usuari; ?>
                </h2>
                <div id="menu" style="display: none;" class="dades-user">
                    <ul>
                        <li><a href="dadesUsuari.php">Dades Usuari</a></li>
                        <li><a href="crearPosts.php">Entrades</a></li>
                        <li><a href="creaCategoria.php">Categories</a></li>
                        <li><a href="assets\includes\logout.php"> Logout<img src="assets/img/logout.png" alt="Logout" id="logout"></a></li>
                    </ul>
                </div>
            </div>

        </div>
    <?php
    };
    ?>

</div>
<script>
    function menuUser(nomUser) {
        var menu = document.getElementById('menu');
        if (menu.style.display === 'none') {
            menu.style.display = 'flex';
        } else {
            menu.style.display = 'none';
        }
    }
</script>