
<?php include 'app/views/head.php'; ?>
	<div class="campo-select-header" style="display: flex; align-items: center; justify-content: space-between; background: linear-gradient(90deg, #004d40, #1b5e20); padding: 15px; border-radius: 8px; color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
		<h2 style="font-size: 26px; font-weight: bold; color: #e0f7fa; margin: 0;">
			<i class="fas fa-calendar-alt" style="color: #b2ff59; margin-right: 10px;"></i>
			Gestão de Horários dos Campos
		</h2>
	</div>

	<div class="form-group">
		<label for="campoSelect" class="highlight-label" style="font-weight: bold; font-size: 1.1em; color: #ffffff; background-color: #1b5e20; padding: 10px 15px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
			<span class="highlight-text" style="animation: pulse 1.5s infinite ease-in-out; color: #e0f7fa;">
				<i class="fas fa-hand-point-right" style="color: #b2ff59; margin-right: 5px;"></i> Selecione um Campo
			</span>
		</label>
		<select id="campoSelect" class="form-control" style="border-radius: 8px; border: 2px solid #315a02; color: #004d40; background-color: #f7fff8; width: 20%;">
			<option value="">-- Selecione um campo --</option>
			<?php foreach ($data['campos'] as $campo): ?>
				<option value="<?= htmlspecialchars($campo['id']); ?>" data-valor-hora="<?= htmlspecialchars($campo['valor_por_hora']); ?>">
					<?= htmlspecialchars($campo['nome']); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>


	<div id="calendar" class="mt-4" style="max-height: 35vw; max-width: 75vw; margin: 0 auto; border-radius: 8px; box-shadow: rgb(0 52 0) 0px 0px 6px;"></div>

    <!-- Modal para criar agendamento -->
    <!-- <div class="modal fade" id="agendamentoModal" tabindex="-1" aria-labelledby="agendamentoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="agendamentoForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agendamentoModalLabel">Criar Agendamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="campoId" name="campo_id">
                        <div class="form-group">
                            <label for="title">Título do Agendamento</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="dataInicio">Data de Início</label>
                            <input type="datetime-local" class="form-control" id="dataInicio" name="data_inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="dataFim">Data de Fim</label>
                            <input type="datetime-local" class="form-control" id="dataFim" name="data_fim" required>
                        </div>
                        <div class="form-group">
                            <label for="statusPagamento">Status do Pagamento</label>
                            <select class="form-control" id="statusPagamento" name="status_pagamento">
                                <option value="pendente">Pendente</option>
                                <option value="confirmado">Confirmado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->



<!-- Inclui o formulário do modal para criação/edição de agendamentos -->
<div class="modal fade" id="agendamentoModal" tabindex="-1" aria-labelledby="agendamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="agendamentoForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="agendamentoModalLabel">Criar Agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="campoId" name="campo_id">
                    <input type="hidden" id="agendamentoId" name="id"> <!-- Campo oculto para o ID do agendamento -->
                    <div class="form-group">
                        <label for="title">Título do Agendamento</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="dataInicio">Data de Início</label>
                        <input type="datetime-local" class="form-control" id="dataInicio" name="data_inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="dataFim">Data de Fim</label>
                        <input type="datetime-local" class="form-control" id="dataFim" name="data_fim" required>
                    </div>
                    <div class="form-group">
                        <label for="statusPagamento">Status do Pagamento</label>
                        <select class="form-control" id="statusPagamento" name="status_pagamento">
                            <option value="pendente">Pendente</option>
                            <option value="confirmado">Confirmado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="valorTotal">Valor do Agendamento (R$)</label>
                        <input type="text" class="form-control" id="valorTotal" name="valor_total" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="deleteAgendamento" class="btn btn-danger d-none">Excluir Agendamento</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- FullCalendar e JS para agendamentos -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function formatDateToLocalString(date) {
    const offsetDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);
    return offsetDate.toISOString().slice(0, 16);
}

