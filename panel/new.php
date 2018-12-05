<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!$_SESSION['s_logged']) {
        header ('Location: ../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charSet="utf-8"/>
    <title>scm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <main>
        <header><a href="panel.php"><< back</a></header>
        <div class="container">
            <section>
                <form style="padding-top:20px;" action="../includes/panel/new.inc.php" method="post">
                    <fieldset style="padding:20px;">
                        <legend>&nbsp;Create new check&nbsp;</legend>
                        Name: <br>
                        <input size="25" type="text" name="name"> <br>
                        Alarm time (time): <br>
                        <input type="time" name="alarm-time"> <br>
                        Warning time (seconds): <br>
                        <input size="5" type="text" name="warning-time"> <br>

                        <button type="submit" name="btn-new-check">Accept</button> <br>
                    </fieldset>
                </form>
            </section>
        </div>
        <footer>
            <span>MIT 2018-2019</span>
        </footer>
    </main>
</body>
</html>
