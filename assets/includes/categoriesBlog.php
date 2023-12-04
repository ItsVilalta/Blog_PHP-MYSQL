<?php
include 'connect.php';
function llistarCategories($db)
{
    $categories = array();
    $query = "SELECT * FROM categories ORDER BY id ASC";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}
function mostraCategories($arrayCategories)
{
    echo '<br><br><h1 class="title-cat">Categories</h1>';
    echo '<div class="categories-container">';
    foreach ($arrayCategories as $category) {
        echo '<div class="categoria-blog">' . $category['nombre'] . '</div>';
    }
    echo '</div>';
}

$categories = llistarCategories($db);
mostraCategories($categories);
?>