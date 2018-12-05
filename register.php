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
                    } else if ($_GET['error'] == 'invaliduserandemail') {
                        echo '<p style="background: #600000;">Invalid user & email!</p>';
                    } else if ($_GET['error'] == 'invaliduser') {
                        echo '<p style="background: #600000;">Invalid user!</p>';
                    } else if ($_GET['error'] == 'invalidemail') {
                        echo '<p style="background: #600000;">Invalid email!</p>';
                    } else if ($_GET['error'] == 'passcheck') {
                        echo '<p style="background: #600000;">Passwords don\'t match!</p>';
                    }
                }
                ?>
                <form style="padding-top:20px;" action="includes/register.inc.php" method="post">
                    <fieldset style="padding:20px;">
                        <legend>&nbsp;Create new user account&nbsp;</legend>
                        User: <br>
                        <input style="font-family: monospace;color:#000;margin-bottom:15px;" type="text" name="user"> <br>
                        Email: <br>
                        <input style="font-family: monospace;color:#000;margin-bottom:15px;" type="text" name="email"> <br>
                        Password: <br>
                        <input style="font-family: monospace;color:#000;margin-bottom:15px;" type="password" name="pass"> <br>
                        Repeat password: <br>
                        <input style="font-family: monospace;color:#000;margin-bottom:15px;" type="password" name="pass-r"> <br>

                        <button type="submit" name="btn-register-user">Accept</button> <br>
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
