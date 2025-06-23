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
            <form class="register-form" action="login_process.php" method="post">
                <h1>Login</h1>
                <input type="text" name="username" placeholder="Gebruikersnaam" required>
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
    <?php include "footer.php";?>
</body>
</html>