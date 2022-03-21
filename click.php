<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click!</title>
</head>

<body onClick="handleClick">
    <?php

    $counter = 0;
    echo $counter;

    ?>
</body>

<script>
    function handleClick() {
        incCounter();
        alert('clicked!');
    }
</script>

</html>

<?php
    function incCounter() {
        global $counter;

        $counter++;
    }
?>