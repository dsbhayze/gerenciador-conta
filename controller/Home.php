<?php
    include_once("../db/DataBaseConnection.php");

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
        echo '<h1 style="color: red;font-text:sans-serif">Access Denied!</h1>';
    else {
        echo '<h1 style="color: green;font-text:sans-serif">Access Provided!</h1>';
    
        $query_get_checking_accounts = "SELECT * FROM conta_corrente WHERE email_user='$email'";
        $result_query_checking = mysqli_query($connection, $query_get_checking_accounts); 
        $num_rows_checking = mysqli_num_rows($result_query_checking);

        $query_get_savings_accounts = "SELECT * FROM conta_poupanca WHERE email_user='{$email}'";
        $result_query_savings = mysqli_query($connection, $query_get_savings_accounts); 
        $num_rows_savings = mysqli_num_rows($result_query_savings);

        if ($num_rows_checking != 0 && $num_rows_savings != 0){
            echo '<body style="font-text:sans-serif">
            <table style="border-collapse;width:50%;color:blue;font-family:monospace;font-size:15px;text-align:left">
                    <tr>Conta Corrente</tr>
                    <tr>
                        <th>Email</th>
                        <th>Balance</th>
                        <form action="/gerenciador-conta/controller/CheckingAccountTransaction.php" method="post">
                            <th>
                                <input type="hidden" name="email" value="'.$email.'" required>
                            </th>
                            <th>
                                <input type="hidden" name="password" value="'.$password.'" required>
                            </th>
                            <th>
                                <input name="value" style="width: 90px" type="number" min="0.00" max="10000000.00" step="0.01" value="value" required>
                            </th>
                            <th>
                                <input id="wd" type="radio" name="action" value="withdraw" required>Withdraw<br>
                                <input id="dp" type="radio" name="action" value="deposit" required>Deposit
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
            echo "</body></table><br>";
            echo '<table style="border-collapse;width:50%;color:green;font-family:monospace;font-size:15px;text-align:left">
                    <tr>Conta Poupança</tr>
                    <tr>
                        <th>Email</th>
                        <th>Balance</th>
                        <form action="/gerenciador-conta/controller/SavingsAccountTransaction.php" method="post">
                            <th>
                                <input type="hidden" name="email" value="'.$email.'" required>
                            </th>
                            <th>
                                <input type="hidden" name="password" value="'.$password.'" required>
                            </th>
                            <th>
                                <input name="value" style="width: 90px" type="number" min="0.00" max="10000000.00" step="0.01" value="value" required>
                            </th>
                            <th>
                                <input id="wd" type="radio" name="action" value="withdraw" required>Withdraw<br>
                                <input id="dp" type="radio" name="action" value="deposit" required>Deposit
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
            echo "</body></table>";
        }
        else if ($num_rows_checking != 0){
            echo '<table style="border-collapse;width:50%;color:blue;font-family:monospace;font-size:15px;text-align:left">
                    <tr>Conta Corrente</tr>
                        <tr>
                                <th>Email</th>
                            <th>Balance</th>
                            <form action="/gerenciador-conta/controller/CheckingAccountTransaction.php" method="post">
                                <th>
                                    <input type="hidden" name="email" value="'.$email.'" required>
                                </th>
                                <th>
                                    <input type="hidden" name="password" value="'.$password.'" required>
                                </th>
                                <th>
                                    <input name="value" style="width: 90px" type="number" min="0.00" max="10000000.00" step="0.01" value="value" required>
                                </th>
                                <th>
                                    <input id="wd" type="radio" name="action" value="withdraw" required>Withdraw<br>
                                    <input id="dp" type="radio" name="action" value="deposit" required>Deposit
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
            echo '</body></table><br>
            <h2>You dont have saving account</h2>
            <h3>If You want to create one, please click here.</h3>
                <table>
                    <form action="/gerenciador-conta/controller/CreateSavingAccount.php" method="post">
                        <th>
                            <input type="hidden" name="email" value="'.$email.'" required>
                        </th>
                        <th>
                            <input type="hidden" name="password" value="'.$password.'" required>
                        </th>
                        <th>
                            <button name="new-account" type="submit" style="text-align:center;width:90px">
                            Saving Account
                            </button>
                        </th>
                    </form>
                </table>';
        }
        else if ($num_rows_savings != 0){
            echo '<table style="border-collapse;width:50%;color:blue;font-family:monospace;font-size:15px;text-align:left">
                    <tr>Conta Poupança</tr>
                    <tr>
                        <th>Email</th>
                        <th>Balance</th>
                        <form action="/gerenciador-conta/controller/SavingsAccountTransaction.php" method="post">
                            <th>
                                <input type="hidden" name="email" value="'.$email.'" required>
                            </th>
                            <th>
                                <input type="hidden" name="password" value="'.$password.'" required>
                            </th>
                            <th>
                                <input name="value" style="width: 90px" type="number" min="0.00" max="10000000.00" step="0.01" value="value" required>
                            </th>
                            <th>
                                <input id="wd" type="radio" name="action" value="withdraw" required>Withdraw<br>
                                <input id="dp" type="radio" name="action" value="deposit" required>Deposit
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
            echo '</body></table><br>
            </body></table><br>
            <h2>You dont have saving account</h2>
            <h3>If You want to create one, please click here.</h3>
                <table>
                    <form action="/gerenciador-conta/controller/CreateCheckingAccount.php" method="post">
                        <th>
                            <input type="hidden" name="email" value="'.$email.'" required>
                        </th>
                        <th>
                            <input type="hidden" name="password" value="'.$password.'" required>
                        </th>
                        <th>
                            <button name="new-account" type="submit" style="text-align:center;width:90px">
                            Checking Account
                            </button>
                        </th>
                    </form>
                </table>';
        }
        else {
            echo '<h3>You dont have any checking or saving account</h3>
                    <h2>Please, create your account here</h2>
                    <table>
                        <form action="/gerenciador-conta/controller/CreateCheckingAccount.php" method="post">
                            <th>
                                <input type="hidden" name="email" value="'.$email.'" required>
                            </th>
                            <th>
                                <input type="hidden" name="password" value="'.$password.'" required>
                            </th>
                            <th>
                                <button name="new-account" type="submit" style="text-align:center;width:90px">
                                Checking Account
                                </button>
                            </th>
                        </form>
                        <form action="/gerenciador-conta/controller/CreateSavingAccount.php" method="post">
                        <th>
                            <input type="hidden" name="email" value="'.$email.'" required>
                        </th>
                        <th>
                            <input type="hidden" name="password" value="'.$password.'" required>
                        </th>
                        <th>
                            <button name="new-account" type="submit" style="text-align:center;width:90px">
                            Saving Account
                            </button>
                        </th>
                        </form>
                    </table>';
        }
    }
?>