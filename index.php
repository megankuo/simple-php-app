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
    <title>CLICKCLICKCLICK!</title>
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

            post('results.php', {
                resultTime: resultTime,
                goal: goal
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

        // session timeout 5 hours???
        echo "<form id='clicker' action='results.php'>
        <input type='hidden' name='resultTime' value='null'>
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
//    echo 'This some dynamic content';

    ?>
</body>

</html>

<?php
ob_end_flush();
