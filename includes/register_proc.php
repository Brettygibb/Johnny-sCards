<?php

include("connect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);


    $insertUser = "SELECT * FROM users where Email = ?";
    $stmt = $conn->prepare($insertUser);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        header("Location: ../register.php?error=email");
    }else{
        $sql = "INSERT INTO users(username,email,password) values(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",$username,$email,$hashedPassword);

        if($stmt->execute()){
            header("Location: ../index.php?success=AccountCreatedSuccessfully");

        }
        else{
            header("Location: ../index.php?error=CouldNotBeCreated");

        }
    }
    $stmt->close();
    $conn->close();
    
}