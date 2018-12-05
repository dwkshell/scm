<?php
if (isset($_POST['btn-register-user'])) {
    require 'utils/database.inc.php';

    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_r = $_POST['pass-r'];

    /* ---- Error handler ----*/
    if (empty($user) || empty($pass) || empty($pass_r)) {
        header('Location: ../register.php?error=empty');
        exit();

    } else if (!preg_match('/^[a-zA-Z0-9]*$/', $user) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../register.php?error=invaliduserandemail');
        exit();

    } else if (!preg_match('/^[a-zA-Z0-9]*$/', $user)) {
        header('Location: ../register.php?error=invaliduser');
        exit();

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../register.php?error=invalidemail');
        exit();

    } else if ($pass !== $pass_r){
        header('Location: ../register.php?error=passcheck');
        exit();
    } else {
        $sql = 'SELECT user FROM users WHERE user=?;';
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../register.php?error=sql');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $result_check = mysqli_stmt_num_rows($stmt);
            if ($result_check > 0) {
                header('Location: ../register.php?error=usertaken');
                exit();
            } else {
                $sql = 'INSERT INTO users(user, email, pass) VALUES(?, ?, ?);';
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header('Location: ../register.php?error=sql');
                    exit();
                } else {
                    /* Hash password (using bcrypt) */
                    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, 'sss', $user, $email, $hashed_pass);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header('Location: ../index.php?register=success');
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
