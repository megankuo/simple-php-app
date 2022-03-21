<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click!</title>
    <link rel="stylesheet" href="styles.css">
</head>

<script language="JavaScript">
    function handleClick() {
        incCounter();
        alert('clicked!');
    }
</script>

<body>
    <span onClick="handleClick()" class="dot"></span>
</body>

</html>

<?php
// counter exists in the background
$counter = 0;
function incCounter()
{
    global $counter;

    $counter++;
}
?>