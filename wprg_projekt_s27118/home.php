<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-todo-btn'])) {
    $tasks = $_POST['add-todo'];
    $priority = $_POST['add-priority'];
    $due_date = $_POST['add-due-date'];
    $notes = $_POST['notes'];
    $project = isset($_POST['project']) ? $_POST['project'] : null;
    $attachment = null;

    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['attachment']['tmp_name'];
        $fileName = $_FILES['attachment']['name'];
        $fileSize = $_FILES['attachment']['size'];
        $fileType = $_FILES['attachment']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = './uploads/';
            $dest_path = $uploadFileDir . $fileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $attachment = $fileName;
            } else {
                echo "<script>alert('Nie udało się zapisać załącznika.');</script>";
            }
        } else {
            echo "<script>alert('Niedozwolony format pliku.');</script>";
        }
    }

    if (empty($project)) {
        $insert = "INSERT INTO `todolist` (`user_id`, `project_id`, `tasks`, `priority`, `due_date`, `notes`, `attachment`, `completed`, `created_at`, `updated_at`)
            VALUES ('$user_id', NULL, '$tasks', '$priority', '$due_date', '$notes', '$attachment', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    } else {
        $insert = "INSERT INTO `todolist` (`user_id`, `project_id`, `tasks`, `priority`, `due_date`, `notes`, `attachment`, `completed`, `created_at`, `updated_at`)
            VALUES ('$user_id', '$project', '$tasks', '$priority', '$due_date', '$notes', '$attachment', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    }

    $query = $mysqli->query($insert);

    if ($query) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Coś poszło nie tak! Spróbuj ponownie.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dlt-todo-btn'])) {
    $row_id = $_POST['row_id'];

    $delete = "DELETE FROM `todolist` WHERE `id` = $row_id";
    $d_query = $mysqli->query($delete);

    if ($d_query) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Something Went wrong...try again!!');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-todo-btn'])) {
    $task_id = $_POST['task_id'];
    $select = "SELECT * FROM `todolist` WHERE `id` = '$task_id'";
    $result = $mysqli->query($select);
    $project = isset($_POST['project']) ? $_POST['project'] : null;
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $task_name = $row['tasks'];
        $task_priority = $row['priority'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-todo-btn'])) {
    $task_id = $_POST['task_id'];
    $task_name = $_POST['edit-todo'];
    $task_priority = $_POST['priority'];
    $due_date=isset($_POST['due-date']) ? $_POST['due-date'] : null;
    $task_note=$_POST['note'];
    $project = isset($_POST['project']) ? $_POST['project'] : null;
    if(empty($project)&&!empty($due_date)){
        $update = "UPDATE `todolist` SET `tasks` = '$task_name', `priority` = '$task_priority',`due_date` = '$due_date',`notes` = '$task_note',`project_id` = NULL,
                      `updated_at` = CURRENT_TIMESTAMP WHERE `id` = '$task_id'";
    }elseif (empty($due_date)&&!empty($project)){
        $update = "UPDATE `todolist` SET `tasks` = '$task_name', `priority` = '$task_priority',`due_date` = NULL,`notes` = '$task_note',`project_id` = '$project',
                      `updated_at` = CURRENT_TIMESTAMP WHERE `id` = '$task_id'";
    } elseif (empty($project)&&empty($due_date)){
        $update = "UPDATE `todolist` SET `tasks` = '$task_name', `priority` = '$task_priority',`due_date` = NULL,`notes` = '$task_note',`project_id` = NULL,
                      `updated_at` = CURRENT_TIMESTAMP WHERE `id` = '$task_id'";
    }
    else {
        $update = "UPDATE `todolist` SET `tasks` = '$task_name', `priority` = '$task_priority',`due_date` = '$due_date',`notes` = '$task_note',`project_id` = '$project',
                      `updated_at` = CURRENT_TIMESTAMP WHERE `id` = '$task_id'";
    }
    var_dump($update);
    $u_query = $mysqli->query($update);
    var_dump($u_query);
    if ($u_query) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Coś poszło nie tak! Spróbuj ponownie.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark-complete-btn'])) {
    $task_id = $_POST['task_id'];
    $update = "UPDATE `todolist` SET `completed` = 1 WHERE `id` = '$task_id'";
    $u_query = $mysqli->query($update);

    if ($u_query) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Coś poszło nie tak! Spróbuj ponownie.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restore-btn'])) {
    $task_id = $_POST['task_id'];
    $update = "UPDATE `todolist` SET `completed` = 0 WHERE `id` = '$task_id'";
    $u_query = $mysqli->query($update);

    if ($u_query) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Coś poszło nie tak! Spróbuj ponownie.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear-btn'])) {
    $clear = "DELETE FROM `todolist` WHERE `user_id` = '$user_id' AND `completed` = 1";
    $c_query = $mysqli->query($clear);

    if ($c_query) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Coś poszło nie tak! Spróbuj ponownie.');</script>";
    }
}
$select = "SELECT * FROM `todolist` WHERE `user_id` = '$user_id' AND `completed` = 0";
$result = $mysqli->query($select);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TICKET SERVICE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>
<body>
<h1>Dashboard</h1>
<div>
    <h3>Lista ticketów:</h3>
    <table>
        <thead>
        <tr>
            <th>Tytuł</th>
            <th>Data dodania</th>
            <th>Termin wykonania</th>
            <th>Priorytet</th>
            <th>Opis</th>
            <th>Załącznik</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $task_id = $row['id'];
                $task_name = $row['tasks'];
                $task_created_at = $row['created_at'];
                $task_priority = $row['priority'];
                $task_completed = $row['completed'];
                $due_date=$row['due_date'];
                $notes=$row['notes'];
                $attachment=$row['attachment'];

                echo "<tr>";
                echo "<td>$task_name</td>";
                echo "<td>$task_created_at</td>";
                echo "<td>$due_date</td>";
                echo "<td>$task_priority</td>";
                echo "<td>$notes</td>";
                if ($attachment) {
                    echo "<td><a href='./uploads/$attachment' target='_blank'>$attachment</a></td>";
                } else {
                    echo "<td>Brak</td>";
                }

                echo "<td>";
                echo "<form method='post' action=''>
                      <input type='hidden' name='task_id' value='$task_id'>
                      <button type='submit' name='edit-todo-btn'>Edytuj</button>
                     </form>";
                if ($task_completed) {
                    echo "<form method='post' action=''>
                        <input type='hidden' name='task_id' value='$task_id'>
                        <button type='submit' name='mark-incomplete-btn'>Niewykonane</button>
                    </form>";
                } else {
                    echo "<form method='post' action=''>
                        <input type='hidden' name='task_id' value='$task_id'>
                        <button type='submit' name='mark-complete-btn'>Wykonane</button>
                    </form>";
                }
                echo "<form method='post' action=''>
                        <input type='hidden' name='row_id' value='$task_id'>
                        <button type='submit' name='dlt-todo-btn'>Usuń</button>
                    </form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Brak zadań do wyświetlenia.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<br><br>
