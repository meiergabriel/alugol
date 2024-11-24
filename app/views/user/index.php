<?php // include '../app/views/header.php'; ?>
<?php // include '../app/views/menu.php'; ?>

<h1 class="my-4">Lista de Usuários</h1>
<a href="https://projetos.vowt.dev.br/gabriel-testes/alugol/index.php?controller=user&action=create" class="btn btn-primary mb-3">Adicionar Novo Usuário</a>

<!-- Tabela de usuários -->
<table class="table table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col" class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data['users'] as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nome'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['telefone'] ?></td>
                <td class="text-center">
                    <a href="index.php?controller=user&action=edit&id=<?= $user['id'] ?>" class="btn btn-sm btn-warning mr-2">Editar</a>
                    
                    <!-- Botão para abrir o modal -->
                    <button 
                        class="btn btn-sm btn-danger" 
                        data-toggle="modal" 
                        data-target="#confirmDeleteModal" 
                        data-id="<?= $user['id'] ?>" 
                        data-nome="<?= $user['nome'] ?>">
                        Deletar
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o usuário <strong id="userName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger" id="confirmDeleteButton">Excluir</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts necessários para o modal funcionar -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // JavaScript para atualizar o modal com as informações do usuário
    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botão que acionou o modal
        var userId = button.data('id'); // Pega o ID do usuário
        var userName = button.data('nome'); // Pega o nome do usuário
        
        // Atualiza o nome do usuário no modal
        var modal = $(this);
        modal.find('#userName').text(userName);
        
        // Atualiza o link de exclusão com o ID do usuário
        modal.find('#confirmDeleteButton').attr('href', 'index.php?controller=user&action=delete&id=' + userId);
    });
</script>


<?php include 'app/views/footer.php'; ?>