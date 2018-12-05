<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['s_logged']) {
        header ('Location: panel/panel.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charSet="utf-8"/>
    <title>scm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <main>
        <header><a href="index.php"><< back</a></header>
        <div class="container">
            <section>
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'empty') {
                        echo '<p style="background: #600000;">Empty fields!</p>';
                    } else if ($_GET['error'] == 'wrongpassword') {
                        echo '<p style="background: #600000;">Wrong password!</p>';
                    } else if ($_GET['error'] == 'usernotfound') {
                        echo '<p style="background: #600000;">User not found!</p>';
                    }
                }
                ?>
                <form style="padding-top:20px;" action="includes/login.inc.php" method="post">
                    <fieldset style="padding:20px;">
                        <legend>&nbsp;Log in&nbsp;</legend>
                        User: <br>
                        <input style="font-family: monospace;color:#000;margin-bottom:15px;" type="text" name="user"> <br>
                        Password: <br>
                        <input style="font-family: monospace;color:#000;margin-bottom:15px;" type="password" name="pass"> <br>

                        <button type="submit" name="btn-login-user">Accept</button> <br>
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
