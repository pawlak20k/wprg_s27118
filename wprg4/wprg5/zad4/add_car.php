<?php
global $conn;
include 'header.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $rok = $_POST['rok'];
    $opis = $_POST['opis'];

    $query = "INSERT INTO samochody (marka, model, cena, rok, opis) VALUES ('$marka', '$model', $cena, $rok, '$opis')";
    $conn->query($query);

    header('Location: all_cars.php');
    exit();
}
?>

<h1>Dodaj samochód</h1>
<form method="post">
    <label for="marka">Marka:</label>
    <input type="text" id="marka" name="marka" required><br>

    <label for="model">Model:</label>
    <input type="text" id="model" name="model" required><br>

    <label for="cena">Cena:</label>
    <input type="number" step="0.01" id="cena" name="cena" required><br>

    <label for="rok">Rok:</label>
    <input type="number" id="rok" name="rok" required><br>

    <label for="opis">Opis:</label>
    <textarea id="opis" name="opis" required></textarea><br>

    <button type="submit">Dodaj samochód</button>
</form>

</body>
</html>
