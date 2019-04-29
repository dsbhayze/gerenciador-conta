<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Form</title>
    </head>
    <body>
        <fieldset  style="font-family: Tahoma, Geneva, sans-serif">
            <legend><h3>User Register</h3></legend>
            <form action="../controller/SavingsAccount.php" method="post">
                <label for="firstname">First Name: </label><br>
                <input id="firstname" name="firstname" type="text" required><br>
                <label for="lastname">Last Name: </label><br>
                <input id="lastname" name="lastname" type="lastname" required><br>
                <label for="email">Email: </label><br>
                <input id="email" name="email" type="email" required><br>
                <label for="password">Password: </label><br>
                <input id="password" name="password" type="password" required><br>
                <button name="subject" type="submit" value="HTML">Submit</button>
            </form>
        </fieldset>
    </body>
    </html>