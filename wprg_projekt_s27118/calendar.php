<?php
session_start();
$user_id = $_SESSION['user_id'];

$mysqli = require __DIR__ . "/database.php";
?>
<!DOCTYPE html>
<head lang="en">
<h1>Kalendarz</h1>
<title>TICKET SERVICE</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: '',
                center: 'title, prev,next today',
                right: 'month,agendaWeek,agendaDay'
            },
            events: {
                url: 'events.php',
                type: 'POST',
                data: {
                    user_id: <?php echo $user_id; ?>
                },
                error: function () {
                    alert('Wystąpił błąd podczas pobierania wydarzeń!');
                }
            }
        });
    });
</script>
</head>
<body>
<div id="calendar"></div>
<div>
    <table>
        <p><a href="home.php">Przejdź do zadań</a></p>
        <p><a href="projects.php">Przejdź do działów</a></p>
        <p><a href="index.php">Przejdź do strony startowej</a></p>
        <p><a href="logout.php">Wyloguj</a></p>
    </table>
</div>
</body>
</html>
