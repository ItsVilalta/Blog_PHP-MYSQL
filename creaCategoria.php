<?php include "assets/includes/header.php" ?>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/mainmenu.css">
<link rel="stylesheet" href="assets/css/form.css">
<link rel="stylesheet" href="assets/css/creaEntradesCategories.css">
<link rel="stylesheet" href="assets/css/posts.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/loader.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php
// Inicia la sessió si encara no s'ha iniciat
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="container-Post">
    <div class="main-box-Post">
        <form action="assets/php/crearCategoriessql.php" method="POST">
            <div class="container-post">
                <div class="container__item">
                    <form class="form">
                        <input type="text" name="nom_categoria" class="form__field" placeholder="Nom de Categoria" />
                        <button type="submit" class="btn btn--primary btn--inside uppercase">Crear</button>
                    </form>
                    <br>
                    <?php if (isset($_SESSION['errors']['nom_categoria'])): ?>
                        <div class="errors-LR">
                            <br><span style="color: red;">
                                <?php echo $_SESSION['errors']['nom_categoria']; ?>
                            </span><br>
                        </div>
                    <?php endif; ?>
                    <br>
                    <!-- Mostra el missatge de success -->
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="errors-LR">
                            <br><span style="color: green;">
                                <?php echo $_SESSION['success_message']; ?>
                            </span><br>
                        </div>
                    <?php endif; ?>
                    <br>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// Elimina els errors i el missatge de success de la variable de sessió per evitar mostrar-los en futures peticions
unset($_SESSION['errors']);
unset($_SESSION['success_message']);
?>