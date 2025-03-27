<!--
1. Crie um formulário que leia dados de 5 contatos: nome e número de
telefone. Leia os dados e crie um mapa ordenado onde as chaves são os
nomes dos contatos e os valores são os números de telefone. Verifique se
há duplicatas de nome ou número de telefone antes de adicionar um novo
contato. Exiba a lista ordenada pelos nomes dos contatos.
-->
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alexandre Ricardo Custódio de Souza">
    <title>1 - Formulário de Contatos</title>
</head>
<body>
    <h2>Informe os dados dos clientes</h2>
    <form action="" method="POST">
        <?php
        for($i=0;$i<5;$i++): ?>
            <input type="text" name="nome[]" placeholder="Nome" />
            <input type="number" name="tel[]" placeholder="Telefone" />
            </br>
        <?php endfor; ?>
        <button type="submit">Enviar</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $a = array();
            $nome = $_POST['nome'];
            $tel = $_POST['tel'];
            for($i=0;$i<5;$i++){
                $posicao = $nome[$i];
                $a[$posicao] = $tel[$i];
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