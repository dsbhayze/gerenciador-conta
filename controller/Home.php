<?php
    include_once("../db/dataBaseConnection.php");

    $email =  $_REQUEST["email"];
    $password = $_REQUEST["password"];

    if(empty($_REQUEST["email"]) || empty($_REQUEST["password"])){
        header("Location: ../index.php");
        exit();
    }

    $query_check_password= "SELECT * FROM user_tb WHERE email='{$email}' AND password='{$password}'";
    
    $result_query = mysqli_query($connection, $query_check_password);

    $row = mysqli_num_rows($result_query);

    if($row == 0)
        echo '<h1 style="color: red">Access Denied!</h1>';
    else {
        echo '<h1 style="color: green">Access Provided!</h1>';
    
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
                        <form action="/gerenciador-conta/controller/CheckingAccount.php" method="post">
                            <th>
                                <input name="value" style="width: 90px" type="number" min="0.00" max="10000000.00" step="0.01" required>
                            </th>
                            <th>
                                <input id="wd" type="radio" name="balance" value="withdraw" required>Withdraw<br>
                                <input id="dp" type="radio" name="balance" value="deposit" required>Deposit
                            </th>
                            <th>
                                <input name="email" style="display:none" value="<?php $email ?>" required>
                            </th>
                            <th>
                                <button name="change-balance" type="submit" style="text-align:center;width:90px">
                                    Apply
                                </button>
                            </th>
                        </form>
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
                        <form action="/gerenciador-conta/controller/SavingsAccount.php" method="post">
                        <th>
                                <input name="value" style="width: 90px" type="number" min="0.00" max="10000000.00" step="0.01" required>
                            </th>
                            <th>
                                <input type="radio" name="balance" value="withdraw" required>Withdraw<br>
                                <input type="radio" name="balance" value="deposit" required>Deposit
                            </th>
                        <th>
                            <button name="change-balance" type="submit" style="text-align:center;width:90px">
                                Apply
                            </button>
                        </th>
                        </form>
                    </tr>';
            while($row = mysqli_fetch_assoc($result_query_savings)){
                echo "<tr><td>". $row["email_user"]."</td><td>". $row["balance"] ."</td></tr>"; 
            }
            echo "</table>";
        }
        else if ($num_rows_checking != 0){
            echo '<table style="border-collapse;width:50%;color:blue;font-family:monospace;font-size:15px;text-align:left">
                    <tr>Conta Corrente</tr>
                    <tr>
                        <th>Email</th>
                        <th>Balance</th>
                        <th>
                            <button name="change-balance" type="submit" style="text-align:center;width:90px">
                                Withdraw Value
                            </button>
                        </th>
                        <th>
                            <button name="change-balance" type="submit" style="text-align:center;width:60px">
                                Deposit Value
                            </button>
                        </th>
                    </tr>';
            while($row = mysqli_fetch_assoc($result_query_checking)){
                echo "<tr><td>". $row["email_user"]."</td><td>". $row["balance"] ."</td></tr>"; 
            }
            echo "</table><br>";
        }
        else if ($num_rows_savings != 0){
            echo '<table style="border-collapse;width:50%;color:blue;font-family:monospace;font-size:15px;text-align:left">
                    <tr>Conta Poupança</tr>
                    <tr>
                        <th>Email</th>
                        <th>Balance</th>
                        <th>
                            <button name="change-balance" type="submit" style="text-align:center;width:90px">
                                Withdraw Value
                            </button>
                        </th>
                        <th>
                            <button name="change-balance" type="submit" style="text-align:center;width:60px">
                                Deposit Value
                            </button>
                        </th>
                    </tr>';
            while($row = mysqli_fetch_assoc($result_query_savings)){
                echo "<tr><td>". $row["email_user"]."</td><td>". $row["balance"] ."</td></tr>"; 
            }
            echo "</table><br>";
        }

        else {
            "<h3>You don't have any checking or saving account</h3>";
        }
    }
?>