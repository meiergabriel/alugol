<?php // include '../app/views/header.php'; ?>
<?php // include '../app/views/menu.php'; ?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h2>Adicionar Novo Usuário</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?controller=user&action=store" class="mb-4">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required placeholder="Digite o nome">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Digite o email">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required placeholder="Digite o telefone">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required placeholder="Digite a senha">
                </div>
                <button type="submit" class="btn btn-success w-100">Salvar</button>
            </form>
        </div>
    </div>
</div>


<?php include 'app/views/footer.php'; ?>