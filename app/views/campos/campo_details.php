<div class="campo-details">
    <h3 class="campo-title"><?= htmlspecialchars($campo['nome']) ?></h3>
	<p class="campo-info d-flex align-items-center">
    <strong>Proprietário:</strong> <?= htmlspecialchars($campo['nome_proprietario']) ?>
	<a id="contactOwnerButtonTop" class="btn btn-outline-success btn-sm ml-3" target="_blank" href="https://wa.me/<?= htmlspecialchars($campo['telefone']) ?>?text=<?= urlencode("Olá " . $campo['nome_proprietario'] . ", tenho interesse em agendar um horário para o " . $campo['nome']) ?>">
    <i class="fab fa-whatsapp"></i> Contatar Proprietário
	</a>
	</p>
    <p class="campo-info"><strong>Valor:</strong> R$<?= number_format($campo['valor_por_hora'], 2, ',', '.') ?>/hora</p>
    <p class="campo-info"><strong>Descrição:</strong> <?= htmlspecialchars($campo['descricao']) ?></p>
    <p class="campo-info"><strong>Horário de Funcionamento:</strong> <?= htmlspecialchars($campo['horario_inicio']) ?> - <?= htmlspecialchars($campo['horario_fim']) ?></p>

    <!-- Campo oculto para armazenar o número de telefone -->
    <input type="hidden" id="telefoneNumber" value="<?= htmlspecialchars($campo['telefone']) ?>">

    <h3 class="campo-title mt-3">Horários Disponíveis</h3>

	<div id="calendarContainer">
                    <!-- Calendário será inserido aqui -->
    </div>

    <div class="campo-image">
        <?php if (!empty($campo['imagens'])): ?>
            <img src="/gabriel-testes/alugol/uploads/<?= htmlspecialchars($campo['imagens']) ?>" alt="Imagem do Campo">
        <?php endif; ?>
    </div>

    <!-- Exibe o mapa se o google_maps_script estiver preenchido -->
    <?php if (!empty($campo['google_maps_script'])): ?>
    <center>
        <div class="campo-map">
            <?= $campo['google_maps_script'] ?>
        </div>
    </center>
    <?php endif; ?>
</div>
