<?php
session_start();

if ($_SESSION['status'] == "") {
    echo "<script>alert('ยินดีต้อนรับ อาจารย์')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=teacher/index.php\">";
    exit();
} else if ($_SESSION['status'] != 'teacher') {
    echo "<script>alert('ยินดีต้อนรับ อาจารย์')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=teacher/index.php\">";
    exit();
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'haed.php'; ?>
    </head>

    <body>
        <?php

        if (empty($_GET)) {
            include 'main.php';
        }
        if (isset($_GET['main'])) {
            include "main.php";
        }

        ?>
        <?php include 'script.php'; ?>

    </body>

    </html>

<?php } ?>