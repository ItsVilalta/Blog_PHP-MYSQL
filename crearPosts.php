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
        <h1>Crear Post</h1>

        <form action="assets/php/crearPostsql.php" method="post" enctype="multipart/form-data">
            <div class="container-post">
                <div class="container__item">
                    <input type="text" id="titol" name="titol" class="form__field" placeholder="Títol Post" />
                </div>
                <div class="errors-LR">
                    <?php if (isset($_SESSION['errors']['titol'])): ?>
                        <br><span style="color: red;">
                            <?php echo $_SESSION['errors']['titol']; ?>
                        </span><br>
                    <?php endif; ?>
                </div>
                <div class="container__item">
                    <textarea id="descripcio" name="descripcio" class="form__field" style="height: 150px;"
                        placeholder="Text del Post"></textarea>
                </div>
                <div class="errors-LR">
                    <?php if (isset($_SESSION['errors']['descripcio'])): ?>
                        <br><span style="color: red;">
                            <?php echo $_SESSION['errors']['descripcio']; ?>
                        </span><br>
                    <?php endif; ?>
                </div>
                <div class="container__item">
                    <select id="categoria" name="categoria" class="form__field">
                        <?php
                        include "assets/includes/selectcategories.php";
                        ?>
                    </select>
                </div>
                <div class="container__item">
                    <form class="form" enctype="multipart/form-data">
                        <input type="file" id="imatge" name="imatge" class="form__field" accept="image/*" />
                    </form>
                </div>

                <div class="container__item">
                    <button type="submit" class="btn btn--primary boto">Crear Entrada</button>
                </div>
            </div>
        </form>
    </div>
</div>