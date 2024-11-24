<?php // include '../app/views/header.php'; ?>
<?php // include '../app/views/menu.php'; ?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2>Editar Usuário</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?controller=user&action=update&id=<?= $data['user']['id'] ?>" class="mb-4">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $data['user']['nome'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $data['user']['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $data['user']['telefone'] ?>" required placeholder="Digite o telefone">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite uma nova senha">
                </div>
                <button type="submit" class="btn btn-primary w-100">Atualizar</button>
            </form>
        </div>
    </div>
</div>



<?php include 'app/views/footer.php'; ?>