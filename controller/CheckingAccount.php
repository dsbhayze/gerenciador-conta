<?php
    include_once("../db/dataBaseConnection.php");

    $value =  $_REQUEST["value"];
    $balance =  $_REQUEST["balance"];
    $email =  $_REQUEST["email"];
    echo $balance;
    echo $email;

    $query_get_checking_accounts = "SELECT * FROM conta_corrente WHERE email_user='$email'";
    $result_query_checking = mysqli_query($connection, $query_get_checking_accounts); 
    $num_rows_checking = mysqli_num_rows($result_query_checking);

    $query_get_savings_accounts = "SELECT * FROM conta_poupanca WHERE email_user='{$email}'";
    $result_query_savings = mysqli_query($connection, $query_get_savings_accounts); 
    $num_rows_savings = mysqli_num_rows($result_query_savings);

    if ($num_rows_checking != 0 && $num_rows_savings != 0){
        echo '<table style="border-collapse;width:50%;color:blue;font-family:monospace;font-size:15px;text-align:left">
                <tr>Conta Corrente</tr>
                <tr>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>';
        while($row = mysqli_fetch_assoc($result_query_checking)){
            echo "<tr><td>". $row["email_user"]."</td><td>". $row["balance"] ."</td></tr>";
        }
        echo "</table><br>";
        echo '<table style="border-collapse;width:50%;color:green;font-family:monospace;font-size:15px;text-align:left">
                <tr>Conta Poupança</tr>
                <tr>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>';
        while($row = mysqli_fetch_assoc($result_query_savings)){
            echo "<tr><td>". $row["email_user"]."</td><td>". $row["balance"] ."</td></tr>"; 
        }
        echo "</table>";
    }

?>