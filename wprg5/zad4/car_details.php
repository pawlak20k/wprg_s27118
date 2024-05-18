<?php
global $conn;
include 'header.php';
include 'db.php';

$id = $_GET['id'];

$query = "SELECT * FROM samochody WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>

<h1>Szczegóły samochodu</h1>
<p>ID: <?php echo $row['id']; ?></p>
<p>Marka: <?php echo $row['marka']; ?></p>
<p>Model: <?php echo $row['model']; ?></p>
<p>Cena: <?php echo $row['cena']; ?></p>
<p>Rok: <?php echo $row['rok']; ?></p>
<p>Opis: <?php echo $row['opis']; ?></p>

<a href="all_cars.php">Powrót do listy samochodów</a>

</body>
</html>
