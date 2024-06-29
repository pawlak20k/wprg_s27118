<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $user_id = $mysqli->real_escape_string($_SESSION["user_id"]);
    $sql = "SELECT * FROM user WHERE id = '$user_id'";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['name'] = $user['name'];
    } else {
        $user = null;
    }
} else {
    $user = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TICKET SERVICE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    <h1>Ticket Service</h1>
</head>
<body>

<?php if (isset($user)): ?>

    <h2>Witaj <?= htmlspecialchars($user["name"]) ?>!</h2>
        <table>
            <h3>Panel nawigacyjny</h3>
            <p><a href="home.php">Przejdź do zadań</a></p>
            <p><a href="projects.php">Przejdź do działów</a></p>
            <p><a href="calendar.php">Przejdź do kalendarza</a></p>
            <p><a href="logout.php">Wyloguj</a></p>
        </table>

<?php else: ?>
    <h3>Witaj na portalu!</h3>
    <p>Wybór należy do Ciebie - logowanie czy rejestracja?</p>
    <p><a href="login.php">Logowanie</a></p>
    <p><a href="signup.html">Rejestracja</a></p>
<?php endif; ?>

</body>
</html>