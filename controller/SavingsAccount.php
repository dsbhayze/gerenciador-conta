<?php
    include_once("../db/dataBaseConnection.php");

    $firstname = $_REQUEST["firstname"];
    $lastname = $_REQUEST["lastname"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    $query_create_user = "INSERT INTO user_tb VALUES(NULL, '$firstname', '$lastname', '$email', '$password')";
    $result_query = mysqli_query($connection, $query_create_user);
?>