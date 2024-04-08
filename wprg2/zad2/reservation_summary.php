<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie rezerwacji</title>
</head>
<body>
<h2>Podsumowanie rezerwacji</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_of_people = $_POST["num_of_people"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $address = $_POST["address"];
    $credit_card = $_POST["credit_card"];
    $email = $_POST["email"];
    $arrival_date = $_POST["arrival_date"];
    $arrival_time = $_POST["arrival_time"];
    $child_bed = isset($_POST["child_bed"]) ? "Tak" : "Nie";
    $amenities = isset($_POST["amenities"]) ? implode(", ", $_POST["amenities"]) : "Brak";

    echo "<p><strong>Ilość osób:</strong> $num_of_people</p>";
    echo "<p><strong>Imię:</strong> $first_name</p>";
    echo "<p><strong>Nazwisko:</strong> $last_name</p>";
    echo "<p><strong>Adres:</strong> $address</p>";
    echo "<p><strong>Nr karty kredytowej:</strong> $credit_card</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Data przyjazdu:</strong> $arrival_date</p>";
    echo "<p><strong>Godzina przyjazdu:</strong> $arrival_time</p>";
    echo "<p><strong>Dostawka dla dziecka:</strong> $child_bed</p>";
    echo "<p><strong>Udogodnienia:</strong> $amenities</p>";
}
?>
</body>
</html>
