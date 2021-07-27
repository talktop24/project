<?php
session_start();

if ($_SESSION['status'] == "") {
    echo "<script>alert('หน้าสำหรับ admin กรุณาเข้าสู่ระบบ')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=../index.php?login\">";
    exit();
} else if ($_SESSION['status'] != 'admin') {
    echo "<script>alert('หน้าสำหรับ admin กรุณาเข้าสู่ระบบ')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=../index.php?login\">";
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