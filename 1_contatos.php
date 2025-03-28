<!--
1. Crie um formulário que leia dados de 5 contatos: nome e número de
telefone. Leia os dados e crie um mapa ordenado onde as chaves são os
nomes dos contatos e os valores são os números de telefone. Verifique se
há duplicatas de nome ou número de telefone antes de adicionar um novo
contato. Exiba a lista ordenada pelos nomes dos contatos.
-->
<?php
    require_once("header.php");
?>
<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alexandre Ricardo Custódio de Souza">
    <title>Formulário de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { font-family: Arial, sans-serif; }
        form { width: 300px; margin: 20px auto; }
        label, input { display: block; margin: 5px 0; }
        .warning { color: red; font-weight: bold; }
    </style>
</head>
<main class="container">
<body style="margin: auto; text-align: center;">

<h2>Formulário de Contatos</h2>

<form method="POST" action="">
    <?php
        // Gerar dinamicamente os campos de contato
        for ($i = 1; $i <= 5; $i++) {
            echo "<label for='nome$i'>Contato $i:</label>";
            echo "<input type='text' name='nome[]' placeholder='Nome do contato $i' required>";
            //echo "<label for='telefone$i'>Telefone do contato $i:</label>";
            echo "<input type='text' name='telefone[]' placeholder='Telefone do contato $i' required>";
            echo "<br>";
        }
    ?>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomes = $_POST['nome'];
    $telefones = $_POST['telefone'];

    $contatos = []; // Mapa ordenado para armazenar os contatos REPETIDOS
    $avisos = [];

    // Processar cada par nome-telefone
    foreach ($nomes as $index => $nome) {
        $telefone = $telefones[$index];

        // Verificar duplicatas
        if (array_key_exists($nome, $contatos)) {
            $avisos[] = "Aviso: O nome \"$nome\" já foi adicionado.";
        } elseif (in_array($telefone, $contatos)) {
            $avisos[] = "Aviso: O telefone \"$telefone\" já foi associado a outro contato.";
        } else {
            $contatos[$nome] = $telefone;
        }
    }

    // Ordenar o mapa pelos nomes
    ksort($contatos);

    // Exibir avisos de duplicata
    if (!empty($avisos)) {
        echo "<div class='warning'><p>" . implode("</p><p>", $avisos) . "</p></div>";
    }

    // Exibir a lista de contatos
    echo "<h3>Lista de Contatos Ordenada por Nome</h3>";
    echo "<ul>";
    foreach ($contatos as $nome => $telefone) {
        echo "<li><strong>$nome: </strong> $telefone</li>";
    }
    echo "</ul>";
}
?>

<?php
    require_once("footer.php");
?>