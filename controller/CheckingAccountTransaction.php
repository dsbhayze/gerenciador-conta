<?php
    include_once("../db/DataBaseConnection.php");

    $value =  $_REQUEST["value"];
    $action =  $_REQUEST["action"];
    $email =  $_REQUEST["email"];
    $password = $_REQUEST["password"];

    if($action == "deposit"){
        $query_get_checking_accounts = "SELECT * FROM conta_corrente WHERE email_user='$email'";
        $result_query_checking = mysqli_query($connection, $query_get_checking_accounts);
        $row = mysqli_fetch_assoc($result_query_checking);
        $result = $row["balance"] + $value;

        $query_update_checking_accounts_balance = "UPDATE conta_corrente SET balance='$result' WHERE email_user='$email'";
        $result_query_deposit = mysqli_query($connection, $query_update_checking_accounts_balance);

        echo '<h2 style="color: green;font-family:sans-serif">Action successfully completed.</h2>
                <form action="/gerenciador-conta/controller/Home.php" method="post">
                    <input type="hidden" name="email" value="'.$email.'" required>
                    <input type="hidden" name="password" value="'.$password.'" required>
                    <button name="return" type="submit" style="text-align:center;width:90px">
                        Return to homepage
                    </button>
                </form>';
    }

    else if($action == "withdraw"){
        $query_get_checking_accounts = "SELECT * FROM conta_corrente WHERE email_user='$email'";
        $result_query_checking = mysqli_query($connection, $query_get_checking_accounts);
        $row = mysqli_fetch_assoc($result_query_checking);
        $result = $row["balance"] - $value;

        $query_update_checking_accounts_balance = "UPDATE conta_corrente SET balance='$result' WHERE email_user='$email'";
        $result_query_withdraw = mysqli_query($connection, $query_update_checking_accounts_balance);

        echo '<h2 style="color: green;font-family:sans-serif">Action successfully completed.</h2>
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
                <form action="/gerenciador-conta/controller/Home.php" method="post">
                    <input type="hidden" name="email" value="'.$email.'" required>
                    <input type="hidden" name="password" value="'.$password.'" required>
                    <button name="return" type="submit" style="text-align:center;width:90px">
                        Return to homepage
                    </button>
                </form>';
    }
?>