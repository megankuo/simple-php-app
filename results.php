<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result!</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php

    $_SESSION['played_today'] = true;
    $timeResult = $_POST['resultTime'];
    $goal = $_POST['goal'];
    $avg = $goal / $timeResult;
    if (isset($_POST['resultTime'])) {
        echo "<h2>$goal clicks done in $timeResult seconds!!!!!!!!</h2>";
        echo "<div class='container'>Average clicks per second: $avg</div>";
        echo "<div class='container'>Take a screenshot and show your friends!</div>";
        echo "<a href='index.php'><button>Try again!</button></a>";
    } else {
        header("Location: index.php");
        die();
    }

    ?>
</body>

</html>