<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ends</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();

if (isset($_SESSION['archer_id']) && isset($_SESSION['round_id']) && isset($_SESSION['ends']) && isset($_SESSION['count'])) {
?>

    <body>
        <form action="submitEnd.php" method="post">
            <?php


            echo '<h1> End ' . $_SESSION["count"] . '</h1>';
            ?>
            <p>Accepted scores: X – 10 – 9 – 8 – 7 – 6 – 5 – 4 – 3 – 2 – 1 – M </p>
            <label for="score1">End 1:</label>
            <input type="text" name="score1" id="score1">
            <label for="score2">End 2:</label>
            <input type="text" name="score2" id="score2">
            <label for="score3">End 3:</label>
            <input type="text" name="score3" id="score3">
            <label for="score4">End 4:</label>
            <input type="text" name="score4" id="score4">
            <label for="score5">End 5:</label>
            <input type="text" name="score5" id="score5">
            <label for="score6">End 6:</label>
            <input type="text" name="score6" id="score6">
            <br>
            <input type="submit" value="Submit score">

            <input type="submit" value="Cancel" formaction="destroysession.php">
        </form>

    </body>

<?php } else {
    header("location: index.php");
} ?>

</html>