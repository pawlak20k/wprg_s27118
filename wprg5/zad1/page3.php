<?php
session_start();
if (!isset($_SESSION['card_number'])) {
    header('Location: page1.php');
    exit();
}

$num_people = $_SESSION['num_people'];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Podstrona 3</title>
</head>
<body>
<h1>Podsumowanie</h1>
<p>Numer karty: <?php echo htmlspecialchars($_SESSION['card_number']); ?></p>
<p>Dane zamawiającego: <?php echo htmlspecialchars($_SESSION['customer_name']); ?></p>
<p>Ilość osób: <?php echo htmlspecialchars($num_people); ?></p>

<?php for ($i = 1; $i <= $num_people; $i++): ?>
    <h2>Osoba <?php echo $i; ?></h2>
    <p>Imię: <?php echo htmlspecialchars($_SESSION["person_{$i}_name"]); ?></p>
    <p>Wiek: <?php echo htmlspecialchars($_SESSION["person_{$i}_age"]); ?></p>
<?php endfor; ?>

<a href="page1.php">Powrót do pierwszej strony</a>
</body>
</html>
