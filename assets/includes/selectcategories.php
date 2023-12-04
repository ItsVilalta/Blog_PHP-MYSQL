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

function generaOpcionsCategories($arrayCategories)
{
    foreach ($arrayCategories as $category) {
        echo '<option value="' . $category['id'] . '">' . $category['nombre'] . '</option>';
    }
}

$categories = llistarCategories($db);
generaOpcionsCategories($categories);
?>