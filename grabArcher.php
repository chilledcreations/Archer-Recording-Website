<?php

require_once("settings.php");
session_start();

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    echo "<p> Error connecting to the database, please try again </p>";
} else {
    $sql_table = "Archers";
}

$query = "SELECT Name, Archer_ID FROM $sql_table ORDER BY Name";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "<p> Something went wrong submitting your query: ";
    mysqli_error($conn);
    echo "</p>";
} else {
    echo '<select name="name" id="name">';
    foreach ($result as $row) {
        echo '<option value="' . htmlspecialchars($row['Archer_ID']) . '">' . htmlspecialchars($row['Name']) . '</option>';
    }
    echo '</select>';
}
mysqli_close($conn);
?>