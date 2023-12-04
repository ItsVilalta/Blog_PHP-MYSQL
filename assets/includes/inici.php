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

        <?php include "posts.php"; ?>
    </div>
    <div class="side-bar">
        <div>
            <?php
            // if (!isset($_SESSION)) {
            //     session_start();
            // }
            if (!isset($_SESSION["logeao"])) {
            ?>
                <div class="registre-login">
                    <div id="login-content" style="display: flex">
                        <?php include "assets/includes/login.php"; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div>
            <div class="sarch">
                <div class="centrat">
                    <div class="benvinguda title-cat"></div>
                </div><br>
                <div class="container__item">
                    <form class="form" action="posts.php" method="get">
                        <!-- Change the type from email to text and add a name attribute -->
                        <input type="text" class="form__field" name="search_query" placeholder="Cercador" />
                        <button type="submit" class="btn btn--primary btn--inside uppercase">Cercar</button>
                    </form>
                </div>
                <div class="categories-blog">
                    <?php include "categoriesBlog.php"; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CODI JS -->
<?php
// if (!isset($_SESSION)) {
//     session_start();
// }
if (isset($_SESSION["logeao"]) && !isset($_SESSION["benvingut_mostrat"])) {
    $nom_usuari = $_SESSION["logeao"];
    $_SESSION["benvingut_mostrat"] = true;
?>
    <style>
        .benvinguda {
            transition: opacity 1s ease;
            opacity: 1;
        }

        .hide {
            opacity: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchDiv = document.querySelector('.benvinguda');
            var benvingudaDiv = document.createElement('div');
            benvingudaDiv.className = 'benvinguda';
            var message = document.createElement('h2');
            message.textContent = 'Benvingut/da, <?php echo $nom_usuari; ?>';
            benvingudaDiv.appendChild(message);
            searchDiv.appendChild(benvingudaDiv);

            setTimeout(function() {
                benvingudaDiv.classList.add('hide');
                setTimeout(function() {
                    benvingudaDiv.style.display = 'none';
                }, 1000);
            }, 3000);
        });
    </script>
<?php
}
?>

<script>
    function swapContent(show, hide) {
        var showElement = document.getElementById(show);
        var hideElement = document.getElementById(hide);

        if (showElement.style.display === 'none') {
            showElement.style.display = 'flex';
            showElement.style.alignSelf = 'start';
            hideElement.style.display = 'none';
        } else {
            showElement.style.display = 'none';
            hideElement.style.display = 'flex';
            hideElement.style.alignSelf = 'start';
        }
    }
</script>