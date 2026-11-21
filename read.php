<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Aula PDO</title>
    <style>
        table { border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px 12px; text-align: left; }
        th { background: #eee; }
    </style>
</head>

<body>

    <?php

    require_once 'config.php';

    try {

        $conexao = new PDO("mysql:host=$servidor;dbname=$db", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $conexao->query("SELECT id, nome, autor, editora FROM livro ORDER BY id");
        $livros = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (count($livros) === 0) {
            echo "Nenhum livro cadastrado.<br><hr><a href='create.php'>Inserir dados</a>";
        } else {
            echo "<h2>Livros cadastrados</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Autor</th><th>Editora</th><th>Ação</th></tr>";

            foreach ($livros as $livro) {
                echo "<tr>";
                echo "<td>" . $livro['id'] . "</td>";
                echo "<td>" . htmlspecialchars((string) $livro['nome']) . "</td>";
                echo "<td>" . htmlspecialchars((string) $livro['autor']) . "</td>";
                echo "<td>" . htmlspecialchars((string) $livro['editora']) . "</td>";
                echo "<td><a href='delete.php?id=" . $livro['id'] . "' onclick=\"return confirm('Excluir este livro?')\">Excluir</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }
    } 
    catch (PDOException $e) {
        echo "Não foi possível listar os dados.<br>" . $e->getMessage();
    }

    $conexao = null;

    ?>
</body>

</html>