<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php";?>
    <main>
        <div class="login">
            <form class="login-form" action="login_process.php" method="post">
                <div><h1>Login</h1></div>
                <label for="username" >Wat is uw username?</label>
                <input type="text" id="username" name="username" required>

                <label for="password" >Wat is uw wachtwoord?</label>
                <input type="text" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </main>
    <?php include "footer.php";?>
</body>
</html>