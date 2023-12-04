<!-- MOSTRA TOTS ELS POSTS QUE HI HAN CREATS -->
<?php
include 'connect.php';

function llistarPosts($db)
{
    $entrades = array();
    $query = "SELECT * FROM entrades ORDER BY id ASC";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $entrades[] = $row;
    }
    return $entrades;
}

function mostraPosts($arrayEntrades, $limit = null)
{
    echo '<div class="entrades-container">';

    $count = 0;
    foreach ($arrayEntrades as $entrada) {
        if ($limit !== null && $count >= $limit) {
            break;
        }

        echo '<a href="detall_entrada.php?id=' . $entrada['id'] . '" class="post">';
        echo '<div class="img">';
        echo '<img src="' . $entrada['img'] . '" alt="">';
        echo '</div>';
        echo '<div class="text-post">';
        echo '<h1>' . $entrada['titol'] . '</h1>';
        echo '<p>' . $entrada['descripcio'] . '</p>';
        echo '</div>';
        echo '<div class="text-data">';
        echo '<h3>' . $entrada['data'] . '</h3>';
        echo '</div>';
        echo '</a>';

        $count++;
    }

    echo '</div>';
}

$limit = isset($_POST['limit']) ? $_POST['limit'] : 3;

$entrades = llistarPosts($db);
mostraPosts($entrades, $limit);

if ($limit !== null && $limit < count($entrades)) {
    echo '<form action="" method="POST">';
    echo '<input type="hidden" name="limit" value="' . ($limit + 3) . '">';
    echo '<input class="mostra-posts" type="submit" value="Mostra Més Posts">';
    echo '</form>';
}

?>