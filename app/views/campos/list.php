<!-- app/views/campos/list.php -->

<style>
	#campoDetailsContent .navbar.navbar-expand-lg.navbar-light.bg-light {
		display: none !important;
	}

	/* Ajuste de Estilo para o Calendário dentro do Modal */
		#calendarContainer {
        padding: 15px;
    }
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    	height: 400px; /* Ajuste o valor conforme necessário */
	}

	/* Estilo geral do modal */
	#campoDetailsModal .modal-content {
		background-color: #f9f9f9; /* Fundo claro */
		border-radius: 12px;
		border: none;
		box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
	}

	/* Header do modal */
	#campoDetailsModal .modal-header {
		background-color: #004d40;
		color: #ffffff;
		border-bottom: none;
		border-radius: 12px 12px 0 0;
	}

	#campoDetailsModal .modal-title {
		font-size: 1.5rem;
		font-weight: bold;
	}

	#campoDetailsModal .modal-header .close {
		color: #ffffff;
		font-size: 1.4rem;
	}

	/* Body do modal */
	#campoDetailsModal .modal-body {
		padding: 30px;
	}

	#campoDetailsModal #campoDetailsContent h3 {
		font-size: 1.8rem;
		font-weight: bold;
		color: #004d40;
		margin-bottom: 20px;
	}

	#campoDetailsModal #campoDetailsContent p {
		font-size: 1rem;
		color: #333;
		margin-bottom: 10px;
	}

	/* Rodapé do modal */
	#campoDetailsModal .modal-footer {
		border-top: none;
		padding-top: 20px;
		padding-bottom: 20px;
	}

	#campoDetailsModal .btn {
		padding: 0px 25px;
		font-size: 1rem;
		border-radius: 8px;
	}

	/* Botão de Chamar Proprietário */
	#campoDetailsModal .btn-success {
		background-color: #28a745;
		border-color: #28a745;
		font-weight: bold;
	}

	#campoDetailsModal .btn-success:hover {
		background-color: #218838;
	}

	/* Botão de Fechar */
	#campoDetailsModal .btn-secondary {
		font-weight: bold;
		color: #ffff;
	}

	#campoDetailsModal .btn-secondary:hover {
		background-color: #e2e2e2;
	}

	.calendar-top-button .btn-outline-success {
    font-size: 0.85rem;
    color: #28a745;
    border-color: #28a745;
    padding: 2px 8px;
	}

	.calendar-top-button .btn-outline-success:hover {
		background-color: #28a745;
		color: #fff;
	}

	.campo-details {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.campo-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: #004d40;
    margin-bottom: 15px;
}

.campo-info {
    display: flex;
    align-items: center;
    font-size: 1rem;
    color: #555;
}

.campo-info strong {
    margin-right: 10px;
    color: #333;
    font-weight: 600;
}
.campo-image img {
    width: 100%;
    height: auto;
    margin-top: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
}

.campo-map {
    margin-top: 20px;
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
    max-width: 600px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
#contactOwnerButtonTop {
    margin-left: 10px;
    padding: 5px 10px;
    font-size: 0.9rem;
    color: #28a745;
    border-color: #28a745;
}

#contactOwnerButtonTop:hover {
    background-color: #28a745;
    color: #fff;
}
</style>

<div class="container mt-5">
    <h2 class="text-center" style="font-size: 2rem; font-weight: bold; color: #004d40; margin-bottom: 40px;">
        Campos de Futebol Disponíveis
    </h2>
    <div class="row">
        <?php if (!empty($data['campos'])): ?>
            <?php foreach ($data['campos'] as $campo): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="border: none; border-radius: 10px; overflow: hidden;">
                        <?php if (!empty($campo['imagens'])): ?>
                            <img src="/gabriel-testes/alugol/uploads/<?= htmlspecialchars($campo['imagens']) ?>" alt="Imagem do Campo" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background-color: #e0e0e0; color: #757575;">
                                <p>Imagem não disponível</p>
                            </div>
                        <?php endif; ?>
                        <div class="card-body text-center" style="padding: 20px;">
                            <h5 class="card-title" style="font-weight: bold; color: #004d40;"><?= htmlspecialchars($campo['nome']) ?></h5>
                            <p class="card-text" style="margin: 5px 0;">
                                <strong>Proprietário:</strong> <?= htmlspecialchars($campo['nome_proprietario']) ?>
                            </p>
                            <p class="card-text" style="margin: 5px 0;">
                                <strong>Valor:</strong> R$<?= number_format($campo['valor_por_hora'], 2, ',', '.') ?>/hora
                            </p>
                            <button class="btn btn-outline-primary mt-3 view-details-btn" data-campo-id="<?= $campo['id'] ?>" style="width: 100%; font-weight: bold;">
                                Ver detalhes
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center" style="width: 100%; font-size: 1.2rem; color: #757575;">Nenhum campo disponível no momento.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal de Detalhes do Campo -->
<div class="modal fade" id="campoDetailsModal" tabindex="-1" aria-labelledby="campoDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campoDetailsModalLabel">Detalhes do Campo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="campoDetailsContent">
                    <!-- Conteúdo será carregado via JavaScript -->
                </div>
                <!-- Botão discreto acima do calendário -->
                <div id="calendarContainer">
                    <!-- Calendário será inserido aqui -->
                </div>
            </div>
            <div class="modal-footer">
			<a id="contactOwnerButton" class="btn btn-success" target="_blank" href="https://wa.me/<?= htmlspecialchars($campo['telefone']) ?>?text=<?= urlencode("Olá " . $campo['nome_proprietario'] . ", tenho interesse em agendar um horário para o " . $campo['nome']) ?>">
				<i class="fab fa-whatsapp"></i> Chamar Proprietário
			</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar e JS para agendamentos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.view-details-btn').on('click', function() {
        const campoId = $(this).data('campo-id');
        
        $.ajax({
            url: 'index.php?controller=campo&action=getCampoDetails',
            method: 'GET',
            data: { campo_id: campoId },
            success: function(data) {
                $('#campoDetailsContent').html(data); 
                $('#campoDetailsModal').modal('show');
				
				// Obtenha o número de telefone e defina o link para WhatsApp
				const telefoneNumber = $('#campoDetailsContent').find('#telefoneNumber').val();
                if (telefoneNumber) {
                    $('#contactOwnerButtonTop').attr('href', `https://wa.me/${telefoneNumber}`);
					$('#contactOwnerButton').attr('href', `https://wa.me/${telefoneNumber}`);
                } else {
                    $('#contactOwnerButtonTop').removeAttr('href'); // Remove link se não houver número
					$('#contactOwnerButton').removeAttr('href'); // Remove link se não houver número
                }

                loadCalendar(campoId); // Carrega o calendário dentro do modal
            },
            error: function() {
                alert('Erro ao carregar detalhes do campo.');
            }
        });
    });

