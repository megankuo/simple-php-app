<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Fun Game!</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<script language="JavaScript">
    // generate a goal
    var goal;
    var counter = 0;

    function setGoal() {
        goal = document.getElementById('goal').innerText;
        console.log(goal);
        return parseInt(goal);
    }

    // form is disabled if counter < goal

    // allow the POST request once the counter reaches goal

    function handleClick(e) {
        e.preventDefault();
        counter++;
        console.log(counter)
        var goal = setGoal();
        if(counter===1){
            var startTime= new Date();
        }
        checkClick(counter, goal, startTime);
    }

    function checkClick(counter, goal, startTime) {
        if (goal === counter) {
            // Allow Post request
            var endTime=new Date()
            var resultTime =(endTime.getTime())/1000;
            $.ajax({
            type : "POST",  //type of method
            url  : "results.php",  //your page
            data : { startTime : startTime, endTime : endTime },// passing the values
            success: function(res){
                window.location.href = '/results.php';             //do what you want here...
                    }
        });

        }
    }
</script>

<body>
    <?php
    // counter exists in the background
    $counter = 0;
    function incCounter()
    {
        global $counter;

        $counter++;
    }
    if ($counter > 0) {
        //start timer

        // when the timer ends, save counter to session/cookie

        // send the user to new page (or refresh)
    }

    // 1. first time on page; no SESSION data: show play button
    if (!isset($_SESSION['played_today'])) {
        // allowed to play
        $goal = rand(20, 90);
        echo "<div id='goal'>$goal</div>";
        echo 'This your first time here' . '<br/>';
        // session timeout 5 hours???
        echo "<form action='results.php' onSubmit='handleSubmit(e)'>
        <input class='dot' onClick='handleClick()' value='Click!'/>
        </form>
        <br>";
        // echo "<div class='counter'> $counter </div>";
    } else if (isset($_POST)) {
        echo "post!!!";
        incCounter();
    } else {
        // not allowed to play
        // show their last click score from session/cookie
        echo 'You have been here before';
        header("refresh:3;url=results.php");
    }
    echo 'This some dynamic content';

    ?>
</body>

</html>

<?php
ob_end_flush();
