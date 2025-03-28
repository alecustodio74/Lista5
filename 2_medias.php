<!--
2. Crie um formulário que leia dados de 5 alunos: nome e três notas. Leia os
dados e crie um mapa ordenado onde as chaves são os nomes dos alunos
e os valores são as médias das notas. Exiba a lista de alunos ordenada pela
média das notas (do maior para o menor).
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
    <title>Cadastro de Alunos</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; text-align: center; }
        .container { background-color: white; padding: 20px; border-radius: 2%; max-width: 500px; margin: 20px auto; }
    </style>
</head>

<main class="container">
<body style="margin: auto; text-align: center;">
    <h3>Informe os dados dos alunos</h3>
    <form action="" method="POST">
        <?php 
            for ($i = 1; $i <= 5; $i++): ?>
            <h5>Aluno <?= $i ?></h5>
            <input type="text" name="nome<?= $i ?>" placeholder="Nome" required /><br>
            <input type="number" name="nota<?= $i ?>_1" placeholder="Nota 1" step="0.01" required /><br>
            <input type="number" name="nota<?= $i ?>_2" placeholder="Nota 2"step="0.01" required /><br>
            <input type="number" name="nota<?= $i ?>_3" placeholder="Nota 3" step="0.01" required /><br>
            <br>
        <?php endfor; ?>
    </div>
    </div>
        <button type="submit">Enviar</button>
    </form>

<?php
// Processa os dados quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try{
    $alunos = [];
    // Lendo os dados do formulário
    for ($i = 1; $i <= 5; $i++) {
        $nome = $_POST["nome$i"];
        $nota1 = floatval($_POST["nota{$i}_1"]);
        $nota2 = floatval($_POST["nota{$i}_2"]);
        $nota3 = floatval($_POST["nota{$i}_3"]);
        
        $media = ($nota1 + $nota2 + $nota3) / 3;
        $alunos[$nome] = $media;
        }
    }catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
    }
    arsort($alunos); // Ordenando pela média (maior para menor)
    //ksort($alunos); //ordenando em ordem alfabética (nome)
}
?>

    <?php if (!empty($alunos)): ?>
        <h2>Resultados</h2>
          <div class="container text-center" style="border: 1px;">
            <div class="row row-cols-2">
                <div class="col"><strong>Aluno</strong></div>
                <div class="col"><strong>Média</strong></div>
                <?php foreach ($alunos as $nome => $media): ?>
                    <div class="col"><?= htmlspecialchars($nome) ?></div>
                    <div class="col"><?= number_format($media, 2) ?></div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>

<?php
    require_once("footer.php");
?>