// Altere a chamada do loadCalendar para incluir os horários de funcionamento
$('.view-details-btn').on('click', function() {
    const campoId = $(this).data('campo-id');
    
    $.ajax({
        url: 'index.php?controller=campo&action=getCampoDetails',
        method: 'GET',
        data: { campo_id: campoId },
        success: function(data) {
            $('#campoDetailsContent').html(data); 
            $('#campoDetailsModal').modal('show');
            
            // Obtenha os horários de funcionamento do campo do HTML gerado
            const horarioInicio = $('#campoDetailsContent').find('p:contains("Horário de Funcionamento")').text().match(/\d{2}:\d{2}:\d{2}/g)[0];
            const horarioFim = $('#campoDetailsContent').find('p:contains("Horário de Funcionamento")').text().match(/\d{2}:\d{2}:\d{2}/g)[1];
            
            loadCalendar(campoId, horarioInicio, horarioFim); // Chama o calendário com os horários
        },
        error: function() {
            alert('Erro ao carregar detalhes do campo.');
        }
    });
});

function loadCalendar(campoId, horarioInicio, horarioFim) {
    const calendarEl = document.createElement('div');
    calendarEl.id = 'calendar';
    $('#calendarContainer').html(calendarEl);

    const calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        initialView: 'timeGridWeek',
        editable: false,
        headerToolbar: { left: '', center: 'title', right: '' },
        slotMinTime: horarioInicio, // Define o horário de início
        slotMaxTime: horarioFim,    // Define o horário de término
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: 'index.php?controller=campo&action=getAgendamentosPorCampo',
                method: 'GET',
                dataType: 'text',
                data: { campo_id: campoId },
                success: function(response) {
                    try {
                        const jsonStartIndex = response.indexOf("[{");
                        const jsonEndIndex = response.lastIndexOf("}]") + 2;

                        if (jsonStartIndex !== -1 && jsonEndIndex !== -1) {
                            const jsonResponse = JSON.parse(response.substring(jsonStartIndex, jsonEndIndex));
                            
							const eventos = jsonResponse.map(event => ({
								title: 'Reservado',  // Define o título como "Reservado" para todos os eventos
								start: event.data_inicio,
								end: event.data_fim,
								color: 'red',        // Define a cor como vermelho para todos os eventos
								textColor: 'white'   // Define o texto como branco
							}));

                            
                            successCallback(eventos);
                        } else {
                            console.error("JSON não encontrado na resposta:", response);
                            alert("Erro ao carregar os agendamentos.");
                            failureCallback({
                                message: 'Erro ao carregar os eventos, por favor tente novamente.'
                            });
                        }
                    } catch (error) {
                        console.error("Erro ao parsear JSON:", error);
                        console.log("Resposta do servidor:", response);
                        alert("Erro ao processar a resposta do servidor.");
                        failureCallback({
                            message: 'Erro ao carregar os eventos, por favor tente novamente.'
                        });
                    }

                    $('#campoDetailsModal').on('shown.bs.modal', function () {
                        calendar.updateSize();
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao carregar os agendamentos:", error);
                    console.log("Resposta do servidor:", xhr.responseText);
                    failureCallback({
                        message: 'Erro ao carregar os eventos, por favor tente novamente.'
                    });
                }
            });
        }
    });

    calendar.render();
}
});
</script>