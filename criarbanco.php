<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Aula de PDO</title>
</head>

<body>

    <?php

    require_once "config.php";

    try {
        // Conecta só no servidor (sem dbname), pois o banco ainda pode não existir
        $conexao = new PDO("mysql:host=$servidor", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conexao->exec("CREATE DATABASE IF NOT EXISTS $db");
        echo "Banco de dados criado com sucesso (ou já existia).
        <br><hr><a href='criartabela.php'>Criar tabela</a>";
    } 
    catch (PDOException $e) {
        echo "Não foi possível criar o banco de dados.<br>" . $e->getMessage();
    }

    $conexao = null;

    ?>

</body>

</html>