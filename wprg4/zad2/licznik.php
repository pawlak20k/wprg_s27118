<?php
$licznik_file = 'licznik.txt';

if (!file_exists($licznik_file)) {
    file_put_contents($licznik_file, '1');
}

$licznik = intval(file_get_contents($licznik_file));
$licznik++;

file_put_contents($licznik_file, $licznik);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licznik odwiedzin</title>
</head>
<body>
<h1>Witaj na stronie!</h1>
<p>Liczba odwiedzin: <?php echo $licznik; ?></p>
</body>
</html>
