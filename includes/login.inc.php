<?php
if (isset($_POST['btn-login-user'])) {
    require 'utils/database.inc.php';

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    /* ---- Error handler ----*/
    if (empty($user) || empty($pass)) {
        header('Location: ../login.php?error=empty');
        exit();
    } else {
        $sql = 'SELECT * FROM users WHERE user=?;';
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../login.php?error=sql');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pass_check = password_verify($pass, $row['pass']);
                if ($pass_check == false) {
                    header('Location: ../login.php?error=wrongpassword');
                    exit();
                } else {
                    session_start();
                    $_SESSION['s_id_user'] = $row['id_user'];
                    $_SESSION['s_user'] = $row['user'];
                    $_SESSION['s_logged'] = true;

                    header('Location: ../panel/panel.php');
                    exit();
                }
            } else {
                header('Location: ../login.php?error=usernotfound');
                exit();
            }
        }
    }
} else {
    header('Location: ../index.php');
    exit();
}
