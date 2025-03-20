<?php
// Processa os dados quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    
    // Ordenando os alunos pela média (maior para menor)
    arsort($alunos);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
</head>
<body>
    <h2>Informe os dados dos alunos</h2>
    <form method="POST">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <h3>Aluno <?= $i ?></h3>
            Nome: <input type="text" name="nome<?= $i ?>" required><br>
            Nota 1: <input type="number" name="nota<?= $i ?>_1" step="0.01" required><br>
            Nota 2: <input type="number" name="nota<?= $i ?>_2" step="0.01" required><br>
            Nota 3: <input type="number" name="nota<?= $i ?>_3" step="0.01" required><br>
            <br>
        <?php endfor; ?>
        <button type="submit">Enviar</button>
    </form>

    <?php if (!empty($alunos)): ?>
        <h2>Resultados</h2>
        <table border="1">
            <tr>
                <th>Aluno</th>
                <th>Média</th>
            </tr>
            <?php foreach ($alunos as $nome => $media): ?>
                <tr>
                    <td><?= htmlspecialchars($nome) ?></td>
                    <td><?= number_format($media, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
