<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel='stylesheet' href='css/home.css' /> 
    <title>Knopka</title>
</head>

<body>
    <div class="container">
        <?php
            session_start(); 
            
            require "partials/header.php" 
        ?>
        <!-- <div id="dynamicContent"> -->
        <?php require 'partials/home/body.php' ?>
        <!-- </div> -->
    </div>
    <?php require 'partials/footer.php' ?>

</body>

</html>