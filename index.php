<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ออกประชาสัมพันธ์หลักสูตรคณะวิทยาศาสตร์</title>
    
</head>

<body>
    <?php
    if (empty($_GET)) {
        include './new.php';
    }
    if (isset($_GET['login'])) {
        include './login.php';
    }
    ?>

</body>

</html>