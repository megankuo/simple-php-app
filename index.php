<?php
ob_start();
require('vendor/autoload.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>CLICKCLICKCLICK!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<script language="JavaScript">
    // grab the goal that was generated with php
    var goal;
    var counter = 0;

    function setGoal() {
        goal = document.getElementById('goal').innerText;
        console.log(goal);
        return parseInt(goal);
    }

    // allow the POST request once the counter reaches goal

    let startTime;
    let endTime;

    function handleClick() {
        counter++;
        console.log(counter)
        let goal = setGoal();
        if (counter == 1) {
            startTime = new Date();
            console.log('making starttime: ', startTime);
        }
        if (goal == counter) {
            // Allow Post request
            endTime = new Date()
            console.log('end starttime', startTime);
            console.log('end endtime', endTime);
            let resultTime = (endTime.getTime() - startTime.getTime()) / 1000;

            var redirect = 'results.php';

            /**
             * sends a request to the specified url from a form. this will change the window location.
             * @param {string} path the path to send the post request to
             * @param {object} params the parameters to add to the url
             * @param {string} [method=post] the method to use on the form
             */

            function post(path, params, method = 'post') {

                // The rest of this code assumes you are not using a library.
                // It can be made less verbose if you use one.
                const form = document.createElement('form');
                form.method = method;
                form.action = path;

                for (const key in params) {
                    if (params.hasOwnProperty(key)) {
                        const hiddenField = document.createElement('input');
                        hiddenField.type = 'hidden';
                        hiddenField.name = key;
                        hiddenField.value = params[key];

                        form.appendChild(hiddenField);
                    }
                }

                document.body.appendChild(form);
                form.submit();
            }
            // make the post to results.php and send user there
            post('results.php', {
                resultTime: resultTime,
                goal: goal
            });

        }
    }
</script>

<body>
    <?php

    // 1. first time on page; no SESSION data: show play button
    if (!isset($_SESSION['played_today'])) {
        // allowed to play
        $goal = rand(30, 1000);
        echo "<div class='container'>
                <h1>Click like the wind</h1>
            </div>
            <div class='container'>
                <p>How fast is your click speed?</p>
            </div>
            <div class='container'>
                <h2>Click this many times: <span id='goal'>$goal</span></h2>
            </div>";

        echo "<form id='clicker' action='results.php'>
        <input type='hidden' name='resultTime' value='null'>
        <input readonly class='dot' onClick='handleClick()' value='Click!' type='text'/>
        </form>
        <br>";
    } else {
        // TODO: not allowed to play because session has not timed out
        // show their last click score from session/cookie
        echo 'You have been here before';
        header("refresh:3;url=results.php");
    }

    ?>
</body>

</html>

<?php
ob_end_flush();
