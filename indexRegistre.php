<?php include "assets/includes/loader.html" ?>

<?php include "assets/includes/header.php" ?>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/mainmenu.css">
<link rel="stylesheet" href="assets/css/form.css">
<link rel="stylesheet" href="assets/css/creaEntradesCategories.css">
<link rel="stylesheet" href="assets/css/posts.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/loader.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container">
    <div class="main-box">
        <?php include "assets/includes/posts.php"; ?>
    </div>
    <div class="side-bar">
        <div>

            <div class="registre-login">
                <div id="register-content">
                    <?php include "assets/includes/register.php"; ?>
                </div>
            </div>
        </div>
        <div>
            <div class="sarch">
                <div class="centrat">
                    <div class="benvinguda title-cat"></div>
                </div><br>
                <div class="container__item">
                    <form class="form">
                        <input type="email" class="form__field" placeholder="Cercador" />
                        <button type="button" class="btn btn--primary btn--inside uppercase">Cercar</button>
                    </form>
                </div>
                <div class="categories-blog">
                    <?php include "assets/includes/categoriesBlog.php"; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "assets/includes/footer.php" ?>