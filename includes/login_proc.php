<?php

include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $hashed_password, $role);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php");
            }
        } else {
            header("Location: ../login.php?error=Invalid Username or Password");
        }
    } else {
        header("Location: ../login.php?error=No User Found");
    }
    $stmt->close();
    $conn->close();
}
?>