function calculateAgendamentoValue() {
    // Verifique o valor por hora do campo selecionado
    const valorHora = parseFloat($('#campoSelect').find(':selected').data('valorHora') || 0); 
    console.log("Valor por Hora do Campo:", valorHora);

    // Obtenha e verifique a data de início
    const dataInicio = new Date($('#dataInicio').val());
    console.log("Data de Início:", $('#dataInicio').val(), "Objeto Date de Início:", dataInicio);

    // Obtenha e verifique a data de fim
    const dataFim = new Date($('#dataFim').val());
    console.log("Data de Fim:", $('#dataFim').val(), "Objeto Date de Fim:", dataFim);

    // Verifique se todas as variáveis estão corretamente definidas antes do cálculo
    if (!isNaN(dataInicio.getTime()) && !isNaN(dataFim.getTime()) && valorHora > 0) {
        // Calcule a duração em horas
        const durationHours = (dataFim - dataInicio) / (1000 * 60 * 60);
        console.log("Duração em Horas:", durationHours);

        // Calcule o valor total com base no valor por hora
        const valorTotal = durationHours * valorHora;
        console.log("Valor Total Calculado:", valorTotal);

        $('#valorTotal').val(valorTotal.toFixed(2));
    } else {
        console.warn("Erro no cálculo - verifique se as datas e valor por hora estão corretos");
        $('#valorTotal').val("0.00");
    }
}


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var campoSelect = document.getElementById('campoSelect');
    var campoIdInput = document.getElementById('campoId');
    var agendamentoIdInput = document.getElementById('agendamentoId');
    var deleteButton = document.getElementById('deleteAgendamento');
    var modalTitle = document.getElementById('agendamentoModalLabel');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        selectable: true,
        editable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            var campoId = campoSelect.value;
            if (campoId) {
                $.ajax({
                    url: 'index.php?controller=agendamento&action=getAgendamentosByCampoId&campo_id=' + campoId,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (Array.isArray(data)) {
                            successCallback(data);
                        } else {
                            console.error("Formato de dados incorreto:", data);
                            failureCallback();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro AJAX:", error);
                        failureCallback();
                    }
                });
            } else {
                successCallback([]);
            }
        },
        dateClick: function(info) {
            if (campoSelect.value) {
                campoIdInput.value = campoSelect.value;
                agendamentoIdInput.value = ''; // Limpa o ID do agendamento para criação
                modalTitle.textContent = 'Criar Agendamento';
                document.getElementById('title').value = '';
                document.getElementById('dataInicio').value = info.dateStr + "T00:00";
                document.getElementById('dataFim').value = info.dateStr + "T01:00";
                document.getElementById('statusPagamento').value = 'pendente';
                $('#valorTotal').val("0.00"); // Resetando valor total
                deleteButton.classList.add('d-none');
                $('#agendamentoModal').modal('show');
            } else {
                alert('Selecione um campo antes de adicionar um agendamento.');
            }
        },
        eventClick: function(info) {
            campoIdInput.value = campoSelect.value;
            agendamentoIdInput.value = info.event.id;
            modalTitle.textContent = 'Editar Agendamento';
            document.getElementById('title').value = info.event.title;
            document.getElementById('dataInicio').value = formatDateToLocalString(info.event.start);
            document.getElementById('dataFim').value = formatDateToLocalString(info.event.end);
            document.getElementById('statusPagamento').value = info.event.extendedProps.status_pagamento;
            calculateAgendamentoValue(); // Calcula o valor ao carregar para edição
            deleteButton.classList.remove('d-none');
            $('#agendamentoModal').modal('show');
        }
    });

    calendar.render();

    campoSelect.addEventListener('change', function() {
        calendar.refetchEvents();
    });

    // Calcula o valor sempre que houver mudanças nos campos de data/hora
    $('#dataInicio, #dataFim, #campoSelect').on('change', calculateAgendamentoValue);

    $('#agendamentoForm').on('submit', function(e) {
        e.preventDefault();

        var actionUrl = agendamentoIdInput.value ? 'index.php?controller=agendamento&action=update' : 'index.php?controller=agendamento&action=create';

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                try {
                    response = JSON.parse(response);
                } catch (e) {
					console.log(response);
                    console.error("Erro ao parsear JSON:", e);
                    alert('Erro no formato de resposta do servidor.');
                    return;
                }

                if (response.status === 'success') {
                    $('#agendamentoModal').modal('hide');
                    calendar.refetchEvents();
                } else {
                    alert('Erro ao salvar agendamento: ' + (response.message || 'Erro desconhecido'));
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", error);
                alert('Erro ao processar o pedido.');
            }
        });
    });

    deleteButton.addEventListener('click', function() {
        if (confirm("Tem certeza de que deseja excluir este agendamento?")) {
            $.ajax({
                url: 'index.php?controller=agendamento&action=delete',
                method: 'POST',
                data: { id: agendamentoIdInput.value },
                success: function(response) {
                    try {
                        response = JSON.parse(response);
                    } catch (e) {
                        console.error("Erro ao parsear JSON:", e);
                        alert('Erro no formato de resposta do servidor.');
                        return;
                    }

                    if (response.status === 'success') {
                        $('#agendamentoModal').modal('hide');
                        calendar.refetchEvents();
                    } else {
                        alert('Erro ao excluir agendamento: ' + (response.message || 'Erro desconhecido'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erro AJAX:", error);
                    alert('Erro ao processar o pedido.');
                }
            });
        }
    });
});
</script>
