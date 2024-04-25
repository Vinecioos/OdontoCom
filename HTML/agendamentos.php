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

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $queryEmails  = "SELECT datas, horario, tratamento FROM consultas WHERE email_cliente = '$email'";
    $resultEmails = $conexao->query($queryEmails);


    $emails = [];

    if ($resultEmails->num_rows > 0) {
        while ($row = $resultEmails->fetch_assoc()) {
            $email = [
                "data" => $row["datas"],
                "tratamento" => $row["tratamento"],
                "horario" => $row["horario"]
            ];
            $emails[] = $email;
        }
    }

    $emails_json = json_encode($emails);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Agendamento</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/calendario.css">
    <script src="../JavaScript/scriptLogado.js" defer></script>
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
                <div class="meu-perfil-central">
                    <a href="#" class="meu-perfil">Meu</a>
                    <a href="#" class="meu-perfil"> Perfil</a>
                </div>
            </div>

        </nav>

        <div class="menu-perfil" id="menu-perfil">
            <div class="btn-fechar">
                <i class="bi bi-x" id="bi bi-x-perfil"></i>
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
                    <li><a href="agendamentos.php">Agendamentos</a></li>
                    <li><a href="dadosPessoais.php">Dados Pessoais</a></li>
                    <li><a href="index.html">Sair</a></li>
                </ul>
            </nav>
        </div>

        <div class="overlay-menu" id="overlay-menu"></div>
    </header>

    <div class="planner">
        <h1 class="txt_Consulta">Marcar Consulta</h1>
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
            <input type="date" id="task-date" name="task-date">
            <select id="tratamentos" name="tratamentos">
                <option value="Clareamento">Clareamento</option>
                <option value="Ortodontia">Ortodontia</option>
                <option value="Canal">Canal</option>
            </select>
            <select id="horarios" name="horarios">
                <?php echo $options; ?>
            </select>
            <input type="text" id="task-desc" name="task-desc" placeholder="Comentário" autocomplete="off">
            <button id="addTaskButton" onclick="showPaymentModal()">Marcar</button>
        </div>
    </div>

    <div id="pagamento">
        <!-- Pagamento -->
        <div class="container">
            <span class="close" onclick="closePaymentModal()" style="align-self: end">&times;</span>
            <div class="title">
                <h4>
                    Selecione a <span style="color: #45a049">Forma</span> Pagamento<br>
                </h4>
            </div>
            <h4>R$149,94</h4>
            <form action="#">
                <input type="radio" name="payment" id="Credit" />
                <input type="radio" name="payment" id="Pix" />

                <div class="category">
                    <label for="Credit" class="CreditMethod" onclick="showCreditModal()">
                        <div class="imgName">
                            <div class="imgContainer Credit">
                                <img src="https://cdn.pixabay.com/photo/2018/06/20/18/05/bank-3487033_960_720.png" alt="" />
                            </div>
                            <span class="name">Credito</span>
                        </div>
                        <span class="check"><i class="fa-solid fa-circle-check" style="color: #45a049"></i></span>
                    </label>

                    <label for="Pix" class="PixMethod" onclick="showPixModal()">
                        <div class="imgName">
                            <div class="imgContainer Pix">
                                <img src="https://futurium.com.br/wp-content/uploads/2021/06/logo-pix-icone-512.png" alt="" />
                            </div>
                            <span class="name">Pix</span>
                        </div>
                        <span class="check"><i class="fa-solid fa-circle-check" style="color: #45a049"></i></span>
                    </label>
                </div>
            </form>
        </div>
    </div>

    <div id="pix">
        <!-- Pix -->
        <div class="container">
            <span class="close" onclick="closePixModal()" style="align-self: end">&times;</span>
            <div class="title">
                <h4><span style="color: #45a049">Pague</span> Pelo QRCode</h4>
            </div>
            <div class="QRCode">
                <img src="data:image/png;base64,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" alt="">
            </div>
            <div class="media">
                <div class="media-body">
                    <h2 class="media-heading text-regular text-medium text-muted">Chave Pix</h2>
                    <p class="text-large" style="word-break:break-word;">4831c103-4fb7-4228-a730-a51852852ff0</p>
                    <input type="hidden" id="copy-pix-key" readonly="" onclick="this.focus();this.select();" value="4831c103-4fb7-4228-a730-a51852852ff0">
                </div>
            </div>
            <div class="align_btn">
                <button class="Btn" onclick="marcar_agenda()">
                    Pagar
                    <svg class="svgIcon" viewBox="0 0 576 512">
                        <path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="Credito">
        <!-- Credito -->
        <div class="container">
            <span class="close" onclick="closeCreditoModal()" style="align-self: end">&times;</span>
            <div class="title">
                <h4>Informações do Cartão</h4>
            </div>
            <form id="creditForm">
                <div class="form-group">
                    <label for="cardNumber">Número do Cartão:</label>
                    <input type="text" id="cardNumber" name="cardNumber" placeholder="XXXX XXXX XXXX XXXX" required />
                </div>
                <div class="form-group">
                    <label for="expiryDate">Data de Validade:</label>
                    <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required />
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" placeholder="XXX" required />
                </div>
                <div class="form-group">
                    <label for="installments">Parcelas:</label>
                    <select id="installments" name="installments">
                        <option value="1">149,94 - 1x sem juros</option>
                        <option value="2">74,97 - 2x sem juros</option>
                        <option value="3">49,98 - 3x sem juros</option>
                        <!-- Adicione mais opções conforme necessário -->
                    </select>
                </div>
                <div class="align_btn">
                    <button class="Btn" onclick="marcar_agenda()">Pagar</button>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="rodape">
            <a class="rodape__escrita" href="ByTech.html">&copy; Criado por ByTech</a>
        </div>
    </footer>
    <!--Fim Rodapé-->
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

            closePaymentModal();
            closePixModal();
            closeCreditoModal();

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

            const emails = <?php echo $emails_json; ?>;
            emails.forEach(email => {
                const emailDate = new Date(email.data + "T00:00:00");
                const emailMonth = emailDate.getMonth();
                const emailYear = emailDate.getFullYear();

                if (emailMonth === month && emailYear === year) {
                    addTask(email.data, email.tratamento, email.horario);
                }
            });
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

        function showPaymentModal() {
            document.getElementById("pagamento").style.display = "block";
        }

        function showPixModal() {
            document.getElementById("pix").style.display = "block";
        }

        function showCreditModal() {
            document.getElementById("Credito").style.display = "block";
        }

        function closeAddTaskModal() {
            document.getElementById("addTaskModal").style.display = "none";
        }

        function closePaymentModal() {
            document.getElementById("pagamento").style.display = "none";
        }

        function closePixModal() {
            document.getElementById("pix").style.display = "none";
        }

        function closeCreditoModal() {
            document.getElementById("Credito").style.display = "none";
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

        function addTask(date, tramamento, horario) {
            closePaymentModal();
            closePixModal();
            closeCreditoModal();
            const taskDate = new Date(date + "T00:00:00");
            const taskDay = taskDate.getDate();
            const taskMonth = taskDate.getMonth();
            const taskYear = taskDate.getFullYear();

            const calendarDays = document.getElementById('calendar').children;

            for (let i = 0; i < calendarDays.length; i++) {
                const day = calendarDays[i];

                if (day.tagName === 'BUTTON') {
                    const calendarDay = parseInt(day.textContent);

                    if (!isNaN(calendarDay)) {
                        console.log("Checking day:", calendarDay);
                        // Verifica se o dia, mês e ano correspondem
                        if (calendarDay === taskDay && currentMonth === taskMonth && currentYear === taskYear) {
                            const taskElement = document.createElement("div");
                            taskElement.className = "Consulta";
                            taskElement.textContent = tramamento + " | " + horario;

                            taskElement.addEventListener("contextmenu", function(event) {
                                event.preventDefault();
                                deleteTask(taskElement);
                            });

                            taskElement.addEventListener('click', function() {
                                editTask(taskElement);
                            });

                            day.appendChild(taskElement);
                            closeAddTaskModal();
                            return;
                        }
                    }
                }
            }
        }

        function marcar_agenda() {
            const taskDateValue = document.getElementById('task-date').value;
            const taskTratamento = document.getElementById('tratamentos').value;
            const taskHorario = document.getElementById('horarios').value;
            const taskDesc = document.getElementById('task-desc').value;
            
            fetch('save_consulta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'task-date=' + encodeURIComponent(taskDateValue) +
                        '&tratamentos=' + encodeURIComponent(taskTratamento) +
                        '&horarios=' + encodeURIComponent(taskHorario) +
                        '&task-desc=' + encodeURIComponent(taskDesc)
                })
                .then(response => response.text());

                alert("Consulta Marcada com sucesso!");
                window.location = "agendamentos.php";

        }
    </script>
</body>

</html>