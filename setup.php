<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initializing</title>
</head>
<body>
<?php
    session_start();

    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["name"]))
    {
        $name = $_POST["name"];
    } else {
        header("location: index.php");
    }

    if(isset($_POST["round"]))
    {
        $round = $_POST["round"];
    } else {
        header("location: index.php");
    }
    
    if(isset($_POST["ends"]))
    {
        $ends = (int)$_POST["ends"];
    } else {
        header("location: index.php");
    }

    $name = sanitise_input($name);
    $round = sanitise_input($round);
    $ends = sanitise_input($ends);

    $_SESSION['archer_id'] = $name;
    $_SESSION['round_id'] = $round;
    $_SESSION['ends'] = $ends;
    $_SESSION['count'] = 1;

    header("location: ends.php")

?>
    
</body>
</html>