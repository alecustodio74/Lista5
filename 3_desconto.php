<!--
3. Crie um formulário que leia dados de 5 produtos, que são: código, nome e
preço. Leia os dados e crie um mapa ordenado onde as chaves são os
códigos dos produtos e os valores são também mapas ordenados com o
nome e o preço dos produtos. Aplique um desconto de 10% em todos os
produtos com preço acima de R$100,00 e exiba a lista ordenada pelo nome
do produto.
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
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { font-family: Arial, sans-serif; }
        form, table { margin: 20px auto; width: 70%; }
        table, th, td { border: 1px solid #ccc; border-collapse: collapse; padding: 10px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<main class="container">
<body style="text-align: center;">
    <h2 style="text-align: center;">Cadastro de Produtos e descontos</h2>

    <form method="POST">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <fieldset>
                <legend>Produto <?= $i ?></legend>
                <label>Código: <input type="text" name="codigo[]" required></label><br><br>
                <label>Nome: <input type="text" name="nome[]" required></label><br><br>
                <label>Preço: <input type="number" step="0.01" name="preco[]" required></label><br><br>
            </fieldset>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebe os dados do formulário
        $codigos = $_POST['codigo'];
        $nomes = $_POST['nome'];
        $precos = $_POST['preco'];
        
        // Cria um mapa ordenado (array associativo)
        $produtos = [];
        for ($i = 0; $i < count($codigos); $i++) {
            $produtos[$codigos[$i]] = [
                'nome' => $nomes[$i],
                'preco_inicial' => (float)$precos[$i],
            ];
        }

        // Aplica desconto de 10% nos produtos com preço acima de R$100,00
        foreach ($produtos as &$produto) { //o sinal & é de um operador por referência
            if ($produto['preco_inicial'] > 100) {
                $produto['preco_com_desconto'] = $produto['preco_inicial'] * 0.90;
            } else {
                $produto['preco_com_desconto'] = $produto['preco_inicial'];
            }
        }

        // Ordenei o array pelos nomes dos produtos
        uasort($produtos, function ($a, $b) {
            return strcmp($a['nome'], $b['nome']);
        });

        // Exibe a lista ordenada
        echo "<h2 style='text-align: center;'>Lista de Produtos com Preços</h2>";
        echo "<table>";
        echo "<tr><th>Código</th><th>Nome</th><th>Preço Inicial</th><th>Preço com Desconto</th></tr>";
        foreach ($produtos as $codigo => &$produto) {
            echo "<tr>"; //
            echo "<td style='text-align:center;'>{$codigo}</td>";
            echo "<td style='text-align:center;'>{$produto['nome']}</td>";
            echo "<td style='text-align:center;'>R$ " . number_format($produto['preco_inicial'], 2, ',', '.') . "</td>";
            echo "<td style='text-align:center;'>R$ " . number_format($produto['preco_com_desconto'], 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<p style='text-align:center;'>Concedido desconto de 10% para produtos com preço acima de R$ 100,00</p>";
    }
    ?>

<?php
    require_once("footer.php");
?>