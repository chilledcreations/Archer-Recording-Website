<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitting score...</title>
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

    $scores = ['score1', 'score2', 'score3', 'score4', 'score5', 'score6'];
    foreach ($scores as $score) {
        if (isset($_POST[$score])) {
            $$score = sanitise_input($_POST[$score]);
        } else {
            echo '<h1> Missing score: ' . htmlspecialchars($score) . '</h1>';
            exit;
        }
    }

    foreach ($scores as $score) {
        if (!preg_match('/^(X|M|10|[1-9])$/', $$score)) {
            echo '<h1> Invalid score for ' . htmlspecialchars($score) . ', try again </h1>';
            exit;
        }
    }

    foreach ($scores as $score) {
        if ($$score == 'X') {
            $$score = 10;
        } elseif ($$score == 'M') {
            $$score = 0;
        }
    }

    require_once("settings.php");

    $count = $_SESSION["count"];
    $archer = $_SESSION["archer_id"];

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    if (!$conn) {
        echo "<p>Error connecting to the database: </p>";
        exit;
    }

    $sql_table = "Ends";
    $query = "INSERT INTO $sql_table (`score1`, `score2`, `score3`, `score4`, `score5`, `score6`, `Position_in_round`, `Archer`)
              VALUES ($score1, $score2, $score3, $score4, $score5, $score6, $count, $archer)";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p>Something went wrong submitting your query: " . mysqli_error($conn) . "</p>";
        exit;
    }

    $query = "SELECT End_ID, (score1 + score2 + score3 + score4 + score5 + score6) AS total_score 
              FROM Ends 
              JOIN Archers ON Ends.Archer = Archers.Archer_ID 
              WHERE Archers.Archer_ID = $archer 
              ORDER BY Ends.End_ID DESC 
              LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $total = $row['total_score'];
        $end_id = $row['End_ID'];

        $sql_table = "Score";
        $query = "INSERT INTO $sql_table (End_ID, Total_round) VALUES ($end_id, $total)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION["count"] = $count + 1;
            if ($_SESSION["count"] > $_SESSION["ends"]) {
                header("Location: destroysession.php");
                exit;
            } else {
                header("Location: ends.php");
                exit;
            }
        } else {
            echo "<p>Something went wrong inserting into the Score table: " . mysqli_error($conn) . "</p>";
            exit;
        }
    } else {
        echo "<p>No matching record found: " . mysqli_error($conn) . "</p>";
        exit;
    }

    mysqli_close($conn);
    ?>
</body>

</html>