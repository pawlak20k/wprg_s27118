<?php
global $conn;
include 'header.php';
include 'db.php';

$query = "SELECT * FROM samochody ORDER BY cena ASC LIMIT 5";
$result = $conn->query($query);
?>

<h1>Najtańsze samochody</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Marka</th>
        <th>Model</th>
        <th>Cena</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['marka']; ?></td>
            <td><?php echo $row['model']; ?></td>
            <td><?php echo $row['cena']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
