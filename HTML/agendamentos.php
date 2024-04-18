<?php
session_start();
$dbHost = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

$sql = "SELECT horaDisponivel FROM horario";
$result = $conexao->query($sql);

$options = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $horaDisponivel = $row['horaDisponivel'];
        $options .= "<option value='{$horaDisponivel}'>{$horaDisponivel}</option>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/calendario.css">
    <script src="../JavaScript/script.js" defer></script>
</head>

<body>
    <header class="cabecalho">
        <div class="cabecalho__logo">
            <a href="indexLogado.php">
                <img class="logo" src="../assets/OdontoCom_White.png" alt="Logo">
            </a>
        </div>

        <nav class="cabecalho-logado">
            <a href="indexLogado.php" class="inicio">Início</a>
            <div id="btn-menu-perfil" class="btn-menu-perfil">
                <i class="bi bi-person-circle"></i>
                <a href="#" class="meu-perfil">Meu Perfil</a>
            </div>

        </nav>

        <div class="menu-perfil" id="menu-perfil">
            <div class="btn-fechar">
                <i class="bi bi-x" id="bi bi-x"></i>
            </div>

            <nav>
                <ul>
                    <li>
                        <p><?php
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];

                                $sql = "SELECT nome FROM user WHERE email = '$email'";
                                $result = $conexao->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $nomeDoUsuario = $row['nome'];

                                    echo "Olá, $nomeDoUsuario!";
                                }
                            }
                            ?></p>
                    </li>
                    <li><a href="agendamentos.html">Agendamentos</a></li>
                    <li><a href="dadosPessoais.php">Dados Pessoais</a></li>
                    <li><a href="index.html">Sair</a></li>
                </ul>
            </nav>
        </div>

        <div class="overlay-menu" id="overlay-menu"></div>
    </header>

    <div class="planner">
        <h1>Marcar Consulta</h1>
        <div class="calendar-header">
            <button id="prevMonth">&lt;</button>
            <h2 id="currentMonth">Abril</h2>
            <button id="nextMonth">&gt;</button>
        </div>
        <div id="calendar" class="calendar-grid"></div>
    </div>



    <div id="addTaskModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddTaskModal()">&times;</span>
            <h2>Agendar Consulta</h2>
            <input type="date" id="task-date">
            <select id="tratamentos">
                <option value="Clareamento">Clareamento</option>
                <option value="Ortodontia">Ortodontia</option>
                <option value="Canal">Canal</option>
            </select>
            <select id="horarios">
                <?php echo $options; ?>
            </select>
            <input type="text" id="task-desc" placeholder="Comentário" autocomplete="off">
            <button id="addTaskButton" onclick="addTask()">Marcar</button>
        </div>
    </div>
    <script>
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        window.onload = function() {
            generateCalendar(currentMonth, currentYear);
            updateMonthYear();

            document.getElementById('prevMonth').addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentMonth, currentYear);
                updateMonthYear();
            });

            document.getElementById('nextMonth').addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentMonth, currentYear);
                updateMonthYear();
            });
        };

        function updateMonthYear() {
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            document.getElementById('currentMonth').textContent = `${months[currentMonth]} de ${currentYear}`;
        }

        function generateCalendar(month, year) {
            const calendar = document.getElementById('calendar');
            calendar.innerHTML = ''; // Limpa o conteúdo atual

            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);

            const firstDayOfWeek = firstDayOfMonth.getDay();
            const totalDays = lastDayOfMonth.getDate();

            for (let i = 0; i < firstDayOfWeek; i++) {
                let blankDay = document.createElement("div");
                calendar.appendChild(blankDay);
            }

            for (let day = 1; day <= totalDays; day++) {
                let daySquare = document.createElement("button");
                daySquare.addEventListener('click', showAddTaskModal);
                daySquare.className = "calendar-day";
                daySquare.textContent = day;
                daySquare.id = `day-${day}`;
                calendar.appendChild(daySquare);
            }
        }

        function showAddTaskModal() {
            const selectedDay = this.textContent;
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth() + 1;
            const formattedDate = `${currentYear}-${currentMonth.toString().padStart(2, '0')}-${selectedDay.toString().padStart(2, '0')}`;

            document.getElementById('task-date').value = formattedDate;
            document.getElementById('addTaskModal').style.display = 'block';
        }

        function closeAddTaskModal() {
            document.getElementById('addTaskModal').style.display = 'none';
        }

        function deleteTask(taskElement) {
            if (confirm("Are you sure you want to delete this task?")) {
                taskElement.parentNode.removeChild(taskElement);
            }
        }

        function editTask(taskElement) {
            const newTaskDesc = prompt("Edit your task:", taskElement.textContent);
            if (newTaskDesc !== null & newTaskDesc.trim() !== "") {
                taskElement.textContent = newTaskDesc;
            }
        }

        function addTask() {
            const taskDate = new Date(document.getElementById('task-date').value);
            const taskTratamento = document.getElementById('tratamento').value;
            const taskHorario = document.getElementById('horario').value;
            const taskDesc = document.getElementById('task-desc').value.trim();

            if (taskDesc && !isNaN(taskDate.getDate())) {
                const calendarDays = document.getElementById('calendar').children;
                const taskDay = taskDate.getDate();

                for (let i = 0; i < calendarDays.length; i++) {
                    const day = calendarDays[i];

                    if (day.tagName === 'BUTTON') {
                        const calendarDay = parseInt(day.textContent);

                        if (!isNaN(calendarDay)) {
                            console.log("Checking day:", calendarDay);
                            console.log(taskDay);

                            if (calendarDay - 1 === taskDay || taskDay === 31) {

                                console.log("Found matching day:", calendarDay - 1);

                                const taskElement = document.createElement("div");
                                taskElement.className = "Consulta";
                                taskElement.textContent = taskTratamento + " | " + taskHorario;

                                taskElement.addEventListener("contextmenu", function(event) {
                                    event.preventDefault();
                                    deleteTask(taskElement);
                                });

                                taskElement.addEventListener('click', function() {
                                    editTask(taskElement);
                                });

                                day.appendChild(taskElement);
                                break;
                            }
                        }
                    }
                }
                closeAddTaskModal();
            } else {
                alert("Please enter a valid date and task description!");
            }
        }
    </script>
</body>

</html>