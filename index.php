<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
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
        <?php
        if (isset($_SESSION['s_id_user'])) {
            echo '<header><a href="panel/panel.php">go to panel >></a></header>';
        } else {
            echo '<header><a href="login.php">login</a> / <a href="register.php">register</a></header>';
        }
        ?>
        <div class="container">
            <section>
                <h1>scm</h1>
                <nav>
                    <a href="#">about</a>
                    <a target="_blank" href="https://github.com/vargasrc/scm">src</a>
                </nav>
            </section>
        </div>
        <footer>
            <span>MIT 2018-2019</span>
        </footer>
    </main>
</body>
</html>
