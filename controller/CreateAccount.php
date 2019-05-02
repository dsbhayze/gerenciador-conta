<?php
    include_once("../db/DataBaseConnection.php");

    $firstname =  $_REQUEST["firstname"];
    $lastname =  $_REQUEST["lastname"];
    $email =  $_REQUEST["email"];
    $password = $_REQUEST["password"];

    if($email){
        $query_create_account = "INSERT INTO user_tb VALUES(NULL, '$firstname', '$lastname', '$email', '$password')";
        $result_query_checking = mysqli_query($connection, $query_create_account);

        echo '<h2 style="color: green;font-family:sans-serif">Account successfully created.</h2>
                <form action="/gerenciador-conta/controller/Home.php" method="post">
                    <input type="hidden" name="email" value="'.$email.'" required>
                    <input type="hidden" name="password" value="'.$password.'" required>
                    <button name="return" type="submit" style="text-align:center;width:90px">
                        Return to homepage
                    </button>
                </form>';
    }
    else {
        echo '<h2 style="color: red;font-family:sans-serif">Something wrong happened, please contact us in this numeber 555-555.</h2>
                <form action="/gerenciador-conta/controller/index.php" method="post">
                    <button name="return" type="submit" style="text-align:center;width:90px">
                        Return to homepage
                    </button>
                </form>';
    };
?>