<?php
global $conn;
include 'header.php';
include 'db.php';

$query = "SELECT * FROM samochody ORDER BY rok DESC";
$result = $conn->query($query);
?>

<h1>Wszystkie samochody</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Marka</th>
        <th>Model</th>
        <th>Cena</th>
        <th>Akcje</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['marka']; ?></td>
            <td><?php echo $row['model']; ?></td>
            <td><?php echo $row['cena']; ?></td>
            <td><a href="car_details.php?id=<?php echo $row['id']; ?>">Szczegóły</a></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
