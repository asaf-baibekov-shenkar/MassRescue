<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserData</title>
</head>
<body>
    <?php
    $userN = $_GET["Username"];
    $pass = $_GET["Password"];
    echo "The user name is:" . $userN . " and The password is:" . $pass . "";
    ?>
</body>
</html>