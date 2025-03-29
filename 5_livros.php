<?php
    require_once("header.php");
?>

<?php
    require_once("header.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alexandre Ricardo Custódio de Souza">
    <title>Cadastro de Livros</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; text-align: center; }
        form, .result { background-color: white; padding: 20px; border-radius: 5%; max-width: 500px; margin: 20px auto; }
        .result table { width: 100%; border-collapse: collapse; }
        .result table th, .result table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .result table th { background-color: #f0f0f0; }
        input { border: 2px solid #ddd; border-radius: 5px; margin: 1% }
        .low-stock {
            color: red;
            font-weight: bold;
        };
    </style>
</head>
<main class="container">
<body>

<h3>Cadastro de Livros</h3>

<form method="post" action="">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <label for="titulo<?= $i ?>">Título do Livro <?= $i ?>:</label>
        <input type="text" name="titulo<?= $i ?>" id="titulo<?= $i ?>" required><br>

        <label for="quantidade<?= $i ?>">Quantidade em Estoque:</label>
        <input type="number" name="quantidade<?= $i ?>" id="quantidade<?= $i ?>" min="0" required><br><br>
    <?php endfor; ?>

    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Criando um array associativo com título como chave e quantidade como valor
    $livros = [];
    for ($i = 1; $i <= 5; $i++) {
        $titulo = $_POST["titulo$i"];
        $quantidade = (int) $_POST["quantidade$i"];
        $livros[$titulo] = $quantidade;
    }

    // Ordenando os livros pelo título
    ksort($livros); //ordenando pelo nome do livro

    echo "<h3>Lista de Livros em Estoque:</h3>";
    echo "<ul>";
    foreach ($livros as $titulo => $quantidade) {
        if ($quantidade < 5) {
            echo "<li><span class='low-stock'>Título: $titulo - Estoque Baixo ($quantidade unidades)</span></li>";
        } else {
            echo "<li>Título: $titulo - Quantidade em Estoque: $quantidade</li>";
        }
    }
    echo "</ul>";
}
?>

<?php
    require_once("footer.php");
?>