<?php
include 'connect_db.php';

$sql = "SELECT * FROM pets WHERE 1=1";

if (!empty($_POST['category'])) {
        $category = "category_fk IN (" . implode(', ', $_POST['category']) . ")";
        $sql .= " AND $category";
}
if (!empty($_POST['gender'])) {
        $gender = "gender_fk IN (" . implode(', ', $_POST['gender']) . ")";
        $sql .= " AND $gender";
}
if (!empty($_POST['size'])) {
        $size = "size_fk IN (" . implode(', ', $_POST['size']) . ")";
        $sql .= " AND $size";
}
if (!empty($_POST['wool'])) {
        $wool = "wool_info_fk IN (" . implode(', ', $_POST['wool']) . ")";
        $sql .= " AND $wool";
}

$pets = $conn->query($sql);
        
$output = '';
foreach ($pets as $pet) {
        $output .= '<div id="' . $pet['id'] . '" class="pets__catalog-card" >';
        $output .= '<a href="/partials/pets/pet_body.php?petID='.$pet['id'].'">';
        $output .= '<img src="'.$pet['img'].'" alt="'.$pet['name'].'">';
        $output .= '<div class="pets__catalog-card-info">';
        $output .= '<h4>' . $pet['name'] . ',</h4>';
        // $output .= '<p>' . $pet['gender'] . '<br>' . $pet['age'].'</p>';
        $output .= '</div>';
        $output .= '<div class="pets__catalog-card-like"><img src="/img/like_icon.svg" alt="like" onclick="addToFavorites(' . $pet['id'] . ')"></div>';
        $output .= '<button class="pets__catalog-card-btn-arrow" action="">';
        $output .= '<div></div>';
        $output .= '</button>';
        $output .= '</a>';
        $output .= '</div>';
}
echo $output;
