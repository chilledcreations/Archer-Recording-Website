<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archery Club</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="setup.php" method="post" id="menu">
        <h1>Record Data 🏹🎯</h1>
        <div class="form-group">
            <label for="names">Select a Name:</label>
            <?php include_once 'grabArcher.php' ?>
        </div>

        <div class="form-group">
            <label for="round">Choose a round:</label>
            <?php include_once 'grabRound.php' ?>

        </div>
        <div class="form-group">
            <label for="ends">How many ends?</label>
            <select name="ends" id="ends">
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>


        <div class="form-group"><input type="submit" value="Submit"></div>
    </form>
</body>

</html>