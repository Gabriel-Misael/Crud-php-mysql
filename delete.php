<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Aula PDO</title>
</head>

<body>

    <?php

    require_once 'config.php';

    // O id vem pela URL: delete.php?id=3
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        echo "Informe um id válido. Exemplo: delete.php?id=1<br><hr><a href='read.php'>Listar Dados</a>";
    } else {
        try {

            $conexao = new PDO("mysql:host=$servidor;dbname=$db", $usuario, $senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $comando = $conexao->prepare("DELETE FROM livro WHERE id = :id");
            $comando->bindParam(':id', $id, PDO::PARAM_INT);
            $comando->execute();

            if ($comando->rowCount() > 0) {
                echo "Livro excluído com sucesso!";
            } else {
                echo "Nenhum livro encontrado com o id $id.";
            }
            echo "<br><hr><a href='read.php'>Listar Dados</a>";
        } 
        catch (PDOException $e) {
            echo "Não foi possível excluir o livro.<br>" . $e->getMessage();
        }

        $conexao = null;
    }

    ?>
</body>

</html>