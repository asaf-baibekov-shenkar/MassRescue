<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $event_name = $_GET["event_name"];
    $event_des = $_GET["event_description"];
    $event_type = $_GET["event_type"];
    if($event_type == 0) $event_type = "other";
    else if($event_type == 1) $event_type = "earth quake";
    else $event_type = "fire";
    echo "The event name is:" . $event_name . "\n";
    echo "The event type is:" . $event_type . "\n";
    echo "The event description is:" . $event_des . "\n";
    ?>
</body>
</html>