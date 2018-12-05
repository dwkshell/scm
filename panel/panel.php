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
        <header>
            <form action="../includes/logout.inc.php" method="post">
                <button type="submit"><< logout</button> <br>
            </form>
        </header>
        <div class="container">
            <section>
                <div>
                    <fieldset style="padding:10px;">
                        <legend>&nbsp;Control panel&nbsp;</legend>
                        <a class="panel-button" href="new.php">&nbsp;New check&nbsp;</a> <br>
                        <div style="padding:10px;">
                            <hr color="#7a7a7a" size="1"> <br>
                            <?php
                                require '../includes/utils/database.inc.php';

                                $sql = 'SELECT name, alarm_time, last_ping FROM scripts WHERE user_id=?;';
                                $stmt = mysqli_stmt_init($conn);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header('Location: ../login.php?error=sql');
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['s_id_user']);
                                    mysqli_stmt_execute($stmt);

                                    $result = mysqli_stmt_get_result($stmt);

                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $script_name =  $row['name'];
                                        $script_alarm_time = $row['alarm_time'];
                                        $script_last_ping = $row['last_ping'];

                                        /* TO-DO: - styling */
                                        echo '<div style="padding:2px">';
                                        echo '<p>' . $i . '. [';
                                        echo $script_name . '] Alarm: ';
                                        echo $script_alarm_time . ' Last check: ';
                                        echo $script_last_ping;
                                        echo '</p>';
                                        echo '</div>';

                                        $i++;
                                    }
                                }

                             ?>
                    </fieldset>
                </div>
            </section>
        </div>
        <footer>
            <span>MIT 2018-2019</span>
        </footer>
    </main>
</body>
</html>
