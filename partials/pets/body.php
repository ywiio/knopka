<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="/css/pets.css" type="text/css">
    <script src="/scripts/loads_scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Knopka</title>
</head>

<body>
    <div class="container">
        <?php require "../header.php" ?>  
        <?php 
            include "../../db/connect_db.php";
            session_start();
        ?>

        <main class="pets">
            <div class="pets__filter">
                <div class="pets__filter-block">
                    <div class="pets__filter-block-title" onclick="toggleCategories('category')">
                        <h5>Категория</h5>
                        <img src="/img/arr-filter_icon.svg" alt="arrow">
                    </div>
                    <div id="categoryList" class="pets__filter-block-list" style="display: none;">
                        <?php
                            $sql = "SELECT * FROM category";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<label><input type='checkbox' id=".$row["category_id"]." onclick='updatePets()'>".$row["category"]."</label>";
                            }
                        ?>
                    </div>

                    <div class="pets__filter-block-title" onclick="toggleCategories('gender')">
                        <h5>Пол</h5>
                        <img src="/img/arr-filter_icon.svg" alt="arrow">
                    </div>
                    <div id="genderList" class="pets__filter-block-list" style="display: none;">
                        <?php
                            $sql = "SELECT * FROM gender";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<label><input type='checkbox' id=".$row["gender_id"]." onclick='updatePets()'>".$row["gender"]."</label>";
                            }
                        ?>
                    </div>

                    <div class="pets__filter-block-title" onclick="toggleCategories('size')">
                        <h5>Размер</h5>
                        <img src="/img/arr-filter_icon.svg" alt="arrow">
                    </div>
                    <div id="sizeList" class="pets__filter-block-list" style="display: none;">
                        <?php
                            $sql = "SELECT * FROM size";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<label><input type='checkbox' id=".$row["size_id"]." onclick='updatePets()'>".$row["size"]."</label>";
                            }
                        ?>
                    </div>

                    <div class="pets__filter-block-title" onclick="toggleCategories('wool')">
                        <h5>Тип шерсти</h5>
                        <img src="/img/arr-filter_icon.svg" alt="arrow">
                    </div>
                    <div id="woolList" class="pets__filter-block-list" style="display: none;">
                        <?php
                            $sql = "SELECT * FROM wool_info";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<label><input type='checkbox' id=".$row["wool_info_id"]." onclick='updatePets()'>".$row["wool_info"]."</label>";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="pets__catalog" id="filteredResults">
                <?php
                    $sql ="SELECT * FROM pets 
                            INNER JOIN gender ON pets.gender_fk = gender.gender_id";

                    $pets = $conn->query($sql);

                    foreach ($pets as $pet) {
                        echo '<div id=' . $pet['id'] . '" class="pets__catalog-card">';
                        if (!empty($_SESSION['id_user'])) {
                            $id_user = $_SESSION['id_user'];
                            $id_pet=$pet['id'];
                            $query_likes = "SELECT * FROM favorites WHERE id_pet='$id_pet' AND id_user='$id_user'";
                            $result_likes = mysqli_query($conn, $query_likes) or die("Ошибка " . mysqli_error($conn));
                            $row_likes = mysqli_fetch_row($result_likes);
                            if ($row_likes) { 
                                echo '<div class="pets__catalog-card-like pets__catalog-card-like-'.$id_pet.'"><img src="/img/like_icon_full.svg" onclick="del_like('.$id_pet.','.$id_user.')" ></img></div>';  
                            } else { 
                                echo '<div class="pets__catalog-card-like pets__catalog-card-like-'.$id_pet.'"><img src="/img/like_icon.svg" onclick="set_like('.$id_pet.','.$id_user.')" ></img></div>'; 
                            }
                        } 
                        echo '<a href="/partials/pets/pet_body.php?petID='.$pet['id'].'">';
                        echo '<img src="'.$pet['img'].'" alt="'.$pet['name'].'">';
                        echo '<div class="pets__catalog-card-info">';
                        echo '<h4>' . $pet['name'] . ',</h4>';
                        echo '<p>' . $pet['gender'] . '<br>' . $pet['age'].'</p>';
                        echo '</div>';
                        // echo '<div class="pets__catalog-card-like"><img src="/img/like_icon.svg" alt="like" onclick="addToFavorites(' . $pet['id'] . ')"></div>';
                        echo '<button class="pets__catalog-card-btn-arrow" action="">';
                        echo '<div></div>';
                        echo '</button>';
                        echo '</a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </main>
    </div>
    <?php require '../footer.php' ?>
    <?php 
        $conn->close();
    ?>
    <script>
    
    function getCheckedValues() {
        var categoryIds = [];
        var genderIds = [];
        var sizeIds = [];
        var woolIds = [];

        var categoryCheckboxes = document.querySelectorAll('#categoryList input[type="checkbox"]:checked');
        categoryCheckboxes.forEach(function(checkbox) {
            categoryIds.push(checkbox.id);
        });

        var genderCheckboxes = document.querySelectorAll('#genderList input[type="checkbox"]:checked');
        genderCheckboxes.forEach(function(checkbox) {
            genderIds.push(checkbox.id);
        });

        var sizeCheckboxes = document.querySelectorAll('#sizeList input[type="checkbox"]:checked');
        sizeCheckboxes.forEach(function(checkbox) {
            sizeIds.push(checkbox.id);
        });

        var woolCheckboxes = document.querySelectorAll('#woolList input[type="checkbox"]:checked');
        woolCheckboxes.forEach(function(checkbox) {
            woolIds.push(checkbox.id);
        });

        return { categoryIds: categoryIds, genderIds: genderIds, sizeIds: sizeIds, woolIds: woolIds };
    }

    function updatePets() {
        var Ids = getCheckedValues();

        $.ajax({ 
            type: "POST", 
            url: "filter.php", 
            data: {
                category: Ids['categoryIds'], 
                gender: Ids['genderIds'], 
                size: Ids['sizeIds'], 
                wool: Ids['woolIds']
            },
            dataType: "html", 
            success: function(data){ 
                $('.pets__catalog').html(data); 
            } 
        });
    }

    </script>
</body>
</html>
