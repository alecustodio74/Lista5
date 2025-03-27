<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contatos</title>
</head>
<body>
    <h2>Formulário de Contatos</h2>
    <form action="" method="POST">
        <?php for ($i = 0; $i < 2; $i++) : ?>
            <h3>Contato <?= $i ?></h3>
            <label for="nome<?= $i ?>">Nome:</label>
            <input type="text" name="nome[]" required><br>
            <label for="telefone<?= $i ?>">Telefone:</label>
            <input type="text" name="telefone[]" required pattern="\d+"><br>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

<?php
// Lendo os dados do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try{
        $mapaContatos = [];
        //$nome = array();
        //$telefone = array();
        
        $nomes = $_POST["nome{$i}"];
        $telefones = $_POST["telefone{$i}"];

        // Processando e verificando duplicatas
        for ($i = 0; $i < count($nomes); $i++) {
            $nome = trim($nomes[$i]);
            $telefone = trim($telefones[$i]);

            if (array_key_exists($nome, $mapaContatos)) {
                echo "Erro: O nome '$nome' já foi adicionado.<br>";
            } elseif (in_array($telefone, $mapaContatos)) {
                echo "Erro: O telefone '$telefone' já foi adicionado.<br>";
            } else {
                $mapaContatos[$nome] = $telefone;
            }
        }
    }catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
    }   
    // Ordenando o mapa de contatos por nome
    ksort($mapaContatos);
    
    // Exibindo os contatos ordenados
    echo "<h2>Lista de Contatos Ordenada</h2>";
    foreach ($mapaContatos as $nome => $telefone) {
        echo "Nome: $nome - Telefone: $telefone<br>";
    }
}
?>