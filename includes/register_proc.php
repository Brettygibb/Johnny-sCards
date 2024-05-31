<?php

include("connect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //need stored proc
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if($conn->query($sql) === TRUE){
        //change this to a message in the index
        echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

    header("index.php");
}