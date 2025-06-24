<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php"; ?>
    <main>
        <div class="register">
            <form class="register-form" action="create_account.php" method="post">
                <h1>Registreer</h1>
                <div class="register-row">
                    <input type="text" name="firstname" placeholder="Voornaam" required>
                    <input type="text" name="lastname" placeholder="Achternaam" required>
                </div>
                <div class="register-row">
                    <input type="text" name="straat" placeholder="Straat" required>
                    <input type="text" name="huisnummer" placeholder="Huisnummer" required>
                </div>
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="E-mail" required>

                <input type="text" name="postcode" placeholder="Postcode" required>
                <input type="text" name="stad" placeholder="Stad" required>
                <input type="text" name="land" placeholder="Land" required>
                <input type="text" name="telefoonnummer" placeholder="Telefoonnummer" required>
                <input type="text" name="mobiel" placeholder="Mobiel" required>

                <select name="rol">
                    <option value="bezoeker">Bezoeker</option>
                    <option value="lid">Lid</option>
                    <option value="werknemer">Werknemer</option>
                </select>
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <button type="submit">Registreer</button>
            </form>
        </div>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>