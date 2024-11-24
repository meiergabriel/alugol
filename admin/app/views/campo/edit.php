<!-- app/views/campos/edit.php -->
<?php include 'app/views/head.php'; ?>
<div class="container mt-5">
    <h2>Editar Campo de Futebol</h2>
    
    <?php if (isset($campo) && !empty($campo)): ?>
        <form method="POST" action="index.php?controller=campo&action=edit&id=<?= $campo['id'] ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome do Campo:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($campo['nome']) ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?= htmlspecialchars($campo['descricao']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="dias_funcionamento">Dias de Funcionamento:</label>
                <select multiple class="form-control" id="dias_funcionamento" name="dias_funcionamento[]">
                    <?php $dias = explode(',', $campo['dias_funcionamento']); ?>
                    <option value="Segunda" <?= in_array('Segunda', $dias) ? 'selected' : '' ?>>Segunda</option>
                    <option value="Terça" <?= in_array('Terça', $dias) ? 'selected' : '' ?>>Terça</option>
                    <option value="Quarta" <?= in_array('Quarta', $dias) ? 'selected' : '' ?>>Quarta</option>
                    <option value="Quinta" <?= in_array('Quinta', $dias) ? 'selected' : '' ?>>Quinta</option>
                    <option value="Sexta" <?= in_array('Sexta', $dias) ? 'selected' : '' ?>>Sexta</option>
                    <option value="Sábado" <?= in_array('Sábado', $dias) ? 'selected' : '' ?>>Sábado</option>
                    <option value="Domingo" <?= in_array('Domingo', $dias) ? 'selected' : '' ?>>Domingo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="horario_inicio">Horário de Início:</label>
                <input type="time" class="form-control" id="horario_inicio" name="horario_inicio" value="<?= htmlspecialchars($campo['horario_inicio']) ?>" required>
            </div>
            <div class="form-group">
                <label for="horario_fim">Horário de Término:</label>
                <input type="time" class="form-control" id="horario_fim" name="horario_fim" value="<?= htmlspecialchars($campo['horario_fim']) ?>" required>
            </div>

            <!-- Campo para editar a imagem -->
            <div class="form-group">
                <label for="imagens">Imagem Atual:</label><br>
                <?php if (!empty($campo['imagens'])): ?>
                    <img src="/gabriel-testes/alugol/uploads/<?= htmlspecialchars($campo['imagens']) ?>" alt="Imagem Atual" style="width: 200px; height: auto;" class="mb-2">
                <?php endif; ?>
                <input type="file" class="form-control-file" id="imagens" name="imagens">
                <small class="form-text text-muted">Escolha uma nova imagem para substituir a atual.</small>
            </div>

            <!-- Novo campo para valor por hora -->
            <div class="form-group">
                <label for="valor_por_hora">Valor por Hora (R$):</label>
                <input type="number" class="form-control" id="valor_por_hora" name="valor_por_hora" value="<?= htmlspecialchars($campo['valor_por_hora']) ?>" step="0.01" min="0" required>
            </div>

            <!-- Novo campo para Google Maps Script -->
            <div class="form-group">
                <label for="google_maps_script">Google Maps (opcional):</label>
                <textarea class="form-control" id="google_maps_script" name="google_maps_script" rows="2" placeholder="Cole aqui o código de incorporação do Google Maps"><?= htmlspecialchars($campo['google_maps_script']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>
    <?php else: ?>
        <p class="alert alert-warning">Campo não encontrado.</p>
    <?php endif; ?>
</div>