<?php
session_start();
if (!isset($_SESSION['num_people'])) {
    header('Location: page1.php');
    exit();
}

$num_people = $_SESSION['num_people'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($i = 1; $i <= $num_people; $i++) {
        $_SESSION["person_{$i}_name"] = $_POST["person_{$i}_name"];
        $_SESSION["person_{$i}_age"] = $_POST["person_{$i}_age"];
    }
    header('Location: page3.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Podstrona 2</title>
</head>
<body>
<h1>Podaj dane osób</h1>
<form method="post" action="">
    <?php for ($i = 1; $i <= $num_people; $i++): ?>
        <h2>Osoba <?php echo $i; ?></h2>
        <label for="person_<?php echo $i; ?>_name">Imię:</label>
        <input type="text" id="person_<?php echo $i; ?>_name" name="person_<?php echo $i; ?>_name" required><br>

        <label for="person_<?php echo $i; ?>_age">Wiek:</label>
        <input type="number" id="person_<?php echo $i; ?>_age" name="person_<?php echo $i; ?>_age" required><br>
    <?php endfor; ?>

    <button type="submit">Zapisz i przejdź dalej</button>
</form>
</body>
</html>
