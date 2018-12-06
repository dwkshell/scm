<?php

$update = $_GET['u'];

if (empty($update)) {
    exit();
} else {
    require '../includes/utils/database.inc.php';

    $sql = 'SELECT id_script FROM scripts WHERE uid=?;';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 's', $update);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_script);
        mysqli_stmt_store_result($stmt);

        /* Insert current_timestamp if script exists */
        $result_check = mysqli_stmt_num_rows($stmt);
        if ($result_check > 0) {
            while (mysqli_stmt_fetch($stmt)) {
                $current_timestamp = time();

                $sql = 'INSERT INTO logs(script_id, ping) VALUES (?, FROM_UNIXTIME(?));';
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'is', $id_script, $current_timestamp);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }

                $sql = 'UPDATE scripts SET last_ping = FROM_UNIXTIME(?) WHERE id_script = ?;';
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'si', $current_timestamp, $id_script);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    exit();
                }
            }
        } else {
                header ('Location: ../index.php');
                exit();
            }
        }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
