<!--
4. Crie um formulário que leia dados de 5 itens: nome e preço. Leia os dados
e crie um mapa ordenado onde as chaves são os nomes dos itens e os
valores são os preços após aplicação de um imposto de 15%. Exiba a lista
ordenada pelos preços após a aplicação do imposto.
-->
<?php
    require_once("header.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alexandre Ricardo Custódio de Souza">
    <title>Itens, Preços e Impostos</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; text-align: center; }
        form, .result { background-color: white; padding: 20px; border-radius: 5%; max-width: 500px; margin: 20px auto; }
        .result table { width: 100%; border-collapse: collapse; }
        .result table th, .result table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .result table th { background-color: #f0f0f0; }
        input { border: 2px solid #ddd; border-radius: 5px; margin: 1% };
    </style>
</head>
<main class="container">
<body>

    <form method="POST">
        <h2>Cadastro de Itens e Preços</h2>
        <p>Preencha o nome e preço de 5 itens:</p>

        <?php for ($i = 1; $i <=5; $i++): ?>
            <label style="font-size: large;" for="nome<?= $i ?>">Item <?= $i ?></label><br>
            <input type="text" id="nome<?= $i ?>" name="nome<?= $i ?>" placeholder="Descrição" required><br>
            <input type="number" id="preco<?= $i ?>" name="preco<?= $i ?>" placeholder="Preço" step="0.01" required><br><br>
        <?php endfor; ?>

        <input type="submit" value="Calcular e Ordenar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lê os dados dos 5 itens e coloca num array
        $itens = [];
        for ($i = 1; $i <=5; $i++) {
            $nome = $_POST["nome$i"];
            $preco = floatval($_POST["preco$i"]);
            $itens[$nome] = $preco + ($preco * 0.15); // Aplica o imposto de 15%
        }

        // Ordenando o array pelos preços após o imposto
        asort($itens);

        // Exibe a tabela com os dados ordenados
        echo "<div class='result'><h3>Lista de Itens e Preços</h3>";
        echo "<table>";
        echo "<tr><th>Nome do Item</th><th>Preço Original</th><th>Preço com Imposto (15%)</th></tr>";
        foreach ($itens as $nome => $precoComImposto) {
            $precoOriginal = $precoComImposto / 1.15; // Calcula o preço original sem o imposto
            echo "<tr>
                    <td>$nome</td>
                    <td>R$ " . number_format($precoOriginal, 2, ',', '.') . "</td>
                    <td>R$ " . number_format($precoComImposto, 2, ',', '.') . "</td>
                  </tr>";
        }
        echo "</table></div>";
            echo "<h5>Ordenada pelos Preços com Imposto</h5>";
        
    }
    ?>

<?php
    require_once("footer.php");
?>
