<?php

require_once("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    echo "<p> Error connecting to the database, please try again </p>";
} else {
    $sql_table = "Round";
}

$query = "SELECT r.Round_ID, r.Round_catagory, t.Distance FROM $sql_table r JOIN Target t ON r.Target = t.Target_ID ORDER BY r.Round_catagory";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "<p> Something went wrong submitting your query: ";
    mysqli_error($conn);
    echo "</p>";
} else {
    echo '<select name="round" id="round">';
    foreach ($result as $row) {
        echo '<option value="' . htmlspecialchars($row['Round_ID']) . '">' . htmlspecialchars($row['Round_catagory']) . ', ' . htmlspecialchars($row['Distance']) . '</option>';
    }
    echo '</select>';
}

mysqli_close($conn);
?>

