<?php
if (isset($_POST['btn-new-check'])) {
    require '../utils/database.inc.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $name = $_POST['name'];
    $alarm_time = $_POST['alarm-time'];
    $warning_time = $_POST['warning-time'];

    // Error handler
    if (empty($name) || empty($alarm_time) || empty($warning_time)) {
        header('Location: ../../panel/new.php?error=empty');
        exit();
    } else if (!preg_match('/^[a-zA-Z0-9_ ]*$/', $name)) {
        header('Location: ../../panel/new.php?error=invalidname');
        exit();
    } else if (!preg_match('/^[0-9]*$/', $warning_time)) {
        header('Location: ../../panel/new.php?error=invalidwarning');
        exit();
    } else {
        require '../utils/uuid_gen.inc.php';

        $sql = 'SELECT * FROM scripts WHERE uid=?;';
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../../panel/new.php?error=sql');
            exit();
        } else {
            $rand_uid = uuid_v4();

            mysqli_stmt_bind_param($stmt, 's', $rand_uid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $result_check = mysqli_stmt_num_rows($stmt);
            if ($result_check > 0) {
                header('Location: ../../panel/panel.php?error=uidrepeated');
                exit();
            } else {
                $sql = 'INSERT INTO scripts(user_id, name, uid, alarm_time, warning_time) VALUES(?, ?, ?, ?, ?);';
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header('Location: ../../panel/new.php?error=sql');
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'isssi', $_SESSION['s_id_user'], $name, $rand_uid, $alarm_time, $warning_time);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header('Location: ../../panel/panel.php?create=success');
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header('Location: ../index.php');
    exit();
}
