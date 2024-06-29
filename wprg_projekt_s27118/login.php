<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

        if (password_verify($_POST["password"], $user["password_hash"])) {

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];

            header("Location: index.php");
            exit;
        }
    }

    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>TICKET SERVICE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>
<body>

<h1>Panel logowania</h1>

<?php if ($is_invalid): ?>
    <em><b>Niepoprawny login lub hasło</b></em>
<?php endif; ?>

<form method="post"><br>
    <label for="email">Adres e-mail</label>
    <input type="email" name="email" id="email"
           value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

    <label for="password">Hasło</label>
    <input type="password" name="password" id="password"><br>

    <button>Zaloguj</button>

    <p>Nie masz konta? <a href="signup.html">Rejestracja</a></p>
</form>

</body>
</html>
