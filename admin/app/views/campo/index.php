<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Campos - Área Administrativa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<link href="app/views/dashboard/admin.css" rel="stylesheet"> <!-- Incluindo o CSS externo -->
    <link rel="icon" href="/gabriel-testes/alugol/uploads/fav.png" type="image/png">
</head>
<style>
    /* Estilos adicionais para layout */
    .container-fluid {
        display: flex;
        height: 100vh;
    }

    .content {
        flex: 1;
        padding: 20px;
    }
</style>
<body>
    <div class="container-fluid">
        <!-- Menu Lateral -->
        <?php include 'app/views/dashboard/menu.php'; ?>

        <!-- Conteúdo Principal -->
        <div class="content">
		    <div class="campo-header" style="display: flex; align-items: center; justify-content: space-between; background: linear-gradient(90deg, #004d40, #1b5e20); padding: 15px; border-radius: 8px; color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
			    <h2 style="font-size: 26px; font-weight: bold; color: #e0f7fa; margin: 0;">
				    <i class="fas fa-futbol" style="color: #b2ff59; margin-right: 10px;"></i>
				    Meus Campos de Futebol
			    </h2>
			    <a href="index.php?controller=campo&action=create" class="btn btn-primary" style="background-color: #b2ff59; border: none; color: #004d40; font-weight: bold; padding: 10px 20px; text-transform: uppercase; transition: background-color 0.3s;">
				    <i class="fas fa-plus-circle"></i> Adicionar Novo Campo
			    </a>
		    </div>

		    <table class="table table-hover table-bordered">
			    <thead class="thead-dark">
				    <tr>
					    <th scope="col">Nome</th>
					    <th scope="col">Descrição</th>
					    <th scope="col">Dias de Funcionamento</th>
					    <th scope="col">Horário</th>
					    <th scope="col">Valor por Hora</th>
					    <th scope="col">Localização</th>
					    <th scope="col">Ações</th>
				    </tr>
			    </thead>
			    <tbody>
				    <?php foreach($data['campos'] as $campo): ?>
					    <tr>
						    <td><?= htmlspecialchars($campo['nome']) ?></td>
						    <td><?= htmlspecialchars($campo['descricao']) ?></td>
						    <td><?= htmlspecialchars($campo['dias_funcionamento']) ?></td>
						    <td><?= htmlspecialchars($campo['horario_inicio']) ?> - <?= htmlspecialchars($campo['horario_fim']) ?></td>
						    <td>R$ <?= htmlspecialchars(number_format($campo['valor_por_hora'], 2, ',', '.')) ?></td>
						    <td>
							    <?php if (!empty($campo['google_maps_script'])): ?>
								    <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#mapModal" onclick="showMap('<?= htmlspecialchars($campo['google_maps_script']) ?>')">Ver Mapa</a>
							    <?php else: ?>
								    <span class="text-muted">Não disponível</span>
							    <?php endif; ?>
						    </td>
						    <td class="text-center">
							    <a href="index.php?controller=campo&action=edit&id=<?= $campo['id'] ?>" class="btn btn-sm btn-warning">
								    <i class="fas fa-edit"></i> Editar
							    </a>
							    <a href="index.php?controller=campo&action=delete&id=<?= $campo['id'] ?>" 
							    class="btn btn-sm btn-danger" 
							    onclick="return confirm('Tem certeza que deseja excluir este campo?');">
								    <i class="fas fa-trash-alt"></i> Excluir
							    </a>
						    </td>
					    </tr>
				    <?php endforeach; ?>
			    </tbody>
		    </table>
        </div>
    </div>

<!-- Modal para exibir o mapa -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapModalLabel">Localização do Campo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- O conteúdo do mapa será injetado aqui -->
                <div id="mapContent"></div>
            </div>
        </div>
    </div>
</div>


    <!-- jQuery e Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
		function showMap(mapHTML) {
			document.getElementById('mapContent').innerHTML = mapHTML;
		}
	</script>

</body>
</html>
