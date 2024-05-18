<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['card_number'] = $_POST['card_number'];
    $_SESSION['customer_name'] = $_POST['customer_name'];
    $_SESSION['num_people'] = $_POST['num_people'];
    header('Location: page2.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Podstrona 1</title>
</head>
<body>
<h1>Podaj dane ogólne</h1>
<form method="post" action="">
    <label for="card_number">Numer karty:</label>
    <input type="text" id="card_number" name="card_number" required><br>

    <label for="customer_name">Dane zamawiającego:</label>
    <input type="text" id="customer_name" name="customer_name" required><br>

    <label for="num_people">Ilość osób:</label>
    <input type="number" id="num_people" name="num_people" required><br>

    <button type="submit">Dalej</button>
</form>
</body>
</html>