<div>
    <h3>Zakończone tickety:</h3>
    <table>
        <thead>
        <tr>
            <th>Tytuł</th>
            <th>Data dodania</th>
            <th>Termin wykonania</th>
            <th>Priorytet</th>
            <th>Opis</th>
            <th>Załącznik</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $completedTasks = "SELECT * FROM `todolist` WHERE `user_id` = '$user_id' AND `completed` = 1";
        $completedResult = $mysqli->query($completedTasks);

        if ($completedResult && $completedResult->num_rows > 0) {
            while ($row = $completedResult->fetch_assoc()) {
                $task_id = $row['id'];
                $task_name = $row['tasks'];
                $task_created_at = $row['created_at'];
                $task_priority = $row['priority'];
                $task_completed = $row['completed'];
                $due_date = $row['due_date'];
                $notes = $row['notes'];
                $attachment=$row['attachment'];

                echo "<tr>";
                echo "<td>$task_name</td>";
                echo "<td>$task_created_at</td>";
                echo "<td>$due_date</td>";
                echo "<td>$task_priority</td>";
                echo "<td>$notes</td>";
                if ($attachment) {
                    echo "<td><a href='./uploads/$attachment' target='_blank'>$attachment</a></td>";
                } else {
                    echo "<td>Brak</td>";
                }
                echo "<td>";
                echo "<form method='post' action=''>
                            <input type='hidden' name='task_id' value='$task_id'>
                            <button type='submit' name='restore-btn'>Niewykonane</button>
                        </form>";
                echo "<form method='post' action=''>
                            <input type='hidden' name='row_id' value='$task_id'>
                            <button type='submit' name='dlt-todo-btn'>Usuń</button>
                        </form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Brak zadań wykonanych do wyświetlenia.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<div>
    <h2>Dodaj ticket:</h2>
    <h3>Tytuł:</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="text" name="add-todo" required>
        <label for="add-priority">Priorytet:</label>
        <select name="add-priority" id="add-priority">
            <option value="niski">Niski</option>
            <option value="sredni">Średni</option>
            <option value="wysoki">Wysoki</option>
        </select>
        <label for="add-due-date">Termin wykonania:</label>
        <input type="date" name="add-due-date" required>
        <label for="notes">Opis:</label>
        <textarea name="notes" id="notes"></textarea>
        <label for="project">Dział:</label>
        <select name="project" id="project">
            <option value="">-- Wybierz dział --</option>
            <?php
            $selectProjects = "SELECT * FROM `projects`";
            $projectsResult = $mysqli->query($selectProjects);
            if ($projectsResult && $projectsResult->num_rows > 0) {
                while ($projectRow = $projectsResult->fetch_assoc()) {
                    $projectId = $projectRow['id'];
                    $projectName = $projectRow['name'];
                    echo "<option value='$projectId'>$projectName</option>";
                }
            }
            ?>
        </select>
        <label for="attachment">Załącznik:</label>
        <input type="file" name="attachment" id="attachment">
        <button type="submit" name="add-todo-btn">Dodaj ticket</button>
    </form>
</div>
<br><br>
<div>
    <h2>Edytuj ticket:</h2>
    <?php
    if (isset($task_name)) {
        $task_note = '';
        $task_due_date = '';
        if (isset($_POST['note'])) {
            $task_note = $_POST['note'];
        }

        if (isset($_POST['due-date'])) {
            $task_due_date = $_POST['due-date'];
        }
        ?>
        <form method="post" action="">
            <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
            <label for="edit-todo">Nazwa zadania:</label>
            <input type="text" name="edit-todo" id="edit-todo" value="<?php echo $task_name; ?>" required>
            <label for="priority">Priorytet:</label>
            <select name="priority" id="priority">
                <option value="niski" <?php if ($task_priority === 'niski') echo 'selected'; ?>>Niski</option>
                <option value="sredni" <?php if ($task_priority === 'sredni') echo 'selected'; ?>>Średni</option>
                <option value="wysoki" <?php if ($task_priority === 'wysoki') echo 'selected'; ?>>Wysoki</option>
            </select>
            <label for="due-date">Termin wykonania:</label>
            <input type="date" name="due-date" id="due-date" value="<?php echo $due_date; ?>">
            <label for="note">Opis:</label>
            <textarea name="note" id="note"><?php echo $task_note; ?></textarea>
            <label for="project">Dział:</label>
            <select name="project" id="project">
                <option value="">-- Wybierz dział --</option>
                <?php
                $selectProjects = "SELECT * FROM `projects`";
                $projectsResult = $mysqli->query($selectProjects);
                if ($projectsResult && $projectsResult->num_rows > 0) {
                    while ($projectRow = $projectsResult->fetch_assoc()) {
                        $projectId = $projectRow['id'];
                        $projectName = $projectRow['name'];
                        echo "<option value='$projectId'>$projectName</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" name="update-todo-btn">Zaktualizuj</button>
        </form>
        <?php
    }
    ?>
</div>
<br><br>
<div>
    <h3>Opcje dodatkowe</h3>
    <p>Importowanie lub eksportowanie danych</p>
    <form method="post" action="import.php" enctype="multipart/form-data">
        <input type="file" name="import-file">
        <button type="submit" name="import-btn">Importuj z CSV</button>
    </form>
    <form method="post" action="export.php">
        <button type="submit" name="export-btn">Eksportuj do CSV</button>
    </form>
    <br>
    <table>
        <h3>Panel nawigacyjny</h3>
        <p><a href="index.php">Przejdź do strony głównej</a></p>
        <p><a href="projects.php">Przejdź do działów</a></p>
        <p><a href="calendar.php">Przejdź do kalendarza</a></p>
        <p><a href="logout.php">Wyloguj</a></p>
    </table>
</div>
</body>
</html>
