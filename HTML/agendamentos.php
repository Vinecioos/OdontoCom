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
                <p class="text-large" hidden>00020126490014BR.GOV.BCB.PIX0127guilhermelibanio1@gmail.com5204000053039865406149.945802BR5925Guilherme Libanio De Oliv6009SAO PAULO62140510PKJzVMpdUn6304F5BD</p>
            </div>
            <div class="QRCode">
                <img src="../assets/QRcode.png" alt="">
            </div>
            <div class="align_btn">
                <button class="Btn" onclick="copyCode()">Copiar Código</button>
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
        let selectedMonth = currentMonth;
        let selectedYear = currentYear;

        window.onload = function() {
            generateCalendar(currentMonth, currentYear);
            updateMonthYear();

            document.getElementById('prevMonth').addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                selectedMonth = currentMonth;
                selectedYear = currentYear;
                generateCalendar(currentMonth, currentYear);
                updateMonthYear();
            });

            document.getElementById('nextMonth').addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                selectedMonth = currentMonth;
                selectedYear = currentYear;
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
            selectedMonth++;
            const formattedDate = `${selectedYear}-${selectedMonth.toString().padStart(2, '0')}-${selectedDay.toString().padStart(2, '0')}`;

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
                .then(response => response.text())
                .then(data => {
                        if (data.startsWith("Erro")) {
                            alert(data); 
                        }
                    });

                        window.location = "agendamentos.php";
                    }

                    /* Copiar codigo */

                    function copyCode() {
                        const codeElement = document.querySelector('.text-large');
                        const codeText = codeElement.innerText || codeElement.textContent;

                        const textarea = document.createElement('textarea');
                        textarea.value = codeText;
                        document.body.appendChild(textarea);

                        textarea.select();
                        document.execCommand('copy');

                        document.body.removeChild(textarea);
                        alert('Código copiado para a área de transferência!');
                    }
    </script>
</body>

</html>