<?php include 'app/views/head.php'; ?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2>Adicionar Novo Campo</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?controller=campo&action=store" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome do Campo:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required placeholder="Digite o nome do campo">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" required placeholder="Digite a descrição do campo"></textarea>
                </div>
                <div class="form-group">
                    <label for="imagens">Imagens do Campo:</label>
                    <input type="file" class="form-control-file" id="imagens" name="imagens">
                </div>
                <div class="form-group">
                    <label for="dias_funcionamento">Dias de Funcionamento (Selecione múltiplos dias com Ctrl/Cmd):</label>
                    <select multiple class="form-control" id="dias_funcionamento" name="dias_funcionamento[]" size="7">
                        <option value="Segunda">Segunda</option>
                        <option value="Terça">Terça</option>
                        <option value="Quarta">Quarta</option>
                        <option value="Quinta">Quinta</option>
                        <option value="Sexta">Sexta</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="horario_inicio">Horário de Início:</label>
                    <input type="time" class="form-control" id="horario_inicio" name="horario_inicio" required>
                </div>
                <div class="form-group">
                    <label for="horario_fim">Horário de Término:</label>
                    <input type="time" class="form-control" id="horario_fim" name="horario_fim" required>
                </div>
                <div class="form-group">
                    <label for="valor_por_hora">Valor por Hora (R$):</label>
                    <input type="number" class="form-control" id="valor_por_hora" name="valor_por_hora" required placeholder="Ex: 50.00" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label for="google_maps_script">Google Maps (opcional):</label>
                    <textarea class="form-control" id="google_maps_script" name="google_maps_script" rows="2" placeholder="Cole aqui o código de incorporação do Google Maps"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Salvar Campo</button>
            </form>
        </div>
    </div>
</div>