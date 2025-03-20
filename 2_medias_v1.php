<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alexandre Ricardo Custódio de Souza">
    <title>2 - Médias</title>
</head>
<body>
    <h3>Alunos e médias!</h3>
    <form action="" method="POST">
       <?php
        for($i=0;$i<5;$i++): ?>
            <input type="text" name="nome[]" placeholder="Nome" />
        <?php endfor; ?>
       
        <?php
        for($j=0;$j<3;$j++): ?>
            <input type="double" name="nota1[]" placeholder="Nota1" />
            <input type="double" name="nota2[]" placeholder="Nota2" />
            <input type="double" name="nota3[]" placeholder="Nota3" />
            </br>
        <?php endfor; ?>
       
        <button type="submit">Enviar</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $a = array();
            $nome = $_POST['nome'];
            $nota1 = floatval($_POST['nota1']);
            $nota2 = floatval($_POST['nota2']);
            $nota3 = floatval($_POST['nota3']);
            //$media = ($nota1 + $nota2 + $nota3)/3;
            for($i=0;$i<5;$i++){
                $posicao = $nome[$i];
                for ($j=0;$j<5;$j++){
                    $media = ($nota1 + $nota2 + $nota3)/3;
                    $a[$posicao] = $media;
                }
            }
            ksort($a); //ordenando pela chave (nome)
            //ou asort($a) ordenando pelo valor (telefone)
        }catch (Exception $e){
            echo $e->getMessage();
    }
    var_dump($a);
    echo "<p></p>";
    print_r($a);
}
?>
    
</body>
</html>