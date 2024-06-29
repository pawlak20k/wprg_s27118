<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$mysqli = require __DIR__ . "/database.php";

if (isset($_POST['project_name']) && isset($_POST['project_description'])) {
    $projectName = $_POST['project_name'];
    $projectDescription = $_POST['project_description'];

    $insertProject = "INSERT INTO `projects` (`name`, `description`) VALUES ('$projectName', '$projectDescription')";
    if ($mysqli->query($insertProject)) {
        echo "Nowy projekt został dodany.";
    } else {
        echo "Błąd podczas dodawania działu: " . $mysqli->error;
    }
}

if (isset($_GET['delete_project'])) {
    $projectId = $_GET['delete_project'];

    $deleteProject = "DELETE FROM `projects` WHERE `id` = $projectId";
    if ($mysqli->query($deleteProject)) {
        echo "Projekt został usunięty.";
    } else {
        echo "Błąd podczas usuwania działu: " . $mysqli->error;
    }
}

if (isset($_GET['delete_task'])) {
    $taskId = $_GET['delete_task'];

    $deleteTask = "DELETE FROM `todolist` WHERE `id` = $taskId";
    if ($mysqli->query($deleteTask)) {
        echo "Ticket zostało usunięte z działu.";
    } else {
        echo "Błąd podczas usuwania zadania: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <h1>Utwórz nowy dział:</h1>
    <meta charset="UTF-8">
    <title>TICKET SERVICE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>
<body>
<form method="POST" action="">
    <label for="project_name">Nazwa działu:</label>
    <input type="text" name="project_name" required>

    <label for="project_description">Opis działu:</label>
    <textarea name="project_description" required></textarea>

    <input type="submit" value="Utwórz dział">
</form>
<?php
$selectProjects = "SELECT * FROM `projects`";
$projectsResult = $mysqli->query($selectProjects);
if ($projectsResult && $projectsResult->num_rows > 0) {
    while ($projectRow = $projectsResult->fetch_assoc()) {
        $projectId = $projectRow['id'];
        $projectName = $projectRow['name'];
        $projectDescription = $projectRow['description'];

        echo "<h3>Nazwa: $projectName</h3>";
        echo "<h4>Opis: $projectDescription</h4>";

        echo "<a href=\"projects.php?delete_project=$projectId\">Usuń dział </a><br>";

        $selectTasks = "SELECT * FROM `todolist` WHERE `project_id` = $projectId";
        $tasksResult = $mysqli->query($selectTasks);
        if ($tasksResult && $tasksResult->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                <th>Tytuł</th>
                <th>Data dodania</th>
                <th>Termin wykonania</th>
                <th>Priorytet</th>
                <th>Opis</th>
                <th>Akcje</th>
            </tr>";
            while ($taskRow = $tasksResult->fetch_assoc()) {
                $taskId = $taskRow['id'];
                $taskName = $taskRow['tasks'];
                $taskCreatedAt = $taskRow['created_at'];
                $taskPriority = $taskRow['priority'];
                $taskNotes = $taskRow['notes'];
                $taskDue_Date=$taskRow['due_date'];

                echo "<tr>";
                echo "<td>$taskName</td>";
                echo "<td>$taskCreatedAt</td>";
                echo "<td>$taskDue_Date</td>";
                echo "<td>$taskPriority</td>";
                echo "<td>$taskNotes</td>";
                echo "<td><a href=\"projects.php?delete_task=$taskId&project_id=$projectId\">Usuń ticket</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Brak ticketów przypisanych do tego działu.";
        }
    }
} else {
    echo "Brak dostępnych projektów.";
}
?>
<br><br>
<table>
    <h3>Panel nawigacyjny</h3>
    <p><a href="home.php">Przejdź do zadań</a></p>
    <p><a href="index.php">Przejdź do strony głównej</a></p>
    <p><a href="calendar.php">Przejdź do kalendarza</a></p>
    <p><a href="logout.php">Wyloguj</a></p>
</table>
</body>
</html>

