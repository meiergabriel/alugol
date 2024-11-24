<?php
// Ativa a exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Use um caminho relativo ao projeto para teste
session_save_path(__DIR__ . '/../sections');
session_name('alugol_unique_session');
session_start();

// Atribui um valor à sessão
if (!isset($_SESSION['test_value'])) {
    $_SESSION['test_value'] = 'Sessão Funciona!';
} else {
    echo 'Valor da Sessão: ' . $_SESSION['test_value'];
}

// Força a gravação da sessão
session_write_close();

// Debug para verificar a sessão
error_log('Sessão Teste: ' . print_r($_SESSION, true));

// Verifica se o cookie de sessão foi criado
if (isset($_COOKIE['alugol_unique_session'])) {
    echo 'Cookie de sessão está presente.<br>';
    echo 'ID da Sessão: ' . session_id();
} else {
    echo 'Cookie de sessão não foi criado.<br>';
}
?>
