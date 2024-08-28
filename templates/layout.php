<?php 

// point d'entrée des pages, et affichage en fonction de ce qui est demandé

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $metaDesc ?>">
    <link rel="stylesheet" href="css/fraldev-bundle.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="pos-rel txt-one">
    <?php include "templates/pages/$page.php"; ?>
    <script src="js/fraldev-bundle.js" defer></script>
    <script src="js/app.js"></script>
</body>
</html>