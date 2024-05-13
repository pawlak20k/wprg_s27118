<!DOCTYPE html>
<html>
<head>
    <title>Odwróć kolejność wierszy</title>
</head>
<body>

<h2>Wybierz plik tekstowy:</h2>
<form action="odwroc_kolejnosc.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToReverse" id="fileToReverse">
    <br><br>
    <input type="submit" value="Odwróć kolejność">
</form>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToReverse"])) {
    $file = $_FILES["fileToReverse"];

    if ($file["error"] == UPLOAD_ERR_OK) {
        $file_name = $file["tmp_name"];

        $lines = file($file_name);

        $reversed_lines = array_reverse($lines);

        $reversed_file_name = "odwrocony_" . $file["name"];
        file_put_contents($reversed_file_name, implode("", $reversed_lines));

        echo "<p>Plik został odwrócony. Możesz pobrać odwrócony plik <a href='$reversed_file_name'>tutaj</a>.</p>";
    } else {
        echo "<p>Wystąpił błąd podczas przesyłania pliku.</p>";
    }
}
?>
