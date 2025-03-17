<?php
$page = $_GET['uri'] ?? 'home';
$page = str_replace('.php', '', $page);
$page = $page . '.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php require 'menu.php'; ?>
            </div>
            <div class="col-md-12">
                <?php
                $pagePath = "./pages/$page";
                if (file_exists($pagePath) && is_file($pagePath)) {
                    require $pagePath;
                } else {
                    echo "404 page not found";
                }
                ?>
            </div>
        </div>
    </div>


    <script src="./js/bootstrap.bundle.js"></script>
</body>

</html>