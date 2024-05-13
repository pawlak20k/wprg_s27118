<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista odnośników</title>
</head>
<body>
<h1>Lista odnośników</h1>
<ul>
    <?php
    $plik_danych = 'adresy.txt';

    if (file_exists($plik_danych)) {
        $handle = fopen($plik_danych, "r");

        while (($line = fgets($handle)) !== false) {
            $parts = explode(';', $line);
            if (count($parts) == 2) {
                $url = trim($parts[0]);
                $opis = trim($parts[1]);
                echo "<li><a href='$url'>$opis</a></li>";
            }
        }

        fclose($handle);
    } else {
        echo "Plik z danymi nie istnieje.";
    }
    ?>
</ul>
</body>
</html>
